<?php

namespace App\Services;

use App\Models\Criteria;
use App\Models\Villa;
use Illuminate\Support\Collection;

class TopsisService
{
    /**
     * Mapping criteria code to villa attribute
     */
    private array $criteriaMapping = [
        'HAR' => 'price',           // Harga - cost type
        'LOK' => 'rating',          // Lokasi - use rating as proxy
        'FAS' => 'facilities_score', // Fasilitas
        'KEB' => 'cleanliness_score', // Kebersihan
        'RAT' => 'rating',          // Rating
        'KAP' => 'capacity',        // Kapasitas
    ];

    /**
     * Cost criteria (lower is better)
     */
    private array $costCriteria = ['HAR']; // Harga is cost type

    /**
     * Calculate TOPSIS rankings for active villas
     *
     * @return array
     */
    public function calculate(): array
    {
        // Get active criteria with weights from AHP
        $criteria = Criteria::active()->ordered()->get();
        
        if ($criteria->isEmpty()) {
            return [
                'rankings' => collect(),
                'villas' => collect(),
                'criteria' => collect(),
                'weights' => [],
                'decisionMatrix' => [],
                'normalizedMatrix' => [],
                'weightedMatrix' => [],
                'idealPositive' => [],
                'idealNegative' => [],
                'distances' => [],
                'error' => 'Tidak ada kriteria aktif',
            ];
        }

        // Get active villas
        $villas = Villa::where('is_active', true)->get();
        
        if ($villas->isEmpty()) {
            return [
                'rankings' => collect(),
                'villas' => collect(),
                'criteria' => $criteria,
                'weights' => [],
                'decisionMatrix' => [],
                'normalizedMatrix' => [],
                'weightedMatrix' => [],
                'idealPositive' => [],
                'idealNegative' => [],
                'distances' => [],
                'error' => 'Tidak ada villa aktif',
            ];
        }

        // Get weights (normalized to sum = 1)
        $weights = $this->normalizeWeights($criteria);

        // Step 1: Build decision matrix
        $decisionMatrix = $this->buildDecisionMatrix($villas, $criteria);

        // Step 2: Normalize the decision matrix
        $normalizedMatrix = $this->normalizeDecisionMatrix($decisionMatrix, $criteria);

        // Step 3: Calculate weighted normalized matrix
        $weightedMatrix = $this->calculateWeightedMatrix($normalizedMatrix, $weights, $criteria);

        // Step 4: Determine ideal positive and negative solutions
        $idealPositive = $this->calculateIdealPositive($weightedMatrix, $criteria);
        $idealNegative = $this->calculateIdealNegative($weightedMatrix, $criteria);

        // Step 5: Calculate distance to ideal solutions
        $distances = $this->calculateDistances($weightedMatrix, $idealPositive, $idealNegative, $villas);

        // Step 6: Calculate preference scores (closeness coefficient)
        $rankings = $this->calculatePreferenceScores($distances, $villas);

        return [
            'rankings' => $rankings,
            'villas' => $villas,
            'criteria' => $criteria,
            'weights' => $weights,
            'decisionMatrix' => $decisionMatrix,
            'normalizedMatrix' => $normalizedMatrix,
            'weightedMatrix' => $weightedMatrix,
            'idealPositive' => $idealPositive,
            'idealNegative' => $idealNegative,
            'distances' => $distances,
            'error' => null,
        ];
    }

    /**
     * Normalize weights to sum = 1
     */
    private function normalizeWeights(Collection $criteria): array
    {
        $totalWeight = $criteria->sum('weight');
        
        if ($totalWeight == 0) {
            // Equal weights if no weights set
            $equalWeight = 1 / count($criteria);
            return $criteria->mapWithKeys(function ($c) use ($equalWeight) {
                return [$c->code => $equalWeight];
            })->toArray();
        }

        return $criteria->mapWithKeys(function ($c) use ($totalWeight) {
            return [$c->code => $c->weight / $totalWeight];
        })->toArray();
    }

    /**
     * Build the decision matrix
     */
    private function buildDecisionMatrix(Collection $villas, Collection $criteria): array
    {
        $matrix = [];

        foreach ($villas as $villa) {
            $row = [];
            foreach ($criteria as $criterion) {
                $value = $this->getVillaValue($villa, $criterion->code);
                $row[$criterion->code] = $value;
            }
            $matrix[$villa->id] = $row;
        }

        return $matrix;
    }

    /**
     * Get villa value for a specific criterion
     */
    private function getVillaValue(Villa $villa, string $code): float
    {
        $mapping = [
            'HAR' => $villa->price ?? 0,
            'LOK' => $villa->rating ?? 0,  // Using rating as location proxy
            'FAS' => $villa->facilities_score ?? 0,
            'KEB' => $villa->cleanliness_score ?? 0,
            'RAT' => $villa->rating ?? 0,
            'KAP' => $villa->capacity ?? 0,
        ];

        return (float) ($mapping[$code] ?? 0);
    }

    /**
     * Normalize decision matrix using vector normalization
     */
    private function normalizeDecisionMatrix(array $decisionMatrix, Collection $criteria): array
    {
        $normalizedMatrix = [];

        // Calculate the square root of sum of squares for each criterion
        $divisors = [];
        foreach ($criteria as $criterion) {
            $sumSquares = 0;
            foreach ($decisionMatrix as $villaId => $row) {
                $sumSquares += pow($row[$criterion->code], 2);
            }
            $divisors[$criterion->code] = sqrt($sumSquares);
        }

        // Normalize each value
        foreach ($decisionMatrix as $villaId => $row) {
            $normalizedRow = [];
            foreach ($criteria as $criterion) {
                $divisor = $divisors[$criterion->code];
                $normalizedRow[$criterion->code] = $divisor > 0 
                    ? $row[$criterion->code] / $divisor 
                    : 0;
            }
            $normalizedMatrix[$villaId] = $normalizedRow;
        }

        return $normalizedMatrix;
    }

    /**
     * Calculate weighted normalized matrix
     */
    private function calculateWeightedMatrix(array $normalizedMatrix, array $weights, Collection $criteria): array
    {
        $weightedMatrix = [];

        foreach ($normalizedMatrix as $villaId => $row) {
            $weightedRow = [];
            foreach ($criteria as $criterion) {
                $weight = $weights[$criterion->code] ?? 0;
                $weightedRow[$criterion->code] = $row[$criterion->code] * $weight;
            }
            $weightedMatrix[$villaId] = $weightedRow;
        }

        return $weightedMatrix;
    }

    /**
     * Determine if criterion is cost type
     */
    private function isCostCriterion(string $code): bool
    {
        return in_array($code, $this->costCriteria);
    }

    /**
     * Calculate ideal positive solution (A+)
     */
    private function calculateIdealPositive(array $weightedMatrix, Collection $criteria): array
    {
        $idealPositive = [];

        foreach ($criteria as $criterion) {
            $values = array_column($weightedMatrix, $criterion->code);
            
            if ($this->isCostCriterion($criterion->code)) {
                // For cost criteria, ideal positive is minimum
                $idealPositive[$criterion->code] = min($values);
            } else {
                // For benefit criteria, ideal positive is maximum
                $idealPositive[$criterion->code] = max($values);
            }
        }

        return $idealPositive;
    }

    /**
     * Calculate ideal negative solution (A-)
     */
    private function calculateIdealNegative(array $weightedMatrix, Collection $criteria): array
    {
        $idealNegative = [];

        foreach ($criteria as $criterion) {
            $values = array_column($weightedMatrix, $criterion->code);
            
            if ($this->isCostCriterion($criterion->code)) {
                // For cost criteria, ideal negative is maximum
                $idealNegative[$criterion->code] = max($values);
            } else {
                // For benefit criteria, ideal negative is minimum
                $idealNegative[$criterion->code] = min($values);
            }
        }

        return $idealNegative;
    }

    /**
     * Calculate distances to ideal solutions
     */
    private function calculateDistances(
        array $weightedMatrix, 
        array $idealPositive, 
        array $idealNegative, 
        Collection $villas
    ): array {
        $distances = [];

        foreach ($villas as $villa) {
            $dPositive = 0;
            $dNegative = 0;

            foreach ($weightedMatrix[$villa->id] as $code => $value) {
                $dPositive += pow($value - $idealPositive[$code], 2);
                $dNegative += pow($value - $idealNegative[$code], 2);
            }

            $distances[$villa->id] = [
                'd_positive' => sqrt($dPositive),
                'd_negative' => sqrt($dNegative),
            ];
        }

        return $distances;
    }

    /**
     * Calculate preference scores (closeness coefficient)
     */
    private function calculatePreferenceScores(array $distances, Collection $villas): Collection
    {
        $scores = [];

        foreach ($villas as $villa) {
            $dPos = $distances[$villa->id]['d_positive'];
            $dNeg = $distances[$villa->id]['d_negative'];
            
            // Preference score = D- / (D+ + D-)
            $score = ($dPos + $dNeg) > 0 
                ? $dNeg / ($dPos + $dNeg) 
                : 0;

            $scores[] = [
                'villa' => $villa,
                'villa_id' => $villa->id,
                'score' => round($score, 6),
                'd_positive' => round($dPos, 6),
                'd_negative' => round($dNeg, 6),
            ];
        }

        // Sort by score descending
        usort($scores, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        // Add rank
        foreach ($scores as $index => &$item) {
            $item['rank'] = $index + 1;
        }

        return collect($scores);
    }
}
