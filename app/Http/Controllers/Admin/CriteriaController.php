<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            'description' => 'nullable|string',
            'weight' => 'nullable|numeric|min:0.1|max:10',
            'order' => 'required|integer|min:1',
            'is_active' => 'nullable|boolean'
        ]);

        $data = $request->all();
        
        // Set default values for optional fields
        $data['code'] = $data['code'] ?? strtoupper(substr($data['name'], 0, 3));
        $data['weight'] = $data['weight'] ?? 1.0; // Default weight until AHP calculation
        $data['is_active'] = isset($data['is_active']) ? true : false;
        
        // If order is duplicate, adjust other records to ensure uniqueness
        DB::transaction(function () use ($data) {
            if (Criteria::where('order', $data['order'])->exists()) {
                Criteria::where('order', '>=', $data['order'])->increment('order');
            }
            Criteria::create($data);
        });
        
        return redirect()->route('admin.criteria.index')
                        ->with('success', "Kriteria '{$data['name']}' berhasil ditambahkan");
    }

    public function edit(Criteria $criteria)
    {
        return view('admin.criteria.edit', compact('criteria'));
    }

    public function show($id)
    {
        // Find criteria by ID
        $criteria = Criteria::findOrFail($id);
        
        // Return JSON for AJAX requests
        if (request()->wantsJson() || request()->ajax() || request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $criteria->id,
                    'name' => $criteria->name,
                    'code' => $criteria->code,
                    'type' => $criteria->type,
                    'description' => $criteria->description,
                    'order' => $criteria->order,
                    'is_active' => $criteria->is_active,
                    'weight' => $criteria->weight
                ]
            ]);
        }
        
        return view('admin.criteria.edit', compact('criteria'));
    }

    public function update(Request $request, Criteria $criteria)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:20|unique:criteria,code,' . $criteria->id,
            'description' => 'nullable|string',
            'weight' => 'nullable|numeric|min:0.1|max:10',
            'order' => 'required|integer|min:1',
            'is_active' => 'nullable|boolean'
        ]);

        $data = $request->all();
        $oldOrder = $criteria->order;
        $newOrder = $data['order'];
        
        // Set default values for optional fields
        $data['code'] = $data['code'] ?? strtoupper(substr($data['name'], 0, 3));
        $data['weight'] = $data['weight'] ?? $criteria->weight ?? 1.0; // Keep existing weight or default
        $data['is_active'] = isset($data['is_active']) ? true : false;
        
        // Handle order change in transaction
        DB::transaction(function () use ($oldOrder, $newOrder, $criteria, $data) {
            if ($oldOrder != $newOrder) {
                if ($newOrder > $oldOrder) {
                    // Moving down: shift records between old and new position up
                    Criteria::where('order', '>', $oldOrder)
                        ->where('order', '<=', $newOrder)
                        ->where('id', '!=', $criteria->id)
                        ->decrement('order');
                } else {
                    // Moving up: shift records between new and old position down
                    Criteria::where('order', '>=', $newOrder)
                        ->where('order', '<', $oldOrder)
                        ->where('id', '!=', $criteria->id)
                        ->increment('order');
                }
            }
            $criteria->update($data);
        });
        
        return redirect()->route('admin.criteria.index')
                        ->with('success', "Kriteria '{$data['name']}' berhasil diperbarui");
    }

    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();
        
        try {
            // Find criteria by ID (in case route model binding doesn't work)
            $criteria = Criteria::findOrFail($id);
            $criteriaId = $criteria->id;
            $criteriaName = $criteria->name;
            
            Log::info('Deleting criteria', [
                'id' => $criteriaId,
                'name' => $criteriaName
            ]);

            // Delete related records manually to ensure they're deleted
            $comparisonsAsA = $criteria->comparisonsAsA()->count();
            $comparisonsAsB = $criteria->comparisonsAsB()->count();
            $userPreferences = $criteria->userPreferences()->count();
            
            Log::info('Related records count', [
                'comparisons_as_a' => $comparisonsAsA,
                'comparisons_as_b' => $comparisonsAsB,
                'user_preferences' => $userPreferences
            ]);

            // Delete related records
            $criteria->comparisonsAsA()->delete();
            $criteria->comparisonsAsB()->delete();
            $criteria->userPreferences()->delete();

            // Now delete the criteria itself
            $deletedOrder = $criteria->order;
            $deleted = $criteria->delete();
            
            if (!$deleted) {
                throw new \Exception('Failed to delete criteria record');
            }

            // Reorder remaining criteria to fill the gap
            Criteria::where('order', '>', $deletedOrder)->decrement('order');

            DB::commit();
            
            Log::info('Criteria deleted successfully', [
                'id' => $criteriaId,
                'name' => $criteriaName
            ]);

            return redirect()
                ->route('admin.criteria.index')
                ->with('success', "Kriteria '{$criteriaName}' dan seluruh data terkait berhasil dihapus");
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            Log::error('Criteria not found for deletion', [
                'id' => $id ?? null,
                'exception' => $e->getMessage()
            ]);
            
            return redirect()
                ->route('admin.criteria.index')
                ->with('error', 'Kriteria tidak ditemukan.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to delete criteria: ' . $e->getMessage(), [
                'id' => $id ?? null,
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()
                ->route('admin.criteria.index')
                ->with('error', 'Gagal menghapus kriteria: ' . $e->getMessage());
        }
    }


    public function toggleStatus(Criteria $criteria)
    {
        $criteria->update(['is_active' => !$criteria->is_active]);
        
        $status = $criteria->is_active ? 'diaktifkan' : 'dinonaktifkan';
        
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "Status kriteria berhasil {$status}",
                'is_active' => $criteria->is_active
            ]);
        }
        
        return redirect()->route('admin.criteria.index')
                        ->with('success', "Kriteria '{$criteria->name}' berhasil {$status}");
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:criteria,id',
            'items.*.order' => 'required|integer|min:1'
        ]);

        DB::beginTransaction();
        
        try {
            $items = $request->items;
            
            // Update all orders
            foreach ($items as $item) {
                Criteria::where('id', $item['id'])->update(['order' => $item['order']]);
            }
            
            // Ensure no duplicate orders by reordering if needed
            $criteria = Criteria::orderBy('order')->get();
            $order = 1;
            foreach ($criteria as $criterion) {
                if ($criterion->order != $order) {
                    $criterion->update(['order' => $order]);
                }
                $order++;
            }
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Urutan kriteria berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update criteria order: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui urutan: ' . $e->getMessage()
            ], 500);
        }
    }
}
