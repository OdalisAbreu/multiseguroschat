<?php

use App\Http\Controllers\Api\V1\ClientsController;
use App\Http\Controllers\InvoicesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Jetstream\Rules\Role;

Route::apiResource('V1/client', ClientsController::class);
Route::get('V1/client/{id}/{idConversacion}', [ClientsController::class,'show']);
Route::get('V1/getpolicy/{cedula}', [ClientsController::class, 'clientPilicy'])->name('getpolicy');// Ruta optner poliza 
Route::get('V1/invoice/{poliza}', [InvoicesController::class, 'getInvoice']); // optiene los datos de la factura 

Route::post('statusPayment', [InvoicesController::class, 'waitingRoom']); //Ir al area de cargar
//-----------------------------Redired a Index si intenta actualizar en un punto ----------------------------------
Route::get('statusPayment', function () {return Inertia::render('index');});

//-----------------------------Generar la Imagen de la poliza ----------------------------------
Route::get('V1/enviarIdPolizaBot/{idPoliza}/{idConversacion}', [ClientsController::class,'enviarIdPolizaBot']);
Route::get('V1/getPolizaImage/{idPoliza}', [ClientsController::class,'getPolizaImage']);
Route::post('V1/savePolizaImage', [ClientsController::class,'savePolizaImage']);
