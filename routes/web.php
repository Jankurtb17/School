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

Auth::routes();
// Route::get('/', 'LoginController@index');
// Route::post('/checkLogin', 'LoginController@checkLogin');
// Route::get('/dashboard', 'LoginController@dashboard');



Route::get('/', 'HomeController@index');
Route::get('/dashboard', 'HomeController@dashboard');
Route::resource('/class', 'nameOfClass');
Route::get('/teacher', 'HomeController@teacher');
Route::get('/logout', 'loginController@logout');
Route::get('/student', 'HomeController@student');
Route::resource('/schoolyear', 'schoolyr');
Route::resource('/subject', 'subjectview');
Route::resource('/yearlevel', 'yearlevel');
Route::get('/studentclass', 'HomeController@studentClass');
Route::get('/advisory', 'HomeController@advisory');
