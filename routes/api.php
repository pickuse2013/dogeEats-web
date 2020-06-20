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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
 //   return $request->user();
//});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Api\AuthController@login');
    Route::post('register', 'Api\AuthController@register');
});

Route::group(['middleware' => 'auth:api'], function () {

    Route::get('restaurants', 'Api\RestaurantController@restaurants');
    Route::group(['prefix' => 'restaurant'], function () {
        Route::get('/', 'Api\RestaurantController@restaurantJson');
        Route::get('{id}', 'Api\RestaurantController@restaurantJson')->where('id', '[0-9]+');

        Route::get('favorites', 'Api\RestaurantController@favorites');
        Route::post('favorite', 'Api\RestaurantController@addFavoriteJson');
        Route::post('{id}/favorite', 'Api\RestaurantController@addFavoriteJson')->where('id', '[0-9]+');

        Route::delete('favorite', 'Api\RestaurantController@deleteFavoriteJson');
        Route::delete('{id}/favorite', 'Api\RestaurantController@deleteFavoriteJson')->where('id', '[0-9]+');
    });

    Route::get('orders', 'Api\OrderController@orders');
    Route::group(['prefix' => 'order'], function () {
        Route::get('/current', 'Api\OrderController@currentOrder');
        Route::post('/', 'Api\OrderController@order');
    });

   
    Route::group(['prefix' => 'cart'], function () {
        Route::get('/', 'Api\CartController@cart');
        Route::post('/', 'Api\CartController@setCart');
        Route::post('/add', 'Api\CartController@addToCart');
        Route::delete('/', 'Api\CartController@clearCart');
    });
    
});
