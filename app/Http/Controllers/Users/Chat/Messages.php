<?php

namespace App\Http\Controllers\Users\Chat;

use App\Http\Controllers\Controller;
use App\Http\Resources\Users\Chat_room as Chat_room_resource;
use Illuminate\Http\Request;
use App\Helpers\Repo\User\Chat\ChatRepo;
use App\Models\Chat\Chat_room;
use App\Models\Chat\Chat_message;
use App\Helpers\Notifi\Notifi;
use Auth;





class Messages extends Controller
{
    

    public function chatRoom($room_id){

        $chat_room = Chat_room::find($room_id);
        $data['status'] = false;
        if ($chat_room) {
            $data['status'] = true;
            $chat_room = new Chat_room_resource($chat_room);
        }

        $data['chat_room'] = $chat_room;
        return $data;
    }





    public function sendMessage(Request $request){

        $validator = ChatRepo::SendMessageValidate($request);
        if($validator->fails()) {
            return ChatRepo::ValidateResponse($validator);
        }
        $validator = $validator->validate();
        $validator['from_id'] = Auth::guard('api')->id();

        $message = ChatRepo::SendMessage($validator);
        Notifi::senNotifi($validator,$message);

        $data['status'] = true;
        $data['message'] = "message sent";

        return $data;

        /////Crone Job/////will try later///return [SendMessageJob::dispatch($validator)];

    }





}
