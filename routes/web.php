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
Route::get('/', 'OvertimeController@index');
Route::get('/locations', 'OvertimeController@locations');
Route::get('/users', 'OvertimeController@users');
Route::get('/time', 'OvertimeController@timePunches');