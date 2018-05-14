<?php

Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
})->name('pages.home');

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware('auth')->name('pages.dashboard');

Route::view('/about', 'pages.about')->name('pages.about');

Route::get('/questions', 'QuestionController@index')->middleware('auth')->name('questions.index');

Route::prefix('api')->name('api.')->middleware('auth')->group(function () {
    Route::resource('question_answers', 'Api\QuestionAnswerController');
});