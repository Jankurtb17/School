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
  Route::group(['middleware' => 'Admin'], function() {
    Route::get('/', 'HomeController@index');
    Route::get('/dashboard2', 'HomeController@dashboard2');
    Route::get('/dashboard', 'HomeController@dashboard');
    Route::resource('/class', 'nameOfClass');
    Route::get('/addteacher/search', 'AddTeacherController@search')->name('find.teacher');
    Route::get('/addteacher/{employee_id}', 'AddTeacherController@select');
    Route::resource('/addteacher', 'AddTeacherController');
    Route::get('/student/search', 'StudentController@search')->name('find.student');
    Route::get('/student/{student_id}/{gradelevel}', 'StudentController@select');
    Route::resource('/student', 'StudentController');
    Route::post('/student/fetch', 'StudentController@fetch')->name('dynamicdependent3.fetch');
    Route::resource('/schoolyear', 'schoolyr');
    Route::resource('/subject', 'subjectview');
    Route::post('/subject/fetch', 'subjectview@fetch')->name('dynamicdependent.fetch');
    Route::resource('/gradelevel', 'yearlevel');
    Route::resource('/advisory', 'teacheradvisory');
    Route::post('/advisory/fetch', 'teacheradvisory@fetch')->name('dynamicdependent2.fetch');
    Route::resource('/examination', 'Examination');
    Route::get('/studentgrades', 'StudentGrades@index');
    });
  
  Route::group(['middleware' => 'Teacher'], function() {
    Route::get('/subjectload', 'ViewSubjectLoad@index');
    Route::post('/subjectload', 'VIewSUbjectLoad@edit')->name('subjectload.search');
    Route::get('/subjectload/search', 'ViewSubjectLoad@search')->name('search.subject');
    Route::get('/subjectgrade', 'ViewSubjectGrade@index');
    Route::post('/subjectgrade/grade', 'ViewSubjectGrade@store')->name('subjectgrade.grade');
    Route::get('/studentgrades', 'MakeGrades@index');
    Route::get('/studentgrades/{studentgrade}/{classname}', 'MakeGrades@test');
    Route::post('/studentgrades/grade', 'MakeGrades@store')->name('studentgrades.grade');
    Route::get('/subjectgrade/search', 'ViewSubjectGrade@studentSearch')->name("student.search");
    Route::post('/subjectgrade/fetch', 'ViewSubjectGrade@fetch')->name('classname.search');
    Route::post('/viewgrades/fetch', 'SubmittedGrades@fetch')->name('find.advisory');
    Route::get('/viewgrades ', 'SubmittedGrades@index');
    Route::get('/viewgrades/search', 'SubmittedGrades@search')->name('find.grades');
  });
    //studnets
  Route::group(['middleware' => 'Student'], function() {
    Route::get('/listsubject', 'ListSubject@index');
    Route::get('/grades','StudentGrades@index');
    Route::get('/grades/search', 'StudentGrades@showGrades')->name('show.grades');
    Route::get('/balance', 'StudentBalance@index');
  });
  

    //changepassword
    Route::get('/settings', 'AccountSettings@showChangePasswordForm');
    Route::post('/settings', 'AccountSettings@changePassword')->name('changePassword');

  }); 
