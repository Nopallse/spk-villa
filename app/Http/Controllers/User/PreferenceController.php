<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use App\Models\Villa;
use App\Models\UserPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreferenceController extends Controller
{
    public function index()
    {
        $criteria = Criteria::active()->ordered()->get();
        $villas = Villa::available()->get();
        $userPreferences = UserPreference::where('user_id', Auth::id())
                                        ->with(['criteria', 'villa'])
                                        ->get()
                                        ->keyBy(function($item) {
                                            return $item->criteria_id . '-' . ($item->villa_id ?? '0');
                                        });
        
        return view('preferences', compact('criteria', 'villas', 'userPreferences'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'preferences' => 'required|array',
            'preferences.*.criteria_id' => 'required|exists:criteria,id',
            'preferences.*.villa_id' => 'nullable|exists:villas,id',
            'preferences.*.preference_value' => 'required|integer|min:1|max:5'
        ]);

        foreach ($request->preferences as $preference) {
            UserPreference::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'criteria_id' => $preference['criteria_id'],
                    'villa_id' => $preference['villa_id'] ?? null
                ],
                [
                    'preference_value' => $preference['preference_value'],
                    'notes' => $preference['notes'] ?? null
                ]
            );
        }

        return redirect()->route('preferences')
                        ->with('success', 'Preferences saved successfully!');
    }
}
