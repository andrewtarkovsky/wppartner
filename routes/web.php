<?php

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
    return view('index');
});

Route::get('/api/rating/preview', 'RatingController@preview');
Route::get('/api/rating/save', 'RatingController@save');
Route::post('/api/rating/save', 'RatingController@save');