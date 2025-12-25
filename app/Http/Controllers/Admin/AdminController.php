<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Criteria;
use App\Models\Villa;
use App\Models\CriteriaComparison;
use App\Models\UserPreference;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::where('role', 'user')->count(),
            'total_criteria' => Criteria::count(),
            'total_villas' => Villa::count(),
            'total_preferences' => UserPreference::count(),
            'recent_users' => User::where('role', 'user')->latest()->take(5)->get(),
            'recent_preferences' => UserPreference::with(['user', 'criteria'])->latest()->take(10)->get()
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function users()
    {
        $users = User::where('role', 'user')->with('preferences')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Cannot delete admin user');
        }
        
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully');
    }
}
