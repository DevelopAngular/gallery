<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::group(['middleware'=>'web'],function(){

    Route::get('/', ['uses'=>'HomeController@index','as'=>'home']);
    Route::get('/gallery',['uses'=>'GalleryController@execute','as'=>'gallery']);
    Route::post('/gallery','GalleryController@show');
    Route::get('/admin/{user_id}',['uses'=>'AdminController@show','as'=>'admin']);
    Route::get('/images/{album_id?}',['uses'=>'ImagesController@show','as'=>'images']);
    Route::get('/profile/{user_id}',['uses'=>'ProfileController@show','as'=>'profile']);

});
Route::post('/admin','AdminController@create');
Route::post('/profile/{user_id}','ProfileController@create');

