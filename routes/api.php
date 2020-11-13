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


Route::get('/products', 'ProductController@index');
Route::get('/products/{product}', 'ProductController@show')->name('products.show');

Route::post('auth/register','AuthController@register');
Route::post('auth/login','AuthController@login');





Route::apiResource('/products', 'ProductController',[
	'except' => ['index', 'show']
	])->middleware('auth:api');


// Route::apiResource('/products', 'ProductController');

Route::group(['prefix' => 'products'], function() {
		Route::apiResource('/{product}/reviews', 'ReviewController');
});