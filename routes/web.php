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

Route::get('/app', 'HomeController@index')->name('app');


Route::get('/routines', 'RoutineController@index');
Route::post('/routines/store', 'RoutineController@store');
Route::get('/routines/{id}', 'RoutineController@show');

Route::get('/data', function(){
    return view('routines/create');
});

/*Route::get('/feedback', function(){
    return view('feedback');
});
Route::post('/feedback/submit', 'FeedbackController@store');*/