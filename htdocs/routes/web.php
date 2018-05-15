<?php

Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
})->name('pages.home');


Route::middleware('auth')->name('records.')->prefix('records')->group(function () {
    Route::view('/', 'records.index')->middleware('auth')->name('index');
    Route::get('/workers', 'WorkerController@index')->middleware('auth')->name('workers');
    Route::get('/workers/{worker}', 'WorkerController@show')->middleware('auth')->name('workers.show');
    Route::view('/establishment', 'records.establishment')->middleware('auth')->name('establishment');
});


Route::get('/about', function () {
    return view('pages.about');
})->name('pages.about');
