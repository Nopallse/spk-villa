<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use App\Models\CriteriaComparison;
use Illuminate\Http\Request;

class PairwiseController extends Controller
{
    public function index()
    {
        $criteria = Criteria::active()->ordered()->get();
        $comparisons = CriteriaComparison::with(['criteriaA', 'criteriaB'])->get();
        
        // Build comparison matrix
        $matrix = [];
        foreach ($criteria as $i => $criteriaA) {
            foreach ($criteria as $j => $criteriaB) {
                if ($i == $j) {
                    $matrix[$criteriaA->id][$criteriaB->id] = 1; // Diagonal elements
                } else {
                    $comparison = $comparisons->where('criteria_a_id', $criteriaA->id)
                                            ->where('criteria_b_id', $criteriaB->id)
                                            ->first();
                    
                    if ($comparison) {
                        $matrix[$criteriaA->id][$criteriaB->id] = $comparison->comparison_value;
                    } else {
                        // Check reverse comparison
                        $reverseComparison = $comparisons->where('criteria_a_id', $criteriaB->id)
                                                        ->where('criteria_b_id', $criteriaA->id)
                                                        ->first();
                        
                        if ($reverseComparison) {
                            $matrix[$criteriaA->id][$criteriaB->id] = 1 / $reverseComparison->comparison_value;
                        } else {
                            $matrix[$criteriaA->id][$criteriaB->id] = null; // Not compared yet
                        }
                    }
                }
            }
        }

        return view('admin.pairwise.index', compact('criteria', 'matrix'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'criteria_a_id' => 'required|exists:criteria,id',
            'criteria_b_id' => 'required|exists:criteria,id|different:criteria_a_id',
            'comparison_value' => 'required|numeric|min:0.111|max:9'
        ]);

        // Check if comparison already exists
        $existing = CriteriaComparison::where([
            ['criteria_a_id', $request->criteria_a_id],
            ['criteria_b_id', $request->criteria_b_id]
        ])->orWhere([
            ['criteria_a_id', $request->criteria_b_id],
            ['criteria_b_id', $request->criteria_a_id]
        ])->first();

        if ($existing) {
            // Update existing comparison
            if ($existing->criteria_a_id == $request->criteria_a_id) {
                $existing->update(['comparison_value' => $request->comparison_value]);
            } else {
                $existing->update([
                    'criteria_a_id' => $request->criteria_a_id,
                    'criteria_b_id' => $request->criteria_b_id,
                    'comparison_value' => $request->comparison_value
                ]);
            }
        } else {
            // Create new comparison
            CriteriaComparison::create($request->all());
        }

        return redirect()->route('admin.pairwise.index')
                        ->with('success', 'Pairwise comparison updated successfully');
    }

    public function calculateWeights()
    {
        $criteria = Criteria::active()->ordered()->get();
        $comparisons = CriteriaComparison::all();

        // Build comparison matrix
        $n = count($criteria);
        $matrix = [];
        $weights = [];

        foreach ($criteria as $i => $criteriaA) {
            $criteriaMatrix = [];
            foreach ($criteria as $j => $criteriaB) {
                if ($criteriaA->id == $criteriaB->id) {
                    $criteriaMatrix[] = 1;
                } else {
                    $comparison = $comparisons->where('criteria_a_id', $criteriaA->id)
                                            ->where('criteria_b_id', $criteriaB->id)
                                            ->first();
                    
                    if ($comparison) {
                        $criteriaMatrix[] = $comparison->comparison_value;
                    } else {
                        $reverseComparison = $comparisons->where('criteria_a_id', $criteriaB->id)
                                                        ->where('criteria_b_id', $criteriaA->id)
                                                        ->first();
                        
                        if ($reverseComparison) {
                            $criteriaMatrix[] = 1 / $reverseComparison->comparison_value;
                        } else {
                            return redirect()->route('admin.pairwise.index')
                                            ->with('error', 'Incomplete pairwise comparisons. Please complete all comparisons.');
                        }
                    }
                }
            }
            $matrix[] = $criteriaMatrix;
        }

        // Calculate weights using Geometric Mean Method
        for ($i = 0; $i < $n; $i++) {
            $product = 1;
            for ($j = 0; $j < $n; $j++) {
                $product *= $matrix[$i][$j];
            }
            $weights[] = pow($product, 1/$n);
        }

        // Normalize weights
        $totalWeight = array_sum($weights);
        for ($i = 0; $i < $n; $i++) {
            $weights[$i] = $weights[$i] / $totalWeight;
        }

        // Calculate Consistency Ratio
        $cr = $this->calculateConsistencyRatio($matrix, $weights);

        $results = [
            'criteria' => $criteria,
            'weights' => $weights,
            'consistency_ratio' => $cr,
            'is_consistent' => $cr <= 0.1
        ];

        return view('admin.pairwise.results', compact('results'));
    }

    private function calculateConsistencyRatio($matrix, $weights)
    {
        $n = count($weights);
        
        // Calculate lambda max
        $weightedSum = [];
        for ($i = 0; $i < $n; $i++) {
            $sum = 0;
            for ($j = 0; $j < $n; $j++) {
                $sum += $matrix[$i][$j] * $weights[$j];
            }
            $weightedSum[] = $sum;
        }

        $lambdaMax = 0;
        for ($i = 0; $i < $n; $i++) {
            $lambdaMax += $weightedSum[$i] / $weights[$i];
        }
        $lambdaMax = $lambdaMax / $n;

        // Calculate CI
        $ci = ($lambdaMax - $n) / ($n - 1);

        // Random Index values
        $ri = [0, 0, 0.58, 0.90, 1.12, 1.24, 1.32, 1.41, 1.45];
        $randomIndex = $ri[$n - 1] ?? 1.45;

        // Calculate CR
        return $ci / $randomIndex;
    }
}
