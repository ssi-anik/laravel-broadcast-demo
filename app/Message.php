<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    protected $fillable = [ 'message', 'sender_id', 'conversation_id' ];

    public function conversation () {
        return $this->belongsTo(Conversation::class, 'conversation_id');
    }

    public function sender () {
        return $this->belongsToMany(User::class);
    }
}
