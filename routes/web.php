<?php

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

Route::apiResources([
    'appartements' => ApartementsController::class,
    'clients' => ClientsController::class,
    'commandes' => CommandeController::class,
    'sejours' => SejoursController::class,
    'services' => ServicesController::class,
    'factures' => FacturesController::class,
    'ligne-facture' => LigneFactureController::class,
    'occupant' => OccupantController::class,
    'prestations' => PrestationController::class,
    'promotions' => PromotionController::class,
    // 'appartements' => ApartementsController::class,
    // 'appartements' => ApartementsController::class,
    // 'appartements' => ApartementsController::class,
    // 'appartements' => ApartementsController::class,
]);
