<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('login', 'AuthenticatorController@login');
// Route::post('validateToken', 'AuthenticatorController@validateToken');

Route::group(['middleware' => 'jwt'], function () {

    Route::group(['prefix' => 'products'], function () {
        Route::get('list-products', 'ProductsController@listProducts');
        Route::get('select-product', 'ProductsController@selectProductById');
        Route::post('create-products', 'ProductsController@createProduct');
        Route::put('update-products', 'ProductsController@updateProduct');
        Route::post('delete-products', 'ProductsController@deleteProduct');
    });
});
