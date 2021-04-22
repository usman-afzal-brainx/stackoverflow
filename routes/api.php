<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/questions', 'QuestionController@index');
    Route::post('/logout', 'AuthController@logout');

});

Route::post('/register', 'AuthController@register');

Route::post('/questions', 'QuestionController@create');
Route::get('/questions/{question}', 'QuestionController@show');
Route::put('/questions/{question}', 'QuestionController@update');
Route::delete('/questions/{question}', 'QuestionController@delete');

Route::get('/answers/{question}', 'AnswerController@show');
Route::post('/answers/{question}', 'AnswerController@create');
Route::put('/answers/{answer}', 'AnswerController@update');
Route::delete('/answers/{answer}', 'AnswerController@delete');
