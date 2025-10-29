<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\EducatriceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EducatriceAdminController;
use App\Http\Controllers\Admin\AdminDocumentationController;
use App\Http\Controllers\Admin\AdminFormationController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Language Switcher
Route::get('/language/{locale}', function ($locale) {
    if (in_array($locale, ['fr', 'ar'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }
    return redirect()->back();
})->name('language.switch');

// Inscription Routes (Public)
Route::prefix('inscription')->name('inscription.')->group(function () {
    Route::get('/', [EducatriceController::class, 'create'])->name('form');
    Route::post('/', [EducatriceController::class, 'store'])->name('store');
    // Alias for backward compatibility
    Route::post('/educatrice', [EducatriceController::class, 'store'])->name('educatrice.store');
});


// Documentation Routes (Public)
Route::prefix('documentation')->name('documentation.')->group(function () {
    Route::get('/', [DocumentationController::class, 'index'])->name('index');
    Route::get('/ressource/{slug}', [DocumentationController::class, 'showResource'])->name('resource');
    Route::get('/ressource/{slug}/download', [DocumentationController::class, 'downloadResource'])->name('resource.download');
});

// Formation Routes (Public)
Route::prefix('formation')->name('formation.')->group(function () {
    Route::get('/', [FormationController::class, 'index'])->name('index');
    Route::get('/{slug}', [FormationController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth:admin'])->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
/*
|--------------------------------------------------------------------------
| Éducatrices Management
|--------------------------------------------------------------------------
*/
Route::prefix('educatrices')->name('educatrices.')->group(function () {
    Route::get('/', [EducatriceAdminController::class, 'index'])->name('index');
    Route::get('/export-excel', [EducatriceAdminController::class, 'exportExcel'])->name('export-excel');
    Route::post('/bulk-action', [EducatriceAdminController::class, 'bulkAction'])->name('bulk-action');
    Route::get('/{educatrice}', [EducatriceAdminController::class, 'show'])->name('show');
    Route::get('/{educatrice}/edit', [EducatriceAdminController::class, 'edit'])->name('edit');
    Route::put('/{educatrice}', [EducatriceAdminController::class, 'update'])->name('update');
    Route::patch('/{educatrice}/status', [EducatriceAdminController::class, 'updateStatus'])->name('update-status');
    Route::delete('/{educatrice}', [EducatriceAdminController::class, 'destroy'])->name('destroy');
});

// Alias routes for backward compatibility
Route::prefix('candidats')->name('candidats.')->group(function () {
    Route::get('/', [EducatriceAdminController::class, 'index'])->name('index');
    Route::get('/export-excel', [EducatriceAdminController::class, 'exportExcel'])->name('export-excel');
    Route::post('/bulk-action', [EducatriceAdminController::class, 'bulkAction'])->name('bulk-action');
    Route::get('/{educatrice}', [EducatriceAdminController::class, 'show'])->name('show');
    Route::get('/{educatrice}/edit', [EducatriceAdminController::class, 'edit'])->name('edit');
    Route::put('/{educatrice}', [EducatriceAdminController::class, 'update'])->name('update');
    Route::delete('/{educatrice}', [EducatriceAdminController::class, 'destroy'])->name('destroy');
});

    /*
    |--------------------------------------------------------------------------
    | Documentation Management
    |--------------------------------------------------------------------------
    */
    Route::prefix('documentation')->name('documentation.')->group(function () {
        // Main index
        Route::get('/', [AdminDocumentationController::class, 'index'])->name('index');


        // Resources Management
        Route::prefix('resources')->name('resources.')->group(function () {
            Route::get('/create', [AdminDocumentationController::class, 'createResource'])->name('create');
            Route::post('/', [AdminDocumentationController::class, 'storeResource'])->name('store');
            Route::get('/{resource}/edit', [AdminDocumentationController::class, 'editResource'])->name('edit');
            Route::put('/{resource}', [AdminDocumentationController::class, 'updateResource'])->name('update');
            Route::delete('/{resource}', [AdminDocumentationController::class, 'destroyResource'])->name('destroy');
            Route::get('/{resource}/download', [AdminDocumentationController::class, 'downloadResource'])->name('download');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Formations Management
    |--------------------------------------------------------------------------
    */
    Route::prefix('formations')->name('formations.')->group(function () {
        Route::get('/', [AdminFormationController::class, 'index'])->name('index');
        Route::get('/create', [AdminFormationController::class, 'create'])->name('create');
        Route::post('/', [AdminFormationController::class, 'store'])->name('store');
        Route::get('/{formation}/edit', [AdminFormationController::class, 'edit'])->name('edit');
        Route::put('/{formation}', [AdminFormationController::class, 'update'])->name('update');
        Route::delete('/{formation}', [AdminFormationController::class, 'destroy'])->name('destroy');
    });
});


