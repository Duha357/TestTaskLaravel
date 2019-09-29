<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['sender_id', 'sent_to_id', 'body'];

    public function sender()
    {
        return $this->belongsTo('App\User', 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo('App\User', 'sent_to_id');
    }
}
