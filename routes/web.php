<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('questions', 'QuestionsController')->except('show');

//We exempted show method from questions resource routes so that we can use slug for show method instead of id.
//To achieve model-resource binding with slug instead of id, we need to modify the boot() method of the file RouteServiceProvider.php
Route::get('questions/{slug}', 'QuestionsController@show')->name('questions.show');