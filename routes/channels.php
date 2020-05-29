<?php

use App\Conversation;

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('activities', function ($user) {
    return !is_null($user);
});

Broadcast::channel('conversation-receiver-{id}', function ($user, $id) {
    return $user->id == $id;
});

Broadcast::channel('conversation-{id}', function ($user, $id) {
    $conversation = Conversation::find($id);

    return $conversation && ($conversation->by == $user->id || $conversation->with == $user->id);
});

Broadcast::channel('group-conversation', function ($user) {
    return [ 'id' => $user->id, 'name' => $user->name, 'username' => $user->username ];
});