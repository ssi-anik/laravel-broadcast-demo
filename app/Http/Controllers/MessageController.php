<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Events\ConversationCreatedEvent;
use App\Events\ConversationStartedEvent;
use App\Message;
use App\User;

class MessageController extends Controller
{
    public function view ($id) {
        $user = User::find($id);
        if (!$user) {
            return view('error', [
                'code'    => 404,
                'message' => 'Invalid User!',
            ]);
        }
        if (auth()->user()->id == $id) {
            return view('error', [
                'code'    => 400,
                'message' => 'Cannot talk to yourself!',
            ]);
        }
        $conversation = Conversation::with('byUser', 'withUser')->where(function ($q) use ($id) {
            $q->where('by', $id)->orWhere('with', $id);
        })->first();

        if (!$conversation) {
            $conversation = new Conversation();
            $conversation->by = auth()->user()->id;
            $conversation->with = $id;
            $conversation->save();
            $conversation->load([ 'byUser', 'withUser' ]);

            event(new ConversationCreatedEvent($conversation));
        }

        $messages = Message::where('conversation_id', $conversation->id)->orderBy('id', 'desc')->limit(50)->get()->sortBy('id');
        /*event(new ConversationStartedEvent($conversation, auth()->user()->id, $id));*/

        return view('messages', compact('messages', 'conversation'));
    }
}
