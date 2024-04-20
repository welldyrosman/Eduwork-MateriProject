<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTagController;
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

Route::get('products/{barcode}', [ProductController::class, 'getProduct']);

Route::middleware('auth:api')->group(function () {
    Route::get('admin/products', [ProductController::class, 'getProducts']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::post('login', [AuthController::class, 'login']);
Route::get('products', [ProductController::class, 'getProducts']);
Route::post('products', [ProductController::class, 'saveProducts']);

Route::post('addcart', [CartController::class, 'addCart']);
Route::get('carts', [CartController::class, 'getall']);
Route::post('checkout', [CartController::class, 'checkout']);

Route::delete('products/{product_id}/{tag_id}', [ProductTagController::class, 'removetag']);
Route::post('products/{product_id}', [ProductTagController::class, 'removetag2']);
Route::post('deleteproducts', [ProductTagController::class, 'removetag3']);
Route::delete('deletebyproducttag/{producttag_id}', [ProductTagController::class, 'removetag4']);
