<?php

Auth::routes([ 'register' => false ]);

Route::group([ 'middleware' => 'auth' ], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('messages/{id}', [
        'as'   => 'private-chat',
        'uses' => 'MessageController@view',
    ])->where('id', '\d+');

    Route::post('conversation/{conversation}', [
        'as'   => 'conversation-message',
        'uses' => 'MessageController@addConversationMessage',
    ])->where('conversation', '\d+');
});
