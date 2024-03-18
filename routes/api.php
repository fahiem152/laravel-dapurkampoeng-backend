<?php

use App\Http\Controllers\Api\DiscountController;
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
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::apiResource('/api-products', App\Http\Controllers\Api\ProductController::class)->middleware('auth:sanctum');

Route::apiResource('/api-categories', App\Http\Controllers\Api\CategoryController::class)->middleware('auth:sanctum');


Route::post('/save-order', [App\Http\Controllers\Api\OrderController::class, 'saveOrder'])->middleware('auth:sanctum');
Route::get('/api-discounts', [App\Http\Controllers\Api\DiscountController::class, 'index'])->middleware('auth:sanctum');
Route::post('/api-discounts', [App\Http\Controllers\Api\DiscountController::class, 'store'])->middleware('auth:sanctum');
Route::put('/api-discounts/{discount}', [DiscountController::class, 'update']);
Route::delete('/api-discounts/{discount}', [DiscountController::class, 'destroy']);

Route::get('/orders/{date?}', [App\Http\Controllers\Api\OrderController::class, 'index'])->middleware('auth:sanctum');
Route::get('/summary/{date?}', [App\Http\Controllers\Api\OrderController::class, 'summary'])->middleware('auth:sanctum');
Route::get('/order-item/{date?}', [App\Http\Controllers\Api\OrderItemController::class, 'index'])->middleware('auth:sanctum');
Route::get('/order-sales', [App\Http\Controllers\Api\OrderItemController::class, 'orderSales'])->middleware('auth:sanctum');
