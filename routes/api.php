<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/tokens/create', function (Request $request) {

    $token = $request->user()->createToken($request->token_name);
 
    return ['token' => $token->plainTextToken];
    
});


Route::apiResource('clients', ClientsController::class);