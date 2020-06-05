<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::namespace('Frontend')->group(function() {
	Route::get('/', 'HomeController@index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
