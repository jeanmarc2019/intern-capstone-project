<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/quiz', function (Request $request) {
    return $request->user();
});

//Route::get('/question', function (Request $request) {
//    ($request);
//    App\Http\Controllers\QuestionsController::getQuestion();
//    return View::make('question', array('name' => 'test'));
//});

//Route::get('/question', 'QuestionsController@getQuestion');
//Route::get('/question', function()
//{
//    return 'test';
////    return View::make('question', array('name' => 'test'));
//});

Route::get('/register', 'RegistrationController@create');
Route::post('register', 'RegistrationController@store');

Route::get('/login', 'SessionsController@create');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');

Route::get('/questions', 'QuestionsController@getQuestion');

Route::post('/admin/save', 'AdminController@saveQuestion');

//Route::post('/admin/save', function() {
//
//    var_dump('this works');
//});



