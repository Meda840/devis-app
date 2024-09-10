<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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
Route::post('/logout', function (Request $request) {
    $request->session()->invalidate(); // Clear session
    $request->session()->regenerateToken(); // Regenerate CSRF token
    return response()->json(['message' => 'Logged out successfully']);
});
Route::middleware('auth:sanctum')->get('/user/companies', [DashboardController::class, 'getUserWithCompanies']);
Route::middleware('auth:sanctum')->put('/user', [AuthController::class, 'updateUser']);
Route::middleware('auth:sanctum')->post('/companies', [DashboardController::class, 'storeCompany']);
Route::middleware('auth:sanctum')->put('companies/{id}', [DashboardController::class, 'updateCompany']);

Route::get('/hello', [DevisController::class, 'index']);
Route::get('/currencies', [DevisController::class, 'getAllCurrencies']);
Route::get('/services',[DevisController::class, 'getAllServices']);
Route::post('/devis', [DevisController::class, 'store']);
Route::get('/generate-pdf/{id}', [DevisController::class, 'generatePdf']);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);