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

Route::group(['middleware' => ['auth']], function () {

Route::get('/app', 'HomeController@index')->name('app');

//Routines
Route::get('/routines', 'RoutineController@index');
Route::post('/routines/store', 'RoutineController@store');
Route::get('/routines/{id}', 'RoutineController@show');
Route::get('/routines/{id}/edit', 'RoutineController@edit');
Route::put('/routines/{id}/edit/save', 'RoutineController@update');


Route::get('/routines/delete/{id}', 'RoutineController@destroy');

Route::get('/data', function(){
    return view('routines/create');
});

//Trackers
Route::get('/trackers', 'TrackerController@index');
Route::get('/trackers/create', 'TrackerController@create');
Route::post('/trackers/store', 'TrackerController@store');

Route::get('/trackers/{id}/result', 'TrackerResultController@show');
Route::post('/trackers/{id}/result/store', 'TrackerResultController@store');

Route::delete('/trackers/results/{id}/delete', 'TrackerResultController@destroy');
Route::put('/trackers/result/{id}/retake', 'TrackerResultController@update');

//Feedback
Route::get('/feedback', function(){
    return view('feedback');
});
Route::post('/feedback/submit', 'FeedbackController@store');


});