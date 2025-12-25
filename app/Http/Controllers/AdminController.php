<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard(): View
    {
        return view('admin-dashboard');
    }

    /**
     * Display the villa management page.
     */
    public function villas(): View
    {
        return view('admin.villas');
    }
}