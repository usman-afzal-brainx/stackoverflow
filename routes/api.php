<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout', 'Api\AuthController@logout');
    Route::get('/user', function (Request $request) {
        return auth()->user();
    });
    Route::post('/questions', 'QuestionController@create');
    Route::delete('/questions/{question}', 'QuestionController@delete');
    Route::post('/questions/favorite', 'QuestionController@handleFavorite');

    Route::get('/answers/{question}', 'AnswerController@show');
    Route::post('/answers', 'AnswerController@create');
    Route::delete('/answers/{answer}', 'AnswerController@delete');
    Route::post('/answers/favorite', 'AnswerController@handleFavorite');

    Route::get('/user/types', 'UserTypeController@index');
});
Route::get('/questions', 'QuestionController@index');
Route::get('/questions/{question}', 'QuestionController@show');

Route::post('/login', 'Api\AuthController@login');
Route::post('/register', 'Api\AuthController@register');
