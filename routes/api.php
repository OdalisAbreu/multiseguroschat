<?php

use App\Http\Controllers\Api\V1\ClientsController;
use App\Http\Controllers\DiscountsController;
use App\Http\Controllers\InvoicesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Jetstream\Rules\Role;

Route::post('V1/client', [ClientsController::class, 'store']);
Route::get('V1/client/{id}/{idConversacion}', [ClientsController::class, 'show']);
Route::get('V1/getpolicy/{cedula}', [ClientsController::class, 'clientPilicy'])->name('getpolicy'); // Ruta optner poliza 
Route::get('V1/invoice/{poliza}', [InvoicesController::class, 'getInvoice']); // optiene los datos de la factura 

Route::post('statusPayment', [InvoicesController::class, 'waitingRoom']); //Ir al area de cargar
//-----------------------------Redired a Index si intenta actualizar en un punto ----------------------------------
Route::get('statusPayment', function () {
    return Inertia::render('index');
});

Route::get('V1/aplicardescuento/{id}/{descuento}/{totalGeneral}', [InvoicesController::class, 'aplicarDescuento']);

//-----------------------------Generar la Imagen de la poliza ----------------------------------
Route::get('V1/enviarIdPolizaBot/{idPoliza}/{idConversacion}', [ClientsController::class, 'enviarIdPolizaBot']);
Route::get('V1/getPolizaImage/{idPoliza}', [ClientsController::class, 'getPolizaImage']);
Route::post('V1/savePolizaImage', [ClientsController::class, 'savePolizaImage']);
Route::get('V1/enviarIdPolizaBotCity/{idPoliza}/{celualar}', [ClientsController::class, 'enviarIdPolizaBotCity']);
Route::get('V1/generarPdf/{idPoliza}', [ClientsController::class, 'generarPdf']);
Route::post('V1/enviarMensajeBotCitie', [ClientsController::class, 'enviarMensajeBotCitie']);
Route::post('V1/enviarArchivoBotCitie', [ClientsController::class, 'enviarArchivoBotCitie']);
Route::get('V1/confirmarPositivo/{phone}', [ClientsController::class, 'confirmarPositivo']);
Route::get('V1/confirmarNegativo/{phone}', [ClientsController::class, 'confirmarNegativo']);
Route::get('V1/desactivarSesion/{idClient}', [ClientsController::class, 'desactivarSesion']);
Route::get('V1/validarVista/{idClient}/{vista}', [ClientsController::class, 'validarVista']);
Route::get('V1/validarCesion/{id}', [ClientsController::class, 'validarCesion']);

//------------------------------------Uso Interno ----------------------------------------------------------------
Route::resource('internal/codigoDescuento', DiscountsController::class);
