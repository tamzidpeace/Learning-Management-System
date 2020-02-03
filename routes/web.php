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
Route::get('/admin/students', 'AdminController@students')->middleware('isAdmin');

Route::get('/teacher', 'AdminController@teacher')->middleware('isTeacher');
Route::get('/student', 'AdminController@student')->middleware('isStudent');

// end of admin routes

// start of teacher routes

Route::get('/lms/be_a_teacher', 'TeacherController@beTeacher')->middleware('isStudent');
Route::post('/lms/be_a_teacher/confirm', 'TeacherController@request')->middleware('isStudent');


//end of teacher routes
