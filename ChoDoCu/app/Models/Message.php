<?php

namespace App\Models;
use App\Models\Conversation;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'conversation_id',
        'sender_id',
        'message',
        'is_read',
    ];

   public function conversation()
{
    return $this->belongsTo(Conversation::class);
}

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}