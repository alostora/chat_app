<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\Users\UserResource;
use App\Models\User;
use Auth;

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



    protected $hidden = [
        'code',
        'parent_id',
        'child_id',
        'last_message_id',
        'all_messages',
        "unread_parent_count",
        "unread_child_count",
        "created_at",
        "updated_at",
    ];


    protected $appends = [
        'unread_count',
        'friend',
        'last_message',
        'all_messages',
    ];




    public function getUnreadCountAttribute(){
        $id = Auth::guard('api')->id();
        $count = $id != $this->child_id ? $this->unread_parent_count : $this->unread_child_count;
        return $count;
    }




    public function getFriendAttribute(){
        $id = Auth::guard('api')->id();
        $id = $id == $this->child_id ? $this->parent_id : $this->child_id;

        $user = User::find($id);
        return $user->makeHidden(['langauges','image_url','operations'])->makeVisible('image_path');
    }




    public function getLastMessageAttribute(){
        return Chat_message::find($this->last_message_id);
    }




    public function getAllMessagesAttribute(){
        return Chat_message::where('room_id',$this->id)->orderBy('id','desc')->paginate(10);
    }








}
