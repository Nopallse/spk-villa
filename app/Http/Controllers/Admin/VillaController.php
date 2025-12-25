<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Villa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VillaController extends Controller
{
    public function index(Request $request)
    {
        $query = Villa::query();
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // Price range filter
        if ($request->filled('price_range')) {
            switch ($request->get('price_range')) {
                case 'low':
                    $query->where('price_max', '<', 500000);
                    break;
                case 'medium':
                    $query->whereBetween('price_min', [500000, 1000000]);
                    break;
                case 'high':
                    $query->where('price_min', '>', 1000000);
                    break;
            }
        }
        
        // Status filter
        if ($request->filled('status')) {
            if ($request->get('status') === 'active') {
                $query->where('is_active', true);
            } elseif ($request->get('status') === 'inactive') {
                $query->where('is_active', false);
            }
        }
        
        // Capacity filter
        if ($request->filled('capacity')) {
            switch ($request->get('capacity')) {
                case 'small':
                    $query->where('bedrooms', '<=', 2);
                    break;
                case 'medium':
                    $query->whereBetween('bedrooms', [3, 4]);
                    break;
                case 'large':
                    $query->where('bedrooms', '>=', 5);
                    break;
            }
        }
        
        $villas = $query->orderBy('created_at', 'desc')->paginate(10);
        $totalVillas = Villa::count();
        
        return view('admin.villas.index', compact('villas', 'totalVillas'));
    }
    
    public function create()
    {
        return view('admin.villas.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'price_min' => 'required|numeric|min:0',
            'price_max' => 'required|numeric|min:0|gte:price_min',
            'address' => 'required|string',
            'area' => 'required|numeric|min:0',
            'bedrooms' => 'required|integer|min:1',
            'bathrooms' => 'required|integer|min:1',
            'garage' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'swimming_pool' => 'boolean',
            'garden' => 'boolean',
            'location_score' => 'required|numeric|between:1,5',
            'facilities_score' => 'required|numeric|between:1,5',
            'accessibility_score' => 'required|numeric|between:1,5',
            'security_score' => 'required|numeric|between:1,5',
            'environment_score' => 'required|numeric|between:1,5',
            'is_active' => 'boolean'
        ]);
        
        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('villas', $filename, 'public');
            $data['image'] = $path;
        }
        
        // Set boolean values
        $data['swimming_pool'] = $request->has('swimming_pool');
        $data['garden'] = $request->has('garden');
        $data['is_active'] = $request->has('is_active');
        
        Villa::create($data);
        
        return redirect()->route('admin.villas.index')
                        ->with('success', 'Villa berhasil ditambahkan!');
    }
    
    public function show(Villa $villa)
    {
        return view('admin.villas.show', compact('villa'));
    }
    
    public function edit(Villa $villa)
    {
        return view('admin.villas.edit', compact('villa'));
    }
    
    public function update(Request $request, Villa $villa)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'price_min' => 'required|numeric|min:0',
            'price_max' => 'required|numeric|min:0|gte:price_min',
            'address' => 'required|string',
            'area' => 'required|numeric|min:0',
            'bedrooms' => 'required|integer|min:1',
            'bathrooms' => 'required|integer|min:1',
            'garage' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'swimming_pool' => 'boolean',
            'garden' => 'boolean',
            'location_score' => 'required|numeric|between:1,5',
            'facilities_score' => 'required|numeric|between:1,5',
            'accessibility_score' => 'required|numeric|between:1,5',
            'security_score' => 'required|numeric|between:1,5',
            'environment_score' => 'required|numeric|between:1,5',
            'is_active' => 'boolean'
        ]);
        
        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($villa->image && Storage::disk('public')->exists($villa->image)) {
                Storage::disk('public')->delete($villa->image);
            }
            
            $image = $request->file('image');
            $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('villas', $filename, 'public');
            $data['image'] = $path;
        }
        
        // Set boolean values
        $data['swimming_pool'] = $request->has('swimming_pool');
        $data['garden'] = $request->has('garden');
        $data['is_active'] = $request->has('is_active');
        
        $villa->update($data);
        
        return redirect()->route('admin.villas.index')
                        ->with('success', 'Villa berhasil diperbarui!');
    }
    
    public function destroy(Villa $villa)
    {
        // Delete image if exists
        if ($villa->image && Storage::disk('public')->exists($villa->image)) {
            Storage::disk('public')->delete($villa->image);
        }
        
        $villa->delete();
        
        return redirect()->route('admin.villas.index')
                        ->with('success', 'Villa berhasil dihapus!');
    }
    
    public function toggleStatus(Villa $villa)
    {
        $villa->update(['is_active' => !$villa->is_active]);
        
        $status = $villa->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()
                        ->with('success', "Villa berhasil {$status}!");
    }
    
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'villa_ids' => 'required|array',
            'villa_ids.*' => 'exists:villas,id'
        ]);
        
        $villas = Villa::whereIn('id', $request->villa_ids)->get();
        
        foreach ($villas as $villa) {
            // Delete image if exists
            if ($villa->image && Storage::disk('public')->exists($villa->image)) {
                Storage::disk('public')->delete($villa->image);
            }
            $villa->delete();
        }
        
        return redirect()->route('admin.villas.index')
                        ->with('success', 'Villa yang dipilih berhasil dihapus!');
    }
    
    public function export()
    {
        $villas = Villa::all();
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="villas_export_' . date('Y-m-d') . '.csv"'
        ];
        
        $callback = function() use ($villas) {
            $file = fopen('php://output', 'w');
            
            // Header CSV
            fputcsv($file, [
                'ID', 'Nama', 'Tipe', 'Harga Min', 'Harga Max', 'Alamat', 'Luas', 
                'Kamar Tidur', 'Kamar Mandi', 'Garasi', 'Kolam Renang', 'Taman',
                'Skor Lokasi', 'Skor Fasilitas', 'Skor Aksesibilitas', 'Skor Keamanan', 'Skor Lingkungan',
                'Status', 'Dibuat'
            ]);
            
            // Data CSV
            foreach ($villas as $villa) {
                fputcsv($file, [
                    $villa->id,
                    $villa->name,
                    $villa->type,
                    $villa->price_min,
                    $villa->price_max,
                    $villa->address,
                    $villa->area,
                    $villa->bedrooms,
                    $villa->bathrooms,
                    $villa->garage,
                    $villa->swimming_pool ? 'Ya' : 'Tidak',
                    $villa->garden ? 'Ya' : 'Tidak',
                    $villa->location_score,
                    $villa->facilities_score,
                    $villa->accessibility_score,
                    $villa->security_score,
                    $villa->environment_score,
                    $villa->is_active ? 'Aktif' : 'Tidak Aktif',
                    $villa->created_at->format('Y-m-d H:i:s')
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}
