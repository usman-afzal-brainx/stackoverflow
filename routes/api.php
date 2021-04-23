<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout', 'Api\AuthController@logout');

});
Route::post('login', 'Api\AuthController@login');
Route::post('register', 'Api\AuthController@register');

Route::get('/questions', 'QuestionController@index');
Route::post('/questions', 'QuestionController@create');
Route::get('/questions/{question}', 'QuestionController@show');
Route::delete('/questions/{question}', 'QuestionController@delete');
Route::post('/questions/{question}/like', 'QuestionController@handleLike');
Route::post('/questions/{question}/dislike', 'QuestionController@handleDislike');

Route::get('/answers/{question}', 'AnswerController@show');
Route::post('/answers/{question}', 'AnswerController@create');
Route::put('/answers/{answer}', 'AnswerController@update');
Route::delete('/answers/{answer}', 'AnswerController@delete');
