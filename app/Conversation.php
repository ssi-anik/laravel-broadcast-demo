<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversation extends Model
{
    use SoftDeletes;

    protected $fillable = [ 'by', 'with' ];

    public function withUser () {
        return $this->belongsTo(User::class, 'with');
    }

    public function byUser () {
        return $this->belongsTo(User::class, 'by');
    }
}
