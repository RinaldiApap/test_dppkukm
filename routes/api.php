<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DashboardController as DBC;
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

Route::get("chart/top_event", [DBC::class, "topevent"]);
Route::get("chart/transaksibulanan", [DBC::class, "transaksibulanan"]);
Route::get("chart/jmlnamausaha", [DBC::class, "jmlnamausaha"]);