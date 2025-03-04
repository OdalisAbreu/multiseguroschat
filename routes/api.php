<?php

use App\Http\Controllers\AccesTokenController;
use App\Http\Controllers\Api\V1\ClientsController;
use App\Http\Controllers\Api\V1\PolicyRenewController;
use App\Http\Controllers\Api\V1\PriceCOntroller;
use App\Http\Controllers\DiscountsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\PoliciesController;
use App\Services\PoliceServices\RenewServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Jetstream\Rules\Role;

Route::post('V1/client', [ClientsController::class, 'store']);
Route::get('V1/client/{id}/{idConversacion}', [ClientsController::class, 'show']);
Route::get('V1/getpolicy/{cedula}', [ClientsController::class, 'clientPilicy'])->name('getpolicy'); // Ruta optner poliza 
Route::get('V1/invoice/{poliza}', [InvoicesController::class, 'getInvoice']); // optiene los datos de la factura 
Route::get('V1/UpdateDescuento/{id}', [DiscountsController::class, 'UpdateDescuento']); // Actualiza en Multiseguro el codigo de descuento si aplica
Route::post('statusPayment', [InvoicesController::class, 'waitingRoom']); //Ir al area de cargar
//-----------------------------Redired a Index si intenta actualizar en un punto ----------------------------------
Route::get('statusPayment', function () {
    return Inertia::render('index');
});

Route::get('V1/aplicardescuento/{id}/{descuento}/{totalGeneral}', [InvoicesController::class, 'aplicarDescuento']);

//-----------------------------Generar la Imagen de la poliza ----------------------------------
Route::get('V1/enviarIdPolizaBot/{idPoliza}/{idConversacion}', [ClientsController::class, 'enviarIdPolizaBot']);
Route::get('V1/getPolizaImage/{idPoliza}', [ClientsController::class, 'getPolizaImage']);
Route::get('V1/enviarIdPolizaBotCity/{idPoliza}/{celualar}', [ClientsController::class, 'enviarIdPolizaBotCity']);
Route::get('V1/confirmarPositivo/{phone}', [ClientsController::class, 'confirmarPositivo']);
Route::get('V1/confirmarNegativo/{phone}', [ClientsController::class, 'confirmarNegativo']);
Route::get('V1/desactivarSesion/{idClient}', [ClientsController::class, 'desactivarSesion']);
Route::get('V1/validarVista/{idClient}/{vista}', [ClientsController::class, 'validarVista']);
Route::get('V1/validarCesion/{id}', [ClientsController::class, 'validarCesion']);
Route::post('V1/invoices', [InvoicesController::class, 'getInvoices']);
Route::get('V1/invoice/{id}', [InvoicesController::class, 'getInvoice']);
Route::resource('V1/prices', PriceCOntroller::class);
Route::get('generateoken', [AccesTokenController::class, 'generateToken']);

//------------------------------------Crom Job Renovar Poliza ----------------------------------------------------------------

Route::get('V1/sendMessengerRenew', [PolicyRenewController::class, 'sendMessengerRenew']);

//----------------------------------- Generar Poliza ---------------------------------------------------------
Route::get('V1/generateDocumentPolicy/{police_number}', [PoliciesController::class, 'generateDocumentPolicy']);
//------------------------------------Uso Interno ----------------------------------------------------------------
Route::resource('internal/codigoDescuento', DiscountsController::class);
Route::get('accesoCarnet/{id}', [ClientsController::class, 'accesoCarnet']);
Route::get('accesoCarnetUpdate/{id}', [ClientsController::class, 'accesoCarnetUpdate']);
Route::get('desactivarSesionClientes', [ClientsController::class, 'desactivarSesionClientes']);
Route::post('UpdatePolice', [PolicyRenewController::class, 'UpdatePolice']);
