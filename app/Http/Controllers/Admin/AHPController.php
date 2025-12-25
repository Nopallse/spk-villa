<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use App\Models\CriteriaComparison;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AHPController extends Controller
{
    public function index()
    {
        $criteria = Criteria::active()->ordered()->get();
        $comparisons = $this->getExistingComparisons($criteria);
        $totalComparisons = $this->getTotalRequiredComparisons(count($criteria));
        
        // Always try to calculate weights if we have enough data
        $weights = null;
        $lambdaMax = null;
        $consistencyIndex = null;
        $consistencyRatio = null;
        $randomIndex = null;
        
        // Debug information
        $criteriaCount = count($criteria);
        $hasComplete = $this->hasCompletePairwiseComparisons($criteria);
        
        // Check if we have sufficient comparison data
        if ($criteriaCount >= 2 && $hasComplete) {
            try {
                $results = $this->calculateAHPWeights($criteria);
                $weights = $results['weights'];
                $lambdaMax = $results['lambdaMax'];
                $consistencyIndex = $results['consistencyIndex'];
                $consistencyRatio = $results['consistencyRatio'];
                $randomIndex = $results['randomIndex'];
            } catch (\Exception $e) {
                // If calculation fails, log error but continue without results
            }
        }
        
        return view('admin.ahp-comparison', compact(
            'criteria', 
            'comparisons', 
            'totalComparisons',
            'weights',
            'lambdaMax',
            'consistencyIndex',
            'consistencyRatio',
            'randomIndex'
        ));
    }
    
    public function save(Request $request)
    {
        $comparisons = $request->input('comparison', []);
        
        // Validate request has data
        if (empty($comparisons)) {
            return redirect()->route('admin.ahp-comparison.index')
                            ->with('error', 'Tidak ada data perbandingan yang diterima');
        }
        
        // Filter and validate comparisons before saving
        $validComparisons = [];
        foreach ($comparisons as $criteriaAId => $comparisonsForA) {
            if (!is_array($comparisonsForA)) continue;
            
            foreach ($comparisonsForA as $criteriaBId => $value) {
                // Convert to integers for comparison
                $aId = (int)$criteriaAId;
                $bId = (int)$criteriaBId;
                
                // Skip diagonal elements and validate value
                if ($aId === $bId) continue;
                
                // Strong validation: value must be numeric and positive
                if ($value !== null 
                    && $value !== '' 
                    && is_numeric($value) 
                    && (float)$value > 0) {
                    
                    $validComparisons[] = [
                        'criteria_a_id' => $aId,
                        'criteria_b_id' => $bId,
                        'value' => (float)$value
                    ];
                }
            }
        }
        
        // Only proceed if we have valid comparisons
        if (empty($validComparisons)) {
            return redirect()->route('admin.ahp-comparison.index')
                            ->with('error', 'Tidak ada perbandingan yang valid untuk disimpan. Pastikan Anda mengisi nilai perbandingan.');
        }
        
        // Save valid comparisons with transaction for safety
        DB::beginTransaction();
        
        try {
            $savedCount = 0;
            foreach ($validComparisons as $comparison) {
                // Final validation before save
                if (!isset($comparison['value']) 
                    || !is_numeric($comparison['value']) 
                    || (float)$comparison['value'] <= 0
                    || !isset($comparison['criteria_a_id'])
                    || !isset($comparison['criteria_b_id'])) {
                    continue;
                }
                
                CriteriaComparison::updateOrCreate(
                    [
                        'criteria_a_id' => $comparison['criteria_a_id'],
                        'criteria_b_id' => $comparison['criteria_b_id'],
                    ],
                    [
                        'value' => $comparison['value'],
                        'is_admin_set' => true
                    ]
                );
                
                $savedCount++;
            }
            
            DB::commit();
            
            return redirect()->route('admin.ahp-comparison.index')
                            ->with('success', "Berhasil menyimpan {$savedCount} perbandingan kriteria");
                            
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->route('admin.ahp-comparison.index')
                            ->with('error', 'Terjadi kesalahan saat menyimpan: ' . $e->getMessage());
        }
    }
    
    public function calculate(Request $request)
    {
        // First save the comparisons
        $this->save($request);
        
        return redirect()->route('admin.ahp-comparison.index');
    }
    
    public function apply(Request $request)
    {
        $criteria = Criteria::active()->ordered()->get();
        
        if (!$this->allComparisonsExist($criteria)) {
            return redirect()->route('admin.ahp-comparison.index')
                            ->with('error', 'Perbandingan belum lengkap');
        }
        
        $results = $this->calculateAHPWeights($criteria);
        
        if ($results['consistencyRatio'] > 0.1) {
            return redirect()->route('admin.ahp-comparison.index')
                            ->with('error', 'Perbandingan tidak konsisten, tidak dapat diterapkan');
        }
        
        // Apply weights to criteria
        foreach ($results['weights'] as $criteriaId => $weight) {
            Criteria::where('id', $criteriaId)->update(['weight' => $weight]);
        }
        
        return redirect()->route('admin.ahp-comparison.index')
                        ->with('success', 'Bobot berhasil diterapkan ke sistem');
    }
    
    private function getExistingComparisons($criteria)
    {
        $comparisons = [];
        $existingComparisons = CriteriaComparison::whereIn('criteria_a_id', $criteria->pluck('id'))
                                                ->whereIn('criteria_b_id', $criteria->pluck('id'))
                                                ->get();
        
        foreach ($existingComparisons as $comparison) {
            $comparisons[$comparison->criteria_a_id][$comparison->criteria_b_id] = $comparison->value;
        }
        
        return $comparisons;
    }
    
    private function getTotalRequiredComparisons($n)
    {
        return $n * ($n - 1) / 2; // Upper triangle only
    }
    
    private function allComparisonsExist($criteria)
    {
        $n = count($criteria);
        $requiredComparisons = $this->getTotalRequiredComparisons($n);
        $existingCount = CriteriaComparison::whereIn('criteria_a_id', $criteria->pluck('id'))
                                          ->whereIn('criteria_b_id', $criteria->pluck('id'))
                                          ->count();
        
        return $existingCount >= ($requiredComparisons * 2); // Both directions
    }
    
    private function hasCompletePairwiseComparisons($criteria)
    {
        $criteriaIds = $criteria->pluck('id')->toArray();
        $n = count($criteriaIds);
        
        if ($n < 2) return false;
        
        // Get all existing comparisons
        $existingComparisons = CriteriaComparison::whereIn('criteria_a_id', $criteriaIds)
                                                 ->whereIn('criteria_b_id', $criteriaIds)
                                                 ->get()
                                                 ->keyBy(function ($item) {
                                                     return $item->criteria_a_id . '-' . $item->criteria_b_id;
                                                 });
        
        // For AHP, we only need to check upper triangle comparisons
        // The rest (diagonal=1, lower triangle=reciprocal) are automatic
        $requiredUpperTriangle = $n * ($n - 1) / 2; // n(n-1)/2
        $foundUpperTriangle = 0;
        
        for ($i = 0; $i < $n; $i++) {
            for ($j = $i + 1; $j < $n; $j++) {
                // Check upper triangle only (i < j)
                $key = $criteriaIds[$i] . '-' . $criteriaIds[$j];
                if (isset($existingComparisons[$key]) && $existingComparisons[$key]->value > 0) {
                    $foundUpperTriangle++;
                }
            }
        }
        
        
        return $foundUpperTriangle >= $requiredUpperTriangle;
    }
    
    private function calculateAHPWeights($criteria)
    {
        $n = count($criteria);
        $matrix = $this->buildComparisonMatrix($criteria);
        
        // Step 1: Normalize the matrix
        $normalizedMatrix = $this->normalizeMatrix($matrix);
        
        // Step 2: Calculate eigenvector (weights)
        $weights = $this->calculateEigenvector($normalizedMatrix, $criteria);
        
        // Step 3: Calculate lambda max
        $lambdaMax = $this->calculateLambdaMax($matrix, $weights, $criteria);
        
        // Step 4: Calculate Consistency Index (CI)
        $consistencyIndex = ($lambdaMax - $n) / ($n - 1);
        
        // Step 5: Get Random Index (RI)
        $randomIndex = $this->getRandomIndex($n);
        
        // Step 6: Calculate Consistency Ratio (CR)
        $consistencyRatio = $randomIndex > 0 ? $consistencyIndex / $randomIndex : 0;
        
        return [
            'weights' => $weights,
            'lambdaMax' => $lambdaMax,
            'consistencyIndex' => $consistencyIndex,
            'consistencyRatio' => $consistencyRatio,
            'randomIndex' => $randomIndex
        ];
    }
    
    private function buildComparisonMatrix($criteria)
    {
        $matrix = [];
        $criteriaIds = $criteria->pluck('id')->toArray();
        $comparisons = $this->getExistingComparisons($criteria);
        
        foreach ($criteriaIds as $i => $idA) {
            foreach ($criteriaIds as $j => $idB) {
                if ($idA == $idB) {
                    $matrix[$i][$j] = 1;
                } elseif (isset($comparisons[$idA][$idB])) {
                    $matrix[$i][$j] = $comparisons[$idA][$idB];
                } elseif (isset($comparisons[$idB][$idA])) {
                    $matrix[$i][$j] = 1 / $comparisons[$idB][$idA];
                } else {
                    $matrix[$i][$j] = 1; // Default if missing
                }
            }
        }
        
        return $matrix;
    }
    
    private function normalizeMatrix($matrix)
    {
        $n = count($matrix);
        $normalizedMatrix = [];
        
        // Calculate column sums
        $columnSums = [];
        for ($j = 0; $j < $n; $j++) {
            $sum = 0;
            for ($i = 0; $i < $n; $i++) {
                $sum += $matrix[$i][$j];
            }
            $columnSums[$j] = $sum;
        }
        
        // Normalize each element
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                $normalizedMatrix[$i][$j] = $matrix[$i][$j] / $columnSums[$j];
            }
        }
        
        return $normalizedMatrix;
    }
    
    private function calculateEigenvector($normalizedMatrix, $criteria)
    {
        $n = count($normalizedMatrix);
        $weights = [];
        $criteriaIds = $criteria->pluck('id')->toArray();
        
        // Calculate row averages
        for ($i = 0; $i < $n; $i++) {
            $sum = 0;
            for ($j = 0; $j < $n; $j++) {
                $sum += $normalizedMatrix[$i][$j];
            }
            $weights[$criteriaIds[$i]] = $sum / $n;
        }
        
        return $weights;
    }
    
    private function calculateLambdaMax($matrix, $weights, $criteria)
    {
        $n = count($matrix);
        $lambdaMax = 0;
        $criteriaIds = $criteria->pluck('id')->toArray();
        
        for ($i = 0; $i < $n; $i++) {
            $sum = 0;
            for ($j = 0; $j < $n; $j++) {
                $sum += $matrix[$i][$j] * $weights[$criteriaIds[$j]];
            }
            $lambdaMax += $sum / $weights[$criteriaIds[$i]];
        }
        
        return $lambdaMax / $n;
    }
    
    private function getRandomIndex($n)
    {
        $randomIndices = [
            1 => 0,
            2 => 0,
            3 => 0.52,
            4 => 0.89,
            5 => 1.12,
            6 => 1.24,
            7 => 1.32,
            8 => 1.41,
            9 => 1.45,
            10 => 1.49
        ];
        
        return $randomIndices[$n] ?? 1.45;
    }
}
