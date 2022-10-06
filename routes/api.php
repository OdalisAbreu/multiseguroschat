<?php

use App\Http\Controllers\Api\V1\ClientsController;
use App\Http\Controllers\InvoicesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;

Route::apiResource('V1/client', ClientsController::class);
Route::post('statusPayment', [InvoicesController::class, 'waitingRoom'])->name('statusPayment'); //Ir al area de cargar
Route::get('V1/getpolicy/{cedula}', [ClientsController::class, 'clientPilicy'])->name('getpolicy');// Ruta optner poliza 
Route::get('V1/invoice/{poliza}', [InvoicesController::class, 'getInvoice']); // optiene los datos de la factura 

