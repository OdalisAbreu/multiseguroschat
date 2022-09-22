<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PoliciesController;
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

Route::get('/welcome', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/', function () {
    return Inertia::render('index');
});

//Route::get('client/{phone}', [ClientController::class, 'show'])->name('client');
Route::resource('client', ClientController::class);
Route::post('policy/{marcaid}', [PoliciesController::class, 'index'])->name('policy');
//Route::post('services', [PoliciesController::class, 'services'])->name('services');
Route::post('services/{insuresId}', [PoliciesController::class, 'services'])->name('services');
Route::post('servicespolicy', [PoliciesController::class, 'show'])->name('servicespolicy');
Route::post('generatepolicy', [PaymentController::class, 'cardNet'])->name('generatepolicy');


Route::get('car', [ClientController::class, 'index'])->name('car');//Esto no va

Route::post('seguros', [ClientController::class, 'seller'])->name('seguros'); //Configurar seguro
Route::post('statusPayment', [InvoicesController::class, 'statusPayment'])->name('statusPayment'); //Configurar Pago

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');


// ----------------Solo para pruebas-------------------------------------------
Route::get('/end', function () {
    return Inertia::render('end');
});

Route::post('/test', [PoliciesController::class, 'test'])->name('test');

//----------------------------------------------------------------------------