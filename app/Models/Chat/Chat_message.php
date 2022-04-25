<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat_message extends Model
{
    use HasFactory;
    protected $table = 'chat_messages';
    protected $fillable = [

        'text',
        'translatedText',
        'readed',//boolean
        'from_id',//from
        'to_id',//to
        'room_id',
    ];



    protected $casts = [
        
        "from_id"   =>  "integer",
        "to_id"     =>  "integer",
        "room_id"   =>  "integer",
        "readed"    =>  "boolean",
    ];
}
