<?php

Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
})->name('pages.home');

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware('auth')->name('pages.home');

Route::get('/about', function () {
    return view('pages.about');
})->name('pages.about');
