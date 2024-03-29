<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SendPhoneCodeController;
use App\Http\Controllers\ValidatePhoneCodeController;
use App\Http\Controllers\VinValidateController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/register', [RegisterController::class, '__invoke']);
Route::post('/auth/login', [LoginController::class, '__invoke']);
Route::post('/auth/validate-phone-code', [ValidatePhoneCodeController::class, '__invoke']);
Route::post('/auth/send-phone-code', [SendPhoneCodeController::class, '__invoke']);
Route::middleware('auth:sanctum')->get('/auth/logout', [LogoutController::class, '__invoke']);
Route::middleware('auth:sanctum')->post('/vin/validate', [VinValidateController::class, '__invoke']);



