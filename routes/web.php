<?php

Auth::routes([ 'register' => false ]);

Route::group([ 'middleware' => 'auth' ], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('messages/{id}', function ($id) {
        return 'not implemented';
    })->name('private-chat');
});
