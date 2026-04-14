<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
//Inclusion des class controllers
//
use App\Http\Controllers\ApartementsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\SejoursController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\FacturesController;
use App\Http\Controllers\LigneFactureController;
use App\Http\Controllers\OccupantController;
use App\Http\Controllers\PrestationController;
use App\Http\Controllers\PromotionController;
// use App\Http\Controllers\ApartementsController;
// use App\Http\Controllers\ApartementsController;
// use App\Http\Controllers\ApartementsController;
// use App\Http\Controllers\ApartementsController;

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
    Route::post('/clients/activate', [ClientsController::class, 'setState'])->name('clients.activate');
    Route::post('/clients/deactivate', [ClientsController::class, 'setState'])->name('clients.deactivate');
    // Route::patch('/profile', [ClientsController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ClientsController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () {
    return view('starter.dashboardv1');
})->name('dashboard');
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
