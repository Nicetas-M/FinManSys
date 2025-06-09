<?php

use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\FinancialOperationController;
use App\Http\Controllers\IETypeController;
use App\Http\Controllers\TaxesPaymentController;
use App\Http\Controllers\TaxSchemaCompositionController;
use App\Http\Controllers\TaxSchemaController;
use App\Http\Controllers\TaxTypeController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/users', UserController::class);

Route::apiResource('/currencies', CurrencyController::class);

Route::apiResource('/users-accounts', UserAccountController::class);

Route::apiResource('/financial-operations', FinancialOperationController::class);

Route::apiResource('/tax-types', TaxTypeController::class);

Route::apiResource('/tax-schemas', TaxSchemaController::class);

Route::apiResource('/tax-schemas-compositions', TaxSchemaCompositionController::class);

//individual-entrepreneur-types
Route::apiResource('/ie-types', IETypeController::class);

Route::apiResource('/taxes-payments', TaxesPaymentController::class);




/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/
