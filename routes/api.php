<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContractsController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function(){
    Route::post('/login', 'login');
    Route::post('/register', 'register');
});

Route::middleware(AuthMiddleware::class)->group(function(){
    Route::get('logout', [AuthController::class, 'logout']);

    Route::controller(ContractsController::class)->prefix('contracts')->group(function(){
        Route::get('{uuid}', 'get');
        Route::get('/', 'all');
        Route::post('/', 'create');
        Route::put('{uuid}', 'update');
        Route::delete('{uuid}', 'delete');
    });
});
