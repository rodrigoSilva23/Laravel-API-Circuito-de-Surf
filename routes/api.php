<?php

use App\Http\Controllers\BatteryController;
use App\Http\Controllers\GradesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurferController;
use App\Http\Controllers\WavesController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['api'])->group(function () {
    // // Rotas que não requerem autenticação
     Route::resource("surfers", SurferController::class);
     Route::resource("batteries", BatteryController::class);
     Route::resource("waves", WavesController::class);
     Route::resource("grades", GradesController::class);
     Route::get("batteries/winner/{id}", [BatteryController::class,'batteryWinner']);
});
