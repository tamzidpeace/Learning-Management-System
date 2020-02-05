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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// start of admin routes
Route::get('/admin', 'AdminController@dashboard')->middleware('isAdmin');
Route::get('/admin/users', 'AdminController@users')->middleware('isAdmin');
Route::get('/admin/teachers', 'AdminController@teachers')->middleware('isAdmin');
Route::get('/admin/teacher-req', 'AdminController@teacherReq')->middleware('isAdmin');
Route::patch('/admin/teacher-req/{id}', 'AdminController@accept')->middleware('isAdmin');
Route::delete('/admin/teacher-req/{id}', 'AdminController@reject')->middleware('isAdmin');
Route::get('/admin/students', 'AdminController@students')->middleware('isAdmin');
Route::get('/admin/category', 'AdminController@category')->middleware('isAdmin');
Route::post('/admin/category', 'AdminController@addCategory')->middleware('isAdmin');

//tutorial
Route::get('/admin/tutorial/pending', 'AdminController@pendingTutorials')->middleware('isAdmin');
Route::get('/admin/tutorial/details/{id}', 'AdminController@tutorialDetails')->middleware('isAdmin');
Route::patch('/admin/tutorial/details/publish/{id}', 'AdminController@publish')->middleware('isAdmin');
Route::get('/admin/tutorial/published', 'AdminController@publishedTutorials')->middleware('isAdmin');
Route::delete('/admin/tutorial/delete/{id}', 'AdminController@deleteVideo')->middleware('isAdmin');
Route::get('/admin/tutorial/all', 'AdminController@allTutorials')->middleware('isAdmin');
Route::delete('/admin/tutorial/all/delete/{id}', 'AdminController@deleteTutorial')->middleware('isAdmin');

Route::get('/teacher', 'AdminController@teacher')->middleware('isTeacher');
Route::get('/student', 'AdminController@student')->middleware('isStudent');

// end of admin routes

// start of student routes

Route::get('/lms/be_a_teacher', 'TeacherController@beTeacher')->middleware('isStudent');
Route::post('/lms/be_a_teacher/confirm', 'TeacherController@request')->middleware('isStudent');
Route::get('/student-profile', 'StudentController@profile')->middleware('isStudent');
Route::Post('/student-profile/edit', 'StudentController@profileEdit')->middleware('isStudent');


//end of student routes

// teacher controller

Route::get('/teacher-profile', 'TeacherController@profile')->middleware('isTeacher');
Route::Post('/teacher-profile/edit', 'TeacherController@profileEdit')->middleware('isTeacher');
Route::get('/teacher-tutorial', 'TeacherController@tutorial')->middleware('isTeacher');
Route::get('/teacher-tutorial/create-new', 'TeacherController@createNewTutorial')->middleware('isTeacher');
Route::post('/teacher-tutorial/upload-video', 'TeacherController@save')->middleware('isTeacher');
Route::patch(
    '/teacher-tutorial/upload-video/publish/{id}',
    'TeacherController@publish'
)->middleware('isTeacher');

Route::get('/teacher/tutorials/details/{id}', 'TeacherController@details')->middleware('isTeacher');

Route::get('/teacher-tutorial/upload-video/{id}', 'TeacherController@uploadVideo');
Route::post('/teacher-tutorial/upload-video/{id}', 'TeacherController@upload');

// web

Route::get('/home/tutorial/details/{id}', 'HomeController@tutorialDetails');
Route::get('/home/tutorial/purchase/{id}', 'HomeController@purchase');
Route::post('/home/tutorial/purchaseNenrole', 'HomeController@purchaseNenrole');


// 

// test

Route::get('/test', 'StudentController@test');
Route::get('/test2', 'StudentController@test2');
