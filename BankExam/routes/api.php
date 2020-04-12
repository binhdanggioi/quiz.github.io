<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('Api')->prefix('v1')->group(function() {
	Route::middleware('api.auth')->group(function() {

		Route::resource('exams','ExamController')->except('create','edit');

    	Route::resource('questions','QuestionController')->except('create','edit');

    	Route::post('me','AuthController@me');

    	Route::get('logout','AuthController@logout');
	});
	
    Route::post('login','AuthController@login');
});
