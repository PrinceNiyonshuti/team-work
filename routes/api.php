<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/company', [CompanyController::class, 'index']);
// Route::post('/company', [CompanyController::class, 'store']);
// Route::put('/company', [CompanyController::class, 'update']);
// Route::delete('/company', [CompanyController::class, 'destroy']);

Route::resource('/company', CompanyController::class);
