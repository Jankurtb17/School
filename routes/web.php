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
      Route::post('/student/fetch', 'StudentController@fetch')->name('dynamicdependent3.fetch');
      Route::resource('/schoolyear', 'schoolyr');
      Route::resource('/subject', 'subjectview');
      Route::post('/subject/fetch', 'subjectview@fetch')->name('dynamicdependent.fetch');
      Route::resource('/gradelevel', 'yearlevel');
      Route::resource('/advisory', 'teacheradvisory');
      Route::post('/advisory/fetch', 'teacheradvisory@fetch')->name('dynamicdependent2.fetch');
      Route::resource('/examination', 'Examination');
      Route::get('/teacher/dashboard', 'HomeController@teacherDashboard');
      Route::get('/studentgrades', 'StudentGrades@index');
    // });
      
      //teacher
      Route::get('/subjectload', 'ViewSubjectLoad@index');
      Route::post('/subjectload', 'VIewSUbjectLoad@edit')->name('subjectload.search');
      Route::get('/subjectload/search', 'ViewSubjectLoad@search')->name('search.subject');
      Route::get('/listsubject', 'ListSubject@index');
      Route::get('/subjectgrade', 'ViewSubjectGrade@index');
      Route::get('/subjectgrade/search', 'ViewSubjectGrade@studentSearch')->name("student.search");
      Route::post('/subjectgrade/fetch', 'ViewSubjectGrade@fetch')->name('classname.search');
      //studnet
      Route::get('/grades','StudentGrades@index');

      //changepassword
      


      // Route::post('/class/fetch', 'nameOfClass@fetch')->name('dynamicdependent.fetch');
      // Route::get('/subjectload/get', 'ViewSubjectLoad@accessInformation');
      // Route::get('/advisory', 'SearchController@showAddingForm');
      // Route::post('/advisory/fetch/','SearchController@fetch')->name('autocomplete.fetch'); 
      // Route::get('/advisory', 'SearchController@search');
  }); 
    // Route::prefix('teacher')->group(function() {
    //   Route::post('/login', 'Auth\teacherLoginController@login')->name('teacher.login.submit');
    //   Route::get('/login', 'Auth\teacherLoginController@showLoginForm')->name('teacher.login'); 
    //   Route::get('/', 'TeacherController@index')->name('teacher.dashboard');
    // Route::get('/logout', 'Auth\teacherLoginController@logout')->name('teacher.logout'); 
    // });
