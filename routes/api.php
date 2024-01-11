<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\PortfolioController;
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

Route::get('info', [ApiController::class, 'getInfo']);
Route::get('job-experience', [ApiController::class, 'getJobExperience']);
Route::post('send-message', [ApiController::class, 'sendMessage']);


Route::controller(PortfolioController::class)
    ->prefix('projects')
    ->group(function () {
        Route::get('/', 'getPortfolio');
        Route::post('/store', 'storeProject');
        Route::post('/update/{portfolio}', 'updateProject');
        Route::delete('/delete/{portfolio}', 'destroyProject');
    });