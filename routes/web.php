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
        return view('user.villas.index');
    })->name('user.villas.index');
    
    Route::get('/villa/{id}', function ($id) {
        return view('villa-detail', ['villaId' => $id]);
    })->name('villa.detail');
    
  
    // Comparison routes (AHP info for users)
    Route::get('/comparison', function () {
        return view('ahp-comparison');
    })->name('user.comparison.index');
    
    // Recommendations/Results routes
    Route::get('/results', function () {
        return view('results');
    })->name('results');
    Route::get('/recommendations', function () {
        return view('results');
    })->name('user.recommendations.index');
    
    // Compare villas
    Route::get('/compare', function () {
        return view('user.compare');
    })->name('user.compare.index');
    
    // About system
    Route::get('/about', function () {
        return view('user.about');
    })->name('user.about.index');
    
    // Favorites
    Route::get('/favorites', function () {
        return view('user.favorites');
    })->name('user.favorites.index');
    
    // History
    Route::get('/history', function () {
        return view('user.history');
    })->name('user.history.index');
});

// Admin Routes (requires admin role)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
    
    // Criteria Management
    Route::resource('criteria', CriteriaController::class)->except(['destroy']);
    Route::post('/criteria/{criteria}/toggle', [CriteriaController::class, 'toggleStatus'])->name('criteria.toggle');
    Route::delete('/criteria/{id}', [CriteriaController::class, 'destroy'])->name('criteria.delete');
    Route::post('/criteria/update-order', [CriteriaController::class, 'updateOrder'])->name('criteria.update-order');
    
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
