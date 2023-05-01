<?php


use App\Http\Controllers\ClickController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/clicks', [ClickController::class, 'index'])->middleware('throttle:1000');

Route::post('/clicks', [ClickController::class, 'create'])->middleware('throttle:1000');
