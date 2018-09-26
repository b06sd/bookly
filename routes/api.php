<?php

use Illuminate\Http\Request;



Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function (){
  Route::post('/login', 'UserController@login');
  Route::post('/register', 'UserController@register');
  
  Route::middleware('auth:api')->group(function () {

    Route::get('books/{book}', 'BookController@show');
    Route::post('books', 'BookController@store');
    Route::put('books/{book}', 'BookController@update');
    Route::delete('books/{book}', 'BookController@destroy');
  });
});
