<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat_room extends Model
{
    use HasFactory;
    protected $table = 'chat_rooms';
    protected $fillable = [

        "code",
        "parent_id",//user1 how start messaging
        "child_id",//user2 how receve first message messaging
        "last_message_id",//not foreign key
        "unread_parent_count",
        "unread_child_count",

    ];



    protected $casts = [
        "parent_id"=>"integer",
        "child_id"=>"integer",
        "unread_parent_count"=>"integer",
        "unread_child_count"=>"integer",
    ];
}
