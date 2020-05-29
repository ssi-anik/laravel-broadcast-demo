<?php

Auth::routes([ 'register' => false ]);

Route::group([ 'middleware' => 'auth' ], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('messages/{id}', 'MessageController@view')->name('private-chat')->where('id', '\d+');
});
