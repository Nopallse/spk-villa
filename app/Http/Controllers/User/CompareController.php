<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use App\Models\Villa;
use App\Services\TopsisService;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    protected TopsisService $topsisService;

    public function __construct(TopsisService $topsisService)
    {
        $this->topsisService = $topsisService;
    }

    /**
     * Display comparison page
     */
    public function index(Request $request)
    {
        // Get all active villas for selection
        $allVillas = Villa::where('is_active', true)
            ->orderBy('name')
            ->get();

        // Get active criteria
        $criteria = Criteria::active()->ordered()->get();

        // Get TOPSIS results for scores
        $topsisResults = $this->topsisService->calculate();
        
        // Create a lookup map for villa scores
        $villaScores = [];
        foreach ($topsisResults['rankings'] as $ranking) {
            $villaScores[$ranking['villa_id']] = [
                'score' => $ranking['score'],
                'rank' => $ranking['rank'],
                'd_positive' => $ranking['d_positive'],
                'd_negative' => $ranking['d_negative'],
            ];
        }

        // Check if villas are selected for comparison
        $selectedVillaIds = $request->input('villas', []);
        $selectedVillas = [];
        
        if (!empty($selectedVillaIds)) {
            $selectedVillas = Villa::whereIn('id', $selectedVillaIds)
                ->where('is_active', true)
                ->get()
                ->map(function ($villa) use ($villaScores, $topsisResults, $criteria) {
                    // Get criteria values for this villa
                    $criteriaValues = [];
                    foreach ($criteria as $c) {
                        $value = $topsisResults['decisionMatrix'][$villa->id][$c->code] ?? 0;
                        $criteriaValues[$c->code] = $value;
                    }
                    
                    return [
                        'villa' => $villa,
                        'score' => $villaScores[$villa->id]['score'] ?? 0,
                        'rank' => $villaScores[$villa->id]['rank'] ?? 0,
                        'd_positive' => $villaScores[$villa->id]['d_positive'] ?? 0,
                        'd_negative' => $villaScores[$villa->id]['d_negative'] ?? 0,
                        'criteria_values' => $criteriaValues,
                    ];
                });
        }

        return view('user.compare', [
            'allVillas' => $allVillas,
            'criteria' => $criteria,
            'selectedVillas' => $selectedVillas,
            'villaScores' => $villaScores,
        ]);
    }

    /**
     * Get villa data for AJAX comparison
     */
    public function getVillaData(Request $request)
    {
        $villaIds = $request->input('villa_ids', []);
        
        if (empty($villaIds)) {
            return response()->json(['error' => 'No villas selected'], 400);
        }

        // Get criteria
        $criteria = Criteria::active()->ordered()->get();

        // Get TOPSIS results
        $topsisResults = $this->topsisService->calculate();

        // Get villa data
        $villas = Villa::whereIn('id', $villaIds)
            ->where('is_active', true)
            ->get();

        $comparisonData = [];
        
        foreach ($villas as $villa) {
            // Find ranking data
            $rankingData = $topsisResults['rankings']->firstWhere('villa_id', $villa->id);
            
            // Get criteria values
            $criteriaValues = [];
            foreach ($criteria as $c) {
                $value = $topsisResults['decisionMatrix'][$villa->id][$c->code] ?? 0;
                $criteriaValues[$c->id] = [
                    'code' => $c->code,
                    'value' => $value,
                    'formatted' => $this->formatCriteriaValue($c->code, $value),
                ];
            }

            $comparisonData[] = [
                'id' => $villa->id,
                'name' => $villa->name,
                'location' => $villa->location,
                'price' => $villa->price,
                'price_formatted' => 'Rp ' . number_format($villa->price, 0, ',', '.'),
                'capacity' => $villa->capacity,
                'rating' => $villa->rating,
                'cleanliness_score' => $villa->cleanliness_score,
                'facilities_score' => $villa->facilities_score,
                'facilities' => json_decode($villa->facilities ?? '[]', true),
                'score' => $rankingData['score'] ?? 0,
                'rank' => $rankingData['rank'] ?? 0,
                'd_positive' => $rankingData['d_positive'] ?? 0,
                'd_negative' => $rankingData['d_negative'] ?? 0,
                'criteria_values' => $criteriaValues,
            ];
        }

        // Sort by score descending
        usort($comparisonData, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        // Find best values for each criteria (for highlighting)
        $bestValues = [];
        foreach ($criteria as $c) {
            $values = array_column(array_column($comparisonData, 'criteria_values'), $c->id);
            $actualValues = array_column($values, 'value');
            
            // For price (cost), lower is better; for others (benefit), higher is better
            if ($c->code === 'HAR') {
                $bestValues[$c->id] = min($actualValues);
            } else {
                $bestValues[$c->id] = max($actualValues);
            }
        }

        return response()->json([
            'success' => true,
            'villas' => $comparisonData,
            'criteria' => $criteria->map(function ($c) {
                return [
                    'id' => $c->id,
                    'name' => $c->name,
                    'code' => $c->code,
                    'weight' => $c->weight,
                ];
            }),
            'best_values' => $bestValues,
        ]);
    }

    /**
     * Format criteria value for display
     */
    private function formatCriteriaValue(string $code, $value): string
    {
        return match ($code) {
            'HAR' => 'Rp ' . number_format($value, 0, ',', '.'),
            'KAP' => $value . ' orang',
            'RAT', 'KEB', 'FAS' => number_format($value, 1),
            'LOK' => number_format($value, 1),
            default => (string) $value,
        };
    }
}
