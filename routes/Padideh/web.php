<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('admin/login','Padideh\Admin\AdminAuthController@login')->name('login');
Route::post('admin/login','Padideh\Admin\AdminAuthController@postLogin')->name('login.post');
Route::group(['namespace'=>'Padideh\Admin','middleware'=>'auth:admin'],function(){
    Route::get('imagecache', function () {
       return 'ok';
    })->name('imagecache');
    Route::prefix('panel')->name('panel.')->group(function(){
            Route::get('/dashboard','PanelController@dashboard')->name('dashboard');
            Route::resource('admins','AdminController');
            Route::post('admins/search','AdminController@search')->name('admins.search');
            Route::post("admins/get_admins/table", "AdminController@getAdminsTable")->name("admins.get_admins.table");
            Route::resource('users','UserController');

            Route::get('address/{user}','AddressController@show')->name('address.show');
            Route::resource('product_categories','ProductCategoryController')->only('index','create','store','destroy');
            Route::resource('products','ProductController');
            Route::resource('pasmands','PasmandController');
            Route::resource('banners','BannerController');
            Route::resource('stories','StoryController');
            Route::resource('article_categories','ArticleCategoryController')->only('index','create','store','destroy');
            Route::resource('articles','ArticleController');

            Route::resource('orders','OrderController');


            route::prefix('orders/')->name('orders.')->group(function(){
                route::prefix('waiting/')->group(function(){
                    Route::get('confirmations','OrderController@confirmations')->name('confirmations');
                    Route::get('process','OrderController@waitingProcess')->name('process');
                    Route::get('driver','OrderController@wattingDriver')->name('drivers');
                    Route::patch('{order}/change/status','OrderController@changeStatus')->name('changeStatus');
                    Route::resource('manage/statuses','OrderStatusController')->only('index','store','destroy','create');
                });
            });


            route::prefix('drivers/')->name('drivers.')->group(function(){
                Route::resource('lists','DriverController');
                Route::resource('statuses','DriverStatusController')->only('index','store','destroy');
            });
    });
});

Route::any('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

