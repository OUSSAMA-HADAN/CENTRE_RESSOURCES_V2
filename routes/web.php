<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\RechercheController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CandidatController;
use App\Http\Controllers\Admin\AdminRechercheController;
use App\Http\Controllers\Admin\AdminDocumentationController;
use App\Http\Controllers\Admin\AdminFormationController;
use App\Http\Controllers\Admin\ResourceController;
use App\Http\Controllers\Admin\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');


// Language switcher route (public side only)
Route::get('/language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'fr', 'ar'])) { // Add your supported languages here
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('language.switch');


// Inscription Routes

// Public Recherche Routes
Route::get('/recherche', [RechercheController::class, 'index'])->name('recherche.index');
Route::get('/recherche/{recherche}', [RechercheController::class, 'show'])->name('recherche.show');

// Public Documentation Routes
Route::get('/documentation', [DocumentationController::class, 'index'])->name('documentation.index');
Route::get('/documentation/{document}', [DocumentationController::class, 'show'])->name('documentation.show');
Route::get('/documentation/ressource/{ressource}', [DocumentationController::class, 'showResource'])->name('documentation.resource');

// Public Formation Routes
Route::get('/formation', [FormationController::class, 'index'])->name('formation.index');
Route::get('/formation/{slug}', [FormationController::class, 'show'])->name('formation.show');
// Admin Authentication
Route::get('/auth/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/auth/login', [LoginController::class, 'login']);
Route::post('auth/logout', [LoginController::class, 'logout'])->name('logout');


// Admin Routes (Protected)
Route::prefix('admin')->middleware(['auth:admin'])->name('admin.')->group(function () {    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Candidats Management
    Route::get('/candidats', [CandidatController::class, 'index'])->name('candidats.index');
    Route::get('/candidats/{candidat}', [CandidatController::class, 'show'])->name('candidats.show');
    Route::get('/candidats/{candidat}/edit', [CandidatController::class, 'edit'])->name('candidats.edit');
    Route::put('/candidats/{candidat}', [CandidatController::class, 'update'])->name('candidats.update');
    Route::delete('/candidats/{candidat}', [CandidatController::class, 'destroy'])->name('candidats.destroy');

    // Admin Recherche Management
    Route::get('/recherche', [AdminRechercheController::class, 'index'])->name('recherche.index');
    Route::get('/recherche/create', [AdminRechercheController::class, 'create'])->name('recherche.create');
    Route::post('/recherche', [AdminRechercheController::class, 'store'])->name('recherche.store');
    Route::get('/recherche/{recherche}/edit', [AdminRechercheController::class, 'edit'])->name('recherche.edit');
    Route::put('/recherche/{recherche}', [AdminRechercheController::class, 'update'])->name('recherche.update');
    Route::delete('/recherche/{recherche}', [AdminRechercheController::class, 'destroy'])->name('recherche.destroy');



            // Routes pour les éducatrices
            Route::get('/educatrices', [App\Http\Controllers\Admin\EducatriceAdminController::class, 'index'])
            ->name('educatrices.index');
        
        Route::get('/educatrices/{educatrice}', [App\Http\Controllers\Admin\EducatriceAdminController::class, 'show'])
            ->name('educatrices.show');
        
        Route::get('/educatrices/{educatrice}/edit', [App\Http\Controllers\Admin\EducatriceAdminController::class, 'edit'])
            ->name('educatrices.edit');
        
        Route::put('/educatrices/{educatrice}', [App\Http\Controllers\Admin\EducatriceAdminController::class, 'update'])
            ->name('educatrices.update');
        
        Route::delete('/educatrices/{educatrice}', [App\Http\Controllers\Admin\EducatriceAdminController::class, 'destroy'])
            ->name('educatrices.destroy');
        
        Route::get('/educatrices-export', [App\Http\Controllers\Admin\EducatriceAdminController::class, 'export'])
            ->name('educatrices.export');
        
        
        
        





    Route::prefix('/documentation')->name('documentation.')->group(function () {
        // Index - List of publications and resources
        Route::get('/', [App\Http\Controllers\Admin\AdminDocumentationController::class, 'index'])
            ->name('index');

        // Publications routes
        Route::get('/publications/create', [App\Http\Controllers\Admin\AdminDocumentationController::class, 'createPublication'])
            ->name('publications.create');
        Route::post('/publications', [App\Http\Controllers\Admin\AdminDocumentationController::class, 'storePublication'])
            ->name('publications.store');
        Route::get('/publications/{publication}/edit', [App\Http\Controllers\Admin\AdminDocumentationController::class, 'editPublication'])
            ->name('publications.edit');
        Route::put('/publications/{publication}', [App\Http\Controllers\Admin\AdminDocumentationController::class, 'updatePublication'])
            ->name('publications.update');
        Route::delete('/publications/{publication}', [App\Http\Controllers\Admin\AdminDocumentationController::class, 'destroyPublication'])
            ->name('publications.destroy');

        // Resources routes
        Route::get('/resources/create', [App\Http\Controllers\Admin\AdminDocumentationController::class, 'createResource'])
            ->name('resources.create');
        Route::post('/resources', [App\Http\Controllers\Admin\AdminDocumentationController::class, 'storeResource'])
            ->name('resources.store');
        Route::get('/resources/{resource}/edit', [App\Http\Controllers\Admin\AdminDocumentationController::class, 'editResource'])
            ->name('resources.edit');
        Route::put('/resources/{resource}', [App\Http\Controllers\Admin\AdminDocumentationController::class, 'updateResource'])
            ->name('resources.update');
        Route::delete('/resources/{resource}', [App\Http\Controllers\Admin\AdminDocumentationController::class, 'destroyResource'])
            ->name('resources.destroy');
            Route::get('/resources/{resource}/download', [App\Http\Controllers\Admin\AdminDocumentationController::class, 'downloadResource'])
        ->name('resources.download');




 


    });




    // Admin Formation Management
    Route::get('/formations', [AdminFormationController::class, 'index'])->name('formations.index');
    Route::get('/formations/create', [AdminFormationController::class, 'create'])->name('formations.create');
    Route::post('/formations', [AdminFormationController::class, 'store'])->name('formations.store');
    Route::get('/formations/{formation}/edit', [AdminFormationController::class, 'edit'])->name('formations.edit');
    Route::put('/formations/{formation}', [AdminFormationController::class, 'update'])->name('formations.update');
    Route::delete('/formations/{formation}', [AdminFormationController::class, 'destroy'])->name('formations.destroy');
});








// Route pour afficher le formulaire d'inscription approprié selon le type
Route::get('/inscription/{type?}', function ($type = null) {
    if ($type === 'educatrice') {
        return app(App\Http\Controllers\EducatriceController::class)->create();
    } else {
        return app(App\Http\Controllers\ApplicantController::class)->create();
    }
})->name('inscription.form');

Route::post('/inscription', [ApplicantController::class, 'store'])->name('inscription.store');

// Route pour enregistrer une éducatrice
Route::post('/inscription/educatrice', [App\Http\Controllers\EducatriceController::class, 'store'])
    ->name('inscription.educatrice.store');
