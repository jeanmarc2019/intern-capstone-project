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

//Route::get('/home', function () {
//    return view('main');
//});
//
//Route::get('/question', function () {
//    return view('question')->with('question', \App\Http\Controllers\QuestionsController::getQuestion());
//});

Route::get('/quiz', function () {
    return view('main');
});

Route::get('/', function () {
    return view('main');
});

Route::get('/admin', 'AdminController@index');

//Route::get('/admin', 'AdminController@index');

Route::post('register', 'Auth\RegisterController@register');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('register', 'Auth\RegisterController@create');
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return Response()->json(["message" => "cache cleared"]);
});

