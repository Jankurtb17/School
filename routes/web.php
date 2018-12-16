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

Route::group(['middleware'  => 'revalidate'], function(){
  Route::middleware(['Admin'])->group(function() {
    Route::get('/', 'HomeController@index');
    Route::get('/dashboard', 'HomeController@dashboard');
    Route::resource('/class', 'nameOfClass');
    Route::get('/teacher', 'HomeController@teacher');
    Route::get('/logout', 'LogoutController@logout');
    Route::resource('/student', 'StudentController');
    Route::resource('/schoolyear', 'schoolyr');
    Route::resource('/subject', 'subjectview');
    Route::resource('/yearlevel', 'yearlevel');
    Route::resource('/studentclass', 'manageCLasses');
    Route::resource('/advisory', 'teacheradvisory');
    Route::get('/examination', 'HomeController@examination');
  });
});
