<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\AuthController;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();


});

Route::get('/hello', [DevisController::class, 'index']);
Route::get('/currencies', [DevisController::class, 'getAllCurrencies']);
Route::get('/services',[DevisController::class, 'getAllServices']);
Route::post('/devis', [DevisController::class, 'store']);
Route::get('/generate-pdf/{id}', [DevisController::class, 'generatePdf']);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::get('/user-info', [AuthController::class, 'getUserInfo']);