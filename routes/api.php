<?php

use App\Http\Controllers\ApiController;
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
Route::get('projects', [ApiController::class, 'getPortfolio']);
Route::post('send-message', [ApiController::class, 'sendMessage']);