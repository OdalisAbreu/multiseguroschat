<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PoliciesController;
use App\Http\Controllers\ProvisionalErrorPoliciesController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/welcome', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});*/



Route::get('/', function () {
    return Inertia::render('index');
});

Route::get('/Terminos', function () {
    return Inertia::render('Terminos');
});

Route::get('/Politicas', function () {
    return Inertia::render('Politicas');
});

Route::resource('client', ClientController::class);
Route::post('policy/{marcaid}', [PoliciesController::class, 'index'])->name('policy');
Route::post('services/{insuresId}/{time}', [PoliciesController::class, 'services'])->name('services');
Route::post('servicespolicy', [PoliciesController::class, 'show'])->name('servicespolicy');
Route::post('servicesapprove', [PoliciesController::class, 'confirm'])->name('servicesapprove');
Route::post('generatepolicy', [PaymentController::class, 'cardNet'])->name('generatepolicy');
Route::get('car', [ClientController::class, 'index'])->name('car'); //Esto no va
Route::post('seguros', [ClientController::class, 'seller'])->name('seguros'); //Configurar seguro
Route::post('statusPayment', [InvoicesController::class, 'statusPayment'])->name('statusPayment'); //Configurar Pago
Route::post('generatePolicynew', [InvoicesController::class, 'statusPaymentCardNet'])->name('generatePolicynew'); //Genera la poliza

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

//--------------------------Retornos-------------------------------------------

Route::post('clientReturn', [ClientController::class, 'clientReturn'])->name('clientReturn'); //Retornar a Vista de datos del cliente
Route::post('carReturn', [PoliciesController::class, 'carReturn'])->name('carReturn'); // Retorna a la vista del vehiculo carReturn
Route::post('caseguradoraReturn', [PoliciesController::class, 'caseguradoraReturn'])->name('caseguradoraReturn'); //caseguradoraReturn
Route::post('serviciosReturn', [PoliciesController::class, 'serviciosReturn'])->name('serviciosReturn'); //serviciosReturn

//---------------------------------------------------------------------------------------

//--------------------------Actualizar Polizas -------------------------------------------
Route::get('seePolicy/{phone}', [PoliciesController::class, 'seePolicy'])->name('seePolicy');
Route::get('updatePolicy/{invoiceId}', [PoliciesController::class, 'updatePolicy'])->name('updatePolicy');
//---------------------------------------------------------------------------------------
//-----------------------------Redired a Index si intenta actualizar en un punto ----------------------------------
Route::get('policy/{marcaid}', function () {
    return Inertia::render('index');
});
Route::get('services/{insuresId}/{time}', function () {
    return Inertia::render('index');
});
Route::get('servicespolicy', function () {
    return Inertia::render('index');
});
Route::get('servicesapprove', function () {
    return Inertia::render('index');
});
Route::get('generatepolicy', function () {
    return Inertia::render('index');
});
Route::get('seguros', function () {
    return Inertia::render('index');
});
Route::get('statusPayment', function () {
    return Inertia::render('index');
});
Route::get('generatePolicynew', function () {
    return Inertia::render('end');
});
Route::get('carReturn', function () {
    return Inertia::render('index');
});
Route::get('clientReturn', function () {
    return Inertia::render('index');
});
Route::get('serviciosReturn', function () {
    return Inertia::render('index');
});
Route::get('caseguradoraReturn', function () {
    return Inertia::render('index');
});
// ----------------Solo para pruebas-------------------------------------------
Route::get('/end', function () {
    return Inertia::render('end');
});
Route::get('/test', function () {
    return Inertia::render('Welcome');
});
Route::get('/error', function () {
    return Inertia::render('Welcome', [
        'ResponseCode' => 00,
        'TransactionID' => 1311,
        'RemoteResponseCode' => 00,
        'AuthorizationCode' => 409615,
        'RetrivalReferenceNumber' => 000000000033,
        'TxToken' =>  'txn-8fe8af21ca484614b70eddd0286fa8ce'
    ]);
});
//Salida para la Poliza
Route::get('/poliza/{noPoliza}', [PoliciesController::class, 'verPoliza']);
//Route::post('statusPayment', [InvoicesController::class, 'waitingRoom'])->name('statusPayment'); //Ir al area de cargar

//----------------------------------------------------------------------------

// ------------------------------------- Rutas Administrativas -----------------------------------------

Route::get('/admin', function () {
    return Inertia::render('AdminPages/index');
})->middleware('auth');
Route::get('/admin/codigo', function () {
    return Inertia::render('AdminPages/codigos');
})->middleware('auth');
Route::get('/tarifas', function () {
    return Inertia::render('Tarifas/Tarifa');
})->middleware('auth');
Route::get('/admin/errorPolicies', [ProvisionalErrorPoliciesController::class, 'index'])->middleware('auth');
