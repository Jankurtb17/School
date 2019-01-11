<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the Routex`ServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware'  => 'revalidate'], function(){
      // Route::middleware(['Users'])->group(function() {
      Route::get('/', 'HomeController@index');
      Route::get('/dashboard', 'HomeController@dashboard');
      Route::resource('/class', 'nameOfClass');
      Route::resource('/addteacher', 'AddTeacherController');
      Route::resource('/student', 'StudentController');
      Route::resource('/schoolyear', 'schoolyr');
      Route::resource('/subject', 'subjectview');
      Route::resource('/yearlevel', 'yearlevel');
      Route::resource('/studentclass', 'manageCLasses');
      Route::resource('/advisory', 'teacheradvisory');
      Route::resource('/examination', 'Examination');
      Route::get('/teacher/dashboard', 'HomeController@teacherDashboard');
    // });
      Route::get('/autocomplete', 'SearchController@showAddingForm');
      Route::post('/autocomplete/fetch/','SearchController@fetch')->name('autocomplete.fetch');  
  }); 
    // Route::prefix('teacher')->group(function() {
    //   Route::post('/login', 'Auth\teacherLoginController@login')->name('teacher.login.submit');
    //   Route::get('/login', 'Auth\teacherLoginController@showLoginForm')->name('teacher.login'); 
    //   Route::get('/', 'TeacherController@index')->name('teacher.dashboard');
    // Route::get('/logout', 'Auth\teacherLoginController@logout')->name('teacher.logout'); 
    // });
