<?php

namespace App\Http\Controllers;

use App\Conversation;

class ChannelHandler
{
    public function join ($user, $id) {
        $conversation = Conversation::find($id);

        return $conversation && ($conversation->by == $user->id || $conversation->with == $user->id);
    }
}