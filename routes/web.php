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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource('clients', ClientsController::class)->middleware(['auth']);




require __DIR__.'/auth.php';
