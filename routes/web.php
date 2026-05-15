<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
//Inclusion des class controllers
//
use App\Http\Controllers\AppartementsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\FournisseursController;
use App\Http\Controllers\DashboardCtrl;
use App\Http\Controllers\InventairesController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\EmployesController;
// use App\Http\Controllers\FacturesController;
// use App\Http\Controllers\LigneFactureController;
// use App\Http\Controllers\OccupantController;
// use App\Http\Controllers\PrestationController;
// use App\Http\Controllers\PromotionController;
// use App\Http\Controllers\AppartementsController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {

    Route::resource('clients', ClientsController::class);

    Route::post('/clients/list', [ClientsController::class, 'list'])->name('clients.list');
    Route::post('/clients/search', [ClientsController::class, 'search'])->name('clients.search');
    Route::post('/clients/state/{state}', [ClientsController::class, 'setState'])->name('clients.state');

    /*****************************************************************************/ 

    /*****************************************************************************/ 
    Route::get('/appartements/generate-id', [AppartementsController::class, 'generate_id'])->name('appartements.generate.id');
    Route::resource('appartements', AppartementsController::class);

    Route::post('/appartements/list', [AppartementsController::class, 'list'])->name('appartements.list');
    Route::post('/appartements/search', [AppartementsController::class, 'search'])->name('appartements.search');
    Route::post('/appartements/state', [AppartementsController::class, 'setState'])->name('appartements.state');

    /*****************************************************************************/ 
    /*****************************************************************************/ 
    Route::resource('fournisseurs', FournisseursController::class);

    Route::post('/fournisseurs/list', [FournisseursController::class, 'list'])->name('fournisseurs.list');
    Route::post('/fournisseurs/search', [FournisseursController::class, 'search'])->name('fournisseurs.search');
    Route::post('/fournisseurs/state', [FournisseursController::class, 'setState'])->name('fournisseurs.state');

    /*****************************************************************************/ 
    /*****************************************************************************/ 

    Route::get('/reservations/generate-id', [ReservationsController::class, 'generate_id'])->name('reservations.generate.id');
    
    Route::resource('reservations', ReservationsController::class);

    Route::post('/reservations/list', [ReservationsController::class, 'list'])->name('reservations.list');
    Route::post('/reservations/search', [ReservationsController::class, 'search'])->name('reservations.search');
    Route::post('/reservations/state', [ReservationsController::class, 'setState'])->name('reservations.state');
    /*****************************************************************************/ 
    /*****************************************************************************/ 
    Route::redirect('/','/dashboard');

    Route::get('/dashboard', [DashboardCtrl::class, 'index'])->name('dashboard');
    Route::post('/dashboard/search', [DashboardCtrl::class, 'search'])->name('dashboard.search');

    /**
     * 
     */
    Route::get('/inventaire/generate-id', [InventairesController::class, 'generate_id'])->name('inventaire.generate.id');
    Route::resource('inventaire', InventairesController::class);
    
    Route::post('/inventaire/list', [InventairesController::class, 'list'])->name('inventaire.list');
    Route::post('/inventaire/search', [InventairesController::class, 'search'])->name('inventaire.search');
    Route::post('/inventaire/state', [InventairesController::class, 'setState'])->name('inventaire.state');
    
    
    /**
     * 
    */
    Route::get('/commande/generate-id', [CommandeController::class, 'generate_id'])->name('commande.generate.id');

    Route::resource('commande', CommandeController::class);
    
    Route::post('/commande/list', [CommandeController::class, 'list'])->name('commande.list');
    Route::post('/commande/search', [CommandeController::class, 'search'])->name('commande.search');
    Route::post('/commande/state', [CommandeController::class, 'setState'])->name('commande.state');


    /**
     * 
     */
    // Route::get('/employes/generate-id', [CommandeController::class, 'generate_id'])->name('employes.generate.id');


    Route::resource('employes', EmployesController::class);

    Route::post('/employes/list', [EmployesController::class, 'list'])->name('employes.list');
    Route::post('/employes/search', [EmployesController::class, 'search'])->name('employes.search');
    Route::post('/employes/state', [EmployesController::class, 'setState'])->name('employes.state');

});



// Route::get('/', function () {
//     return view('starter.dashboardv1');
// })->name('dashboard');
// Route::view('/', 'starter')->name('starter');
Route::get('large-compact-sidebar/starter/blank-compact', function () {
    // set layout sesion(key)
    session(['layout' => 'compact']);
    return view('starter.blank-compact');
})->name('compact');

Route::get('large-sidebar/starter/blank-large', function () {
    // set layout sesion(key)
    session(['layout' => 'normal']);
    return view('starter.blank-large');
})->name('normal');

Route::get('horizontal-bar/starter/blank-horizontal', function () {
    // set layout sesion(key)
    session(['layout' => 'horizontal']);
    return view('starter.blank-horizontal');
})->name('horizontal');

Route::get('vertical/starter/blank-vertical', function () {
    // set layout sesion(key)
    session(['layout' => 'vertical']);
    return view('starter.blank-vertical');
})->name('vertical');









require __DIR__.'/auth.php';
