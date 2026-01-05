<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use App\Models\Villa;
use App\Services\TopsisService;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    protected TopsisService $topsisService;

    public function __construct(TopsisService $topsisService)
    {
        $this->topsisService = $topsisService;
    }

    /**
     * Display TOPSIS calculation results
     */
    public function index(Request $request)
    {
        // Calculate TOPSIS rankings
        $results = $this->topsisService->calculate();

        // Apply filters to rankings if any
        $rankings = $results['rankings'];
        $filtersApplied = false;

        if ($request->filled('min_price')) {
            $rankings = $rankings->filter(function ($ranking) use ($request) {
                return $ranking['villa']->price >= $request->min_price;
            });
            $filtersApplied = true;
        }

        if ($request->filled('max_price')) {
            $rankings = $rankings->filter(function ($ranking) use ($request) {
                return $ranking['villa']->price <= $request->max_price;
            });
            $filtersApplied = true;
        }

        if ($request->filled('capacity')) {
            $rankings = $rankings->filter(function ($ranking) use ($request) {
                return $ranking['villa']->capacity >= $request->capacity;
            });
            $filtersApplied = true;
        }

        // Re-rank after filtering (keep original scores but update rank)
        $rankings = $rankings->values()->map(function ($item, $index) {
            $item['rank'] = $index + 1;
            return $item;
        });

        // Get summary statistics
        $villaCount = $rankings->count();
        $criteriaCount = Criteria::active()->count();
        
        // Get top score
        $topScore = $rankings->isNotEmpty() 
            ? $rankings->first()['score'] 
            : 0;

        // Get criteria weights for display
        $criteriaWeights = Criteria::active()->ordered()->get()->map(function ($c) {
            return [
                'name' => $c->name,
                'code' => $c->code,
                'weight' => $c->weight,
            ];
        });

        // Check if weights are set (from AHP)
        $weightsConfigured = Criteria::active()->where('weight', '>', 0)->exists();

        // Get active filters for display
        $activeFilters = array_filter([
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,
            'capacity' => $request->capacity,
        ]);

        return view('results', [
            'rankings' => $rankings,
            'criteria' => $results['criteria'],
            'weights' => $results['weights'],
            'decisionMatrix' => $results['decisionMatrix'],
            'normalizedMatrix' => $results['normalizedMatrix'],
            'weightedMatrix' => $results['weightedMatrix'],
            'idealPositive' => $results['idealPositive'],
            'idealNegative' => $results['idealNegative'],
            'distances' => $results['distances'],
            'villaCount' => $villaCount,
            'totalVillas' => Villa::where('is_active', true)->count(),
            'criteriaCount' => $criteriaCount,
            'topScore' => $topScore,
            'criteriaWeights' => $criteriaWeights,
            'weightsConfigured' => $weightsConfigured,
            'filtersApplied' => $filtersApplied,
            'activeFilters' => $activeFilters,
            'error' => $results['error'],
        ]);
    }

    /**
     * Show detailed calculation for a specific villa
     */
    public function detail($villaId)
    {
        $results = $this->topsisService->calculate();
        
        $villa = Villa::findOrFail($villaId);
        
        $villaResult = $results['rankings']->firstWhere('villa_id', $villaId);
        
        if (!$villaResult) {
            return redirect()->route('results')
                ->with('error', 'Villa tidak ditemukan dalam hasil perhitungan');
        }

        return view('results-detail', [
            'villa' => $villa,
            'result' => $villaResult,
            'criteria' => $results['criteria'],
            'weights' => $results['weights'],
            'decisionMatrix' => $results['decisionMatrix'][$villaId] ?? [],
            'normalizedMatrix' => $results['normalizedMatrix'][$villaId] ?? [],
            'weightedMatrix' => $results['weightedMatrix'][$villaId] ?? [],
            'idealPositive' => $results['idealPositive'],
            'idealNegative' => $results['idealNegative'],
        ]);
    }

    /**
     * Export results to PDF
     */
    public function exportPdf()
    {
        $results = $this->topsisService->calculate();
        
        // For now, redirect back with message
        // PDF generation can be implemented with dompdf or similar
        return redirect()->route('results')
            ->with('info', 'Fitur export PDF akan segera tersedia');
    }
}
