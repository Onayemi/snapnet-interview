<?php

// namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([
    // 'middleware' => 'api', 'prefix' => 'auth'
    'middleware' => ['api', 'auth:api']
], function($router){
    Route::post('login', 'AuthController@login')->withoutMiddleware(['auth:api']);
    Route::post('register', 'AuthController@register');
    Route::post('edit-user/{id}', 'AuthController@editUser');
    Route::post('logout', 'AuthController@logout');
    Route::get('me', 'AuthController@profile'); //->withoutMiddleware(['auth:api']);
    Route::post('refresh', 'AuthController@refresh')->withoutMiddleware(['auth:api']);    
    
    // Fetch all Country State and City Api
    Route::get('view/conutry', 'CountryController@index');
    Route::get('getConutry-State-City', 'CountryController@getStateCountry');

});