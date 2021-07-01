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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('photoItems', 'PhotoItemController@index');
Route::group(['prefix' => 'photoItem'], function () {
    Route::post('store', 'PhotoItemController@store');
    Route::get('show/{id}', 'PhotoItemController@show');
    Route::get('edit/{id}', 'PhotoItemController@edit');
    Route::post('update/{id}', 'PhotoItemController@update');
    Route::delete('destroy/{id}', 'PhotoItemController@destroy');
});

Route::get('newsItems', 'NewsItemController@index');
Route::group(['prefix' => 'newsItem'], function () {
    Route::post('store', 'NewsItemController@store');
    Route::get('show/{id}', 'NewsItemController@show');
    Route::get('edit/{id}', 'NewsItemController@edit');
    Route::post('update/{id}', 'NewsItemController@update');
    Route::delete('destroy/{id}', 'NewsItemController@destroy');
});

Route::post('editor-image-store', 'NewsItemController@editorImageStore');

Route::get('likes', 'LikeController@index');
Route::group(['prefix' => 'like'], function () {
    Route::post('store', 'LikeController@store');
    Route::get('get-one/{item_id}/{item_type}', 'LikeController@getOne');
    Route::delete('destroy/{id}', 'LikeController@destroy');
});

Route::post('auth/register', 'AuthController@register');
Route::post('auth/login', 'AuthController@login');
Route::group(['middleware' => 'jwt.auth'], function(){
  Route::get('auth/user', 'AuthController@user');
  Route::post('auth/logout', 'AuthController@logout');
});
Route::group(['middleware' => 'jwt.refresh'], function(){
  Route::get('auth/refresh', 'AuthController@refresh');
});
