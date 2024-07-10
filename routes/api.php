<?php

use App\Http\Controllers\Api\ProductApiController;
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

Route::get('products', [ProductApiController::class, 'index']);
Route::post('products', [ProductApiController::class, 'store']);
Route::put('product-edit/{id}', [ProductApiController::class, 'update']);
Route::delete('remove-product/{id}', [ProductApiController::class, 'deleteProduct']);

Route::prefix("posts")->group(function () {
    Route::post("/", [ProductApiController::class, 'index']);
    Route::post("/create", [ProductApiController::class, 'index']);
});
