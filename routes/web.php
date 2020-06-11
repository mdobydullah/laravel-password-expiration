<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// password reset
Route::get('/reset-password','Auth\PasswordSecurityController@resetPasswordForm');
Route::post('/reset-password','Auth\PasswordSecurityController@resetPassword')->name('resetPassword');
