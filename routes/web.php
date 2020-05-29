<?php

Auth::routes([ 'register' => false ]);

Route::group([ 'middleware' => 'auth' ], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('group-chat', [
        'as' => 'get.group-chat',
        'uses' => 'MessageController@groupMessage'
    ]);

    Route::post('group-chat', [
        'as' => 'post.group-chat',
        'uses' => 'MessageController@postGroupMessage'
    ]);

    Route::get('messages/{id}', [
        'as'   => 'private-chat',
        'uses' => 'MessageController@view',
    ])->where('id', '\d+');

    Route::post('conversation/{conversation}', [
        'as'   => 'conversation-message',
        'uses' => 'MessageController@addConversationMessage',
    ])->where('conversation', '\d+');
});
