<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Villa;
use App\Services\TopsisService;
use Illuminate\Http\Request;

class VillaSearchController extends Controller
{
    protected TopsisService $topsisService;

    public function __construct(TopsisService $topsisService)
    {
        $this->topsisService = $topsisService;
    }

    /**
     * Display villa search page with filters
     */
    public function index(Request $request)
    {
        $query = Villa::where('is_active', true);

        // Apply filters
        $filters = $this->applyFilters($query, $request);

        // Get locations for dropdown
        $locations = Villa::where('is_active', true)
            ->distinct()
            ->pluck('location')
            ->filter()
            ->sort()
            ->values();

        // Get villas with pagination
        $villas = $query->paginate(9)->withQueryString();

        // Count total active villas
        $totalVillas = Villa::where('is_active', true)->count();

        return view('user.villas.index', compact('villas', 'locations', 'filters', 'totalVillas'));
    }

    /**
     * Search villas with AJAX
     */
    public function search(Request $request)
    {
        $query = Villa::where('is_active', true);

        // Apply filters
        $this->applyFilters($query, $request);

        $villas = $query->get();

        return response()->json([
            'success' => true,
            'count' => $villas->count(),
            'villas' => $villas->map(function ($villa) {
                return [
                    'id' => $villa->id,
                    'name' => $villa->name,
                    'location' => $villa->location,
                    'address' => $villa->address,
                    'price' => $villa->price,
                    'price_formatted' => 'Rp ' . number_format($villa->price, 0, ',', '.'),
                    'capacity' => $villa->capacity,
                    'rating' => $villa->rating,
                    'cleanliness_score' => $villa->cleanliness_score,
                    'facilities_score' => $villa->facilities_score,
                    'facilities' => json_decode($villa->facilities ?? '[]'),
                    'images' => json_decode($villa->images ?? '[]'),
                ];
            }),
        ]);
    }

    /**
     * Get recommendations based on filters using TOPSIS
     */
    public function recommendations(Request $request)
    {
        // Calculate TOPSIS rankings
        $results = $this->topsisService->calculate();

        // Apply filters to rankings if any
        $filteredRankings = $results['rankings'];

        if ($request->filled('min_price')) {
            $filteredRankings = $filteredRankings->filter(function ($ranking) use ($request) {
                return $ranking['villa']->price >= $request->min_price;
            });
        }

        if ($request->filled('max_price')) {
            $filteredRankings = $filteredRankings->filter(function ($ranking) use ($request) {
                return $ranking['villa']->price <= $request->max_price;
            });
        }

        if ($request->filled('capacity')) {
            $filteredRankings = $filteredRankings->filter(function ($ranking) use ($request) {
                return $ranking['villa']->capacity >= $request->capacity;
            });
        }

        if ($request->filled('location')) {
            $filteredRankings = $filteredRankings->filter(function ($ranking) use ($request) {
                return stripos($ranking['villa']->location, $request->location) !== false;
            });
        }

        // Re-rank after filtering
        $filteredRankings = $filteredRankings->values()->map(function ($item, $index) {
            $item['rank'] = $index + 1;
            return $item;
        });

        return response()->json([
            'success' => true,
            'count' => $filteredRankings->count(),
            'rankings' => $filteredRankings,
        ]);
    }

    /**
     * Apply filters to query
     */
    private function applyFilters($query, Request $request): array
    {
        $filters = [
            'min_price' => $request->input('min_price'),
            'max_price' => $request->input('max_price'),
            'capacity' => $request->input('capacity'),
            'location' => $request->input('location'),
            'facilities' => $request->input('facilities', []),
            'sort' => $request->input('sort', 'recommended'),
        ];

        // Price filter
        if (!empty($filters['min_price'])) {
            $query->where('price', '>=', $filters['min_price']);
        }

        if (!empty($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }

        // Capacity filter
        if (!empty($filters['capacity'])) {
            $query->where('capacity', '>=', $filters['capacity']);
        }

        // Location filter
        if (!empty($filters['location'])) {
            $query->where('location', 'like', '%' . $filters['location'] . '%');
        }

        // Facilities filter (JSON search)
        if (!empty($filters['facilities']) && is_array($filters['facilities'])) {
            foreach ($filters['facilities'] as $facility) {
                $query->where('facilities', 'like', '%' . $facility . '%');
            }
        }

        // Sorting
        switch ($filters['sort']) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            default:
                $query->orderBy('rating', 'desc')
                      ->orderBy('price', 'asc');
                break;
        }

        return $filters;
    }
}
