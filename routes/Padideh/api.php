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

Route::group(['prefix' => '/V1/', 'namespace' => 'Padideh\Api', 'name' => 'padideh.api.'],function(){

    //auth
    Route::group(['prefix' => '/auth', ],function()
    {
        Route::post('verification', 'LoginController@verification');
        Route::post('login', 'LoginController@login');
        Route::post('register', 'LoginController@register');
    });
    //auth driver
    Route::group(['prefix' => '/auth/driver', ],function()
    {
        Route::post('verification', 'LoginDriverController@verification');
        Route::post('login', 'LoginDriverController@login');
        Route::post('register', 'LoginDriverController@register');
    });
    Route::group(['middleware' => ['auth:api'], ''],function() {
        //auth
        Route::post('auth/logout', 'LoginController@logout');

        //profile
        Route::get('user/init', 'UserController@init');
        Route::put('user/profile/update', 'UserController@updateProfile');
        Route::put('user/firebase/update', 'UserController@updateFirebase');

        //wastes
        Route::get('wastes', 'WasteController@wasteList');

        //products
        Route::get('products','ProductController@productList');

        //stories
        Route::get('stories','StoryController@storyList');

        //banners
        Route::get('banners','BannerController@BannerList');

        Route::apiResource('addresses','AddressController');

        //orders
        Route::put('orders/{order}/cancel','OrderController@cancelOrder');
        Route::apiResource('orders','OrderController');


    });



});
