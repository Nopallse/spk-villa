<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CriteriaController;
use App\Http\Controllers\Admin\VillaController;
use App\Http\Controllers\Admin\PairwiseController;
use App\Http\Controllers\Admin\AHPController;
use App\Http\Controllers\User\PreferenceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// User Routes (requires user role)
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Villa routes for users
    Route::get('/villas', function () {
        return view('results'); // Show villas list
    })->name('user.villas.index');
    
    Route::get('/villa/{id}', function ($id) {
        return view('villa-detail', ['villaId' => $id]);
    })->name('villa.detail');
    
    // Preferences routes
    Route::get('/preferences', [PreferenceController::class, 'index'])->name('preferences');
    Route::get('/preferences', [PreferenceController::class, 'index'])->name('user.preferences.index'); // Alias
    Route::post('/preferences', [PreferenceController::class, 'store'])->name('preferences.store');
    
    // Comparison routes (AHP for users)
    Route::get('/comparison', function () {
        return view('ahp-comparison');
    })->name('user.comparison.index');
    
    // Recommendations/Results routes
    Route::get('/results', function () {
        return view('results');
    })->name('results');
    Route::get('/recommendations', function () {
        return view('results'); // Same as results
    })->name('user.recommendations.index');
});

// Admin Routes (requires admin role)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
    
    // Criteria Management
    Route::resource('criteria', CriteriaController::class);
    Route::post('/criteria/{criteria}/toggle', [CriteriaController::class, 'toggleStatus'])->name('criteria.toggle');
    Route::delete('/criteria/{criteria}', [CriteriaController::class, 'destroy'])->name('criteria.delete');
    
    // Villa Management
    Route::resource('villas', VillaController::class);
    Route::patch('villas/{villa}/toggle-status', [VillaController::class, 'toggleStatus'])->name('villas.toggle-status');
    Route::delete('villas/bulk-delete', [VillaController::class, 'bulkDelete'])->name('villas.bulk-delete');
    Route::get('villas/export/csv', [VillaController::class, 'export'])->name('villas.export');
    
    // AHP Analysis (Pairwise Comparison)
    Route::get('/ahp-comparison', [AHPController::class, 'index'])->name('ahp-comparison.index');
    Route::post('/ahp-comparison/save', [AHPController::class, 'save'])->name('ahp-comparison.save');
    Route::post('/ahp-comparison/calculate', [AHPController::class, 'calculate'])->name('ahp-comparison.calculate');
    Route::post('/ahp-comparison/apply', [AHPController::class, 'apply'])->name('ahp-comparison.apply');
});

// Profile Routes (any authenticated user)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
