<?php

Broadcast::channel('activities', function ($user) {
    return !is_null($user);
});

Broadcast::channel('conversation-receiver-{id}', function ($user, $id) {
    return $user->id == $id;
});

Broadcast::channel('conversation-{id}', 'App\Http\Controllers\ChannelHandler');

Broadcast::channel('group-conversation', function ($user) {
    return [ 'id' => $user->id, 'name' => $user->name, 'username' => $user->username ];
});