<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Events\ConversationCreatedEvent;
use App\Events\MessageReceivedEvent;
use App\Events\MessageRequestedEvent;
use App\Message;
use App\User;
use Illuminate\Http\Request;

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
            $q->whereIn('by', [ $id, auth()->id() ])->whereIn('with', [ $id, auth()->id() ]);
        })->first();

        if (!$conversation) {
            $conversation = new Conversation();
            $conversation->by = auth()->user()->id;
            $conversation->with = $id;
            $conversation->save();
            $conversation->load([ 'byUser', 'withUser' ]);

            event(new ConversationCreatedEvent($conversation));
        }

        $messages = Message::where('conversation_id', $conversation->id)->orderBy('id', 'desc')->limit(50)->get();

        /*event(new ConversationStartedEvent($conversation, auth()->user()->id, $id));*/

        return view('messages', compact('messages', 'conversation'));
    }

    public function addConversationMessage (Request $request, $conversationId) {
        $conversation = Conversation::find($conversationId);

        if (!$conversation || !in_array(auth()->user()->id, [ $conversation->with, $conversation->by ])) {
            return response()->json([ 'error' => true, 'message' => 'Invalid conversation!' ], 403);
        }

        $message = trim($request->input('message'));
        if (!$message) {
            return response()->json([ 'error' => true, 'message' => 'Text message is empty' ], 422);
        }

        $newMessage = new Message();
        $newMessage->conversation_id = $conversationId;
        $newMessage->sender_id = auth()->id();
        $newMessage->message = $message;
        $newMessage->save();

        event(new MessageReceivedEvent($conversation, $newMessage));
        event(new MessageRequestedEvent($conversation, auth()->id()));
        // broadcast(new MessageReceivedEvent($conversation, $newMessage));
        // dispatch(new BroadcastEvent(new MessageReceivedEvent($conversation, $newMessage)));

        return response()->json([ 'error' => false, 'message' => $message, 'time' => now()->diffForHumans() ], 200);

    }

    public function groupMessage () {
        return view('group-chat');
    }

    public function postGroupMessage (Request $request) {
        $message = trim($request->input('message'));
        if (!$message) {
            return response()->json([ 'error' => true, 'message' => 'Text message is empty' ], 422);
        }

        return response()->json([ 'error' => false, 'message' => $message, 'time' => now()->diffForHumans() ], 200);
    }
}
