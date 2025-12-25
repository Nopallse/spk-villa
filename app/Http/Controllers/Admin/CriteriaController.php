<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    public function index()
    {
        $criteria = Criteria::ordered()->paginate(10);
        return view('admin.criteria.index', compact('criteria'));
    }

    public function create()
    {
        return view('admin.criteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:20|unique:criteria',
            'type' => 'required|in:benefit,cost',
            'description' => 'nullable|string',
            'weight' => 'nullable|numeric|min:0.1|max:10',
            'order' => 'required|integer|min:1',
            'is_active' => 'nullable|boolean'
        ]);

        $data = $request->all();
        
        // Set default values for optional fields
        $data['code'] = $data['code'] ?? strtoupper(substr($data['name'], 0, 3));
        $data['type'] = $data['type'] ?? 'benefit';
        $data['weight'] = $data['weight'] ?? 1.0; // Default weight until AHP calculation
        $data['is_active'] = isset($data['is_active']) ? true : false;
        
        Criteria::create($data);
        
        return redirect()->route('admin.criteria.index')
                        ->with('success', 'Criteria created successfully');
    }

    public function edit(Criteria $criteria)
    {
        return view('admin.criteria.edit', compact('criteria'));
    }

    public function update(Request $request, Criteria $criteria)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:20|unique:criteria,code,' . $criteria->id,
            'type' => 'required|in:benefit,cost',
            'description' => 'nullable|string',
            'weight' => 'nullable|numeric|min:0.1|max:10',
            'order' => 'required|integer|min:1',
            'is_active' => 'nullable|boolean'
        ]);

        $data = $request->all();
        
        // Set default values for optional fields
        $data['code'] = $data['code'] ?? strtoupper(substr($data['name'], 0, 3));
        $data['type'] = $data['type'] ?? 'benefit';
        $data['weight'] = $data['weight'] ?? $criteria->weight ?? 1.0; // Keep existing weight or default
        $data['is_active'] = isset($data['is_active']) ? true : false;
        
        $criteria->update($data);
        
        return redirect()->route('admin.criteria.index')
                        ->with('success', 'Criteria updated successfully');
    }

    public function destroy(Criteria $criteria)
    {
        // Check if criteria has comparisons or preferences
        if ($criteria->comparisonsAsA()->exists() || $criteria->comparisonsAsB()->exists() || $criteria->userPreferences()->exists()) {
            return redirect()->route('admin.criteria.index')
                            ->with('error', 'Cannot delete criteria that has comparisons or preferences');
        }

        $criteria->delete();
        
        return redirect()->route('admin.criteria.index')
                        ->with('success', 'Criteria deleted successfully');
    }

    public function toggleStatus(Criteria $criteria)
    {
        $criteria->update(['is_active' => !$criteria->is_active]);
        
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Criteria status updated successfully',
                'is_active' => $criteria->is_active
            ]);
        }
        
        return redirect()->route('admin.criteria.index')
                        ->with('success', 'Criteria status updated successfully');
    }
}
