<?php

use App\Http\Controllers\Api\V1\ClientsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('V1/client', ClientsController::class);
