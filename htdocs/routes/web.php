<?php

Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
})->name('pages.home');

Route::get('/users', function() {
    $users = App\User::with('person', 'roles')->orderBy('username')->get();
    return view('pages.users', compact('users'));
});

Route::get('/test', function () {
    \Log::debug('Rollbar test');
})->name('pages.home');

Route::get('/landing', function() {

    if(auth()->user()->hasRole('analyst-user'))
        return redirect()->route('reports.index');

    if(auth()->user()->hasRole('edit-user'))
        return redirect()->route('records.index');

})->middleware('auth')->name('pages.landing');

// Analyst reports.
Route::name('reports.')->prefix('reports')->namespace('AnalystUser')->group(function () {
    Route::middleware(['auth', 'role:analyst-user'])->group(function () {
        Route::get('/', 'ReportController@index')->name('index');
        Route::get('/analytical-db-download', 'AnalyticalDBDownloadController@index')->name('analytical-db-download');
        Route::post('/analytical-db-download', 'AnalyticalDBDownloadController@store')->name('analytical-db-download.store');

    });
});

// Establishment records.
Route::name('records.')->prefix('records')->group(function () {
    Route::middleware(['auth', 'role:edit-user'])->group(function () {
        Route::get('/', 'RecordIndexController')->name('index');
        Route::get('/workers', 'WorkerController@index')->name('workers');
        Route::post('/workers', 'WorkerController@store')->name('workers.store')->middleware(['can:create,App\Worker']);
        Route::get('/workers/create', 'WorkerController@create')->name('workers.create')->middleware(['can:create,App\Worker']);
        Route::get('/workers/{worker}/edit/{section}', 'WorkerController@edit')->name('workers.edit')->middleware(['can:view,worker']);
        Route::get('/workers/{worker}', 'WorkerController@show')->name('workers.show')->middleware(['can:view,worker']);;
        Route::get('/establishment/{establishment?}', 'EstablishmentController@show')->name('establishment.show');
    });
});

Route::middleware(['auth', 'can:update,worker'])->put('question_answers_bulk/{worker}/update', 'QuestionAnswerBulkController@update')->name('question_answer_bulk_update');
Route::middleware(['auth', 'can:update,worker'])->put('finish_worker_record/{worker}/update', 'FinishWorkerRecordController')->name('finish_worker_record');

Route::get('/about', function () {
    return view('pages.about');
})->name('pages.about');


Route::prefix('api')->name('api.')->middleware('auth')->group(function () {

    Route::resource('question_answers', 'Api\QuestionAnswerController');

});