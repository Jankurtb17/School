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
    Route::resource('/viewstudentgrades', 'viewstudentgrades');
    Route::delete('/viewstudentgrades-multiple-delete', ['as' => 'multiple.delete', 'uses' => 'viewstudentgrades@multipleDelete']);
    Route::resource('/class', 'nameOfClass');
    Route::get('/addteacher/excel', 'AddTeacherController@excel')->name('export.teacher');
    Route::get('/addteacher/fetch', 'AddTeacherController@fetch')->name('teacher.submitted');
    Route::get('/addteacher/PDF', 'AddTeacherController@pdf')->name('teacher.pdf');
    Route::get('/addteacher/{employee_id}/', 'AddTeacherController@gradepdf'); 
    Route::post('/addteacher/grade', 'AddTeacherController@searchAdminGrade')->name('searchgrade.admin');
    Route::post('/addteacher/submitgrade', 'AddTeacherController@submitGradeAdmin')->name('submitgrade.admin');
    // Route::put('/studentgrades/{studentgrade}', 'MakeGrades@update')->name('updategrades.admin');
    Route::put('/studentgrades/{id}', ['as' => 'updategrades.admin', 'uses' => 'MakeGrades@update']);
    Route::resource('/addteacher', 'AddTeacherController');
    Route::get('/student/search', 'StudentController@search')->name('find.student');
    Route::post('/student/fetch', 'StudentController@fetch')->name('dynamicdependent3.fetch');
    Route::get('/student/{student_id}/{gradelevel}', 'StudentController@select');
    Route::post('/student/{student_id}/{gradelevel}/{id}', 'StudentController@update');
    Route::put('/student/{id}', ['as' => 'statusupdate.admin', 'uses' => 'StudentController@update']);
    Route::put('/student/{id}', ['as' => 'viewstudentupdate.admin', 'uses' => 'StudentController@updateinfo']);
    Route::get('/student/sms/', 'StudentController@sendGrade')->name('send.sms');
    Route::get('/student/PDF', 'StudentController@pdf')->name('export.pdf');
    Route::resource('/student', 'StudentController');
    Route::resource('/schoolyear', 'schoolyr');
    // Route::resource('/subject', 'subjectview');
    Route::post('/subject/fetch', 'subjectview@fetch')->name('dynamicdependent.fetch');
    Route::resource('/gradelevel', 'yearlevel');
    Route::resource('/advisory', 'teacheradvisory');
    Route::post('/advisory/fetch', 'teacheradvisory@fetch')->name('dynamicdependent2.fetch');
    Route::post('/advisory/getclass', 'teacheradvisory@getclass')->name('advisory.fetch');
    Route::post('/advisory/scan', 'teacheradvisory@fetchSubject')->name('fetch.subject');
    Route::resource('/examination', 'Examination');
    });
  
  Route::group(['middleware' => 'Teacher'], function() {
    Route::get('/subjectload', 'ViewSubjectLoad@index');
    Route::post('/subjectload', 'VIewSUbjectLoad@edit')->name('subjectload.search');
    Route::get('/subjectload/search', 'ViewSubjectLoad@search')->name('search.subject');
    Route::get('/subjectgrade', 'ViewSubjectGrade@index');
    Route::post('/subjectgrade/grade', 'ViewSubjectGrade@store')->name('subjectgrade.grade');
    Route::get('/studentgrades', 'MakeGrades@index');
    Route::get('/studentgrades/{studentgrade}/{classname}/{subject}', 'MakeGrades@test');
    Route::post('/studentgrades/grade', 'MakeGrades@store')->name('studentgrades.grade');
    Route::get('/subjectgrade/search', 'ViewSubjectGrade@studentSearch')->name("student.search");
    Route::post('/subjectgrade/fetch', 'ViewSubjectGrade@fetch')->name('classname.search');
    Route::get('/viewgrades/search', 'SubmittedGrades@search')->name('find.grades');
    Route::get('/viewgrades/pdf', 'SubmittedGrades@pdf')->name('export.grades');
    Route::post('/viewgrades/fetch', 'SubmittedGrades@fetch')->name('find.advisory');
    Route::get('/viewgrades ', 'SubmittedGrades@index');
    
  });
    //studnets
  Route::group(['middleware' => 'Student'], function() {
    Route::get('/listsubject', 'ListSubject@index');
    Route::get('/grades','StudentGrades@index');
    Route::post('/grades/search', 'StudentGrades@showGrades')->name('show.grades');
    Route::get('/balance', 'StudentBalance@index');
  });
  

    //changepassword
    Route::get('/settings', 'AccountSettings@showChangePasswordForm');
    Route::post('/settings', 'AccountSettings@changePassword')->name('changePassword');
    Route::post('/settings/{id}', 'changepassword@update')->name('change.info');
    Route::get('404', ['as' => '404', 'uses' => 'ErrorController@notFound']);
    Route::get('500', ['as' => '500', 'uses' => 'ErrorController@notFound']);
  }); 
