<?php

use App\Http\Controllers\Api\V1\ClientsController;
use App\Http\Controllers\InvoicesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('V1/client', ClientsController::class);
Route::post('statusPayment', [InvoicesController::class, 'statusPayment'])->name('statusPayment'); //Configurar Pago
