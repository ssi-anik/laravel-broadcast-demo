<?php

Auth::routes([ 'register' => false ]);

Route::group([ 'middleware' => 'auth' ], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('chat/private', function () {
        return 'not implemented';
    });
});
