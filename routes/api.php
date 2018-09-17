<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function (){
  Route::post('/login', 'UserController@login');
  Route::post('/register', 'UserController@register');

  Route::middleware('auth:api')->group(function () {
    Route::get('/books', 'BookController@index');
    Route::get('books/{book}', 'BookController@show');
    Route::post('books', 'BookController@store');
    Route::put('books/{book}', 'BookController@update');
    Route::delete('books/{book}', 'BookController@delete');    
  });
});
