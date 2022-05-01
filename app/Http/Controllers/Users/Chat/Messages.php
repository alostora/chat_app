<?php

namespace App\Http\Controllers\Users\Chat;

use App\Http\Controllers\Controller;
use App\Http\Resources\Users\Chat_room as Chat_room_resource;
use App\Http\Resources\Users\ChatRoomCollection;
use Illuminate\Http\Request;
use App\Helpers\Repo\User\Chat\ChatRepo;
use App\Models\Chat\Chat_room;
use App\Models\Chat\Chat_message;
use App\Helpers\Notifi\Notifi;
use Auth;



class Messages extends Controller
{
    

    public function allChatRooms(){

        $parent_id = Auth::guard('api')->id();

        $chat_room = Chat_room::where('parent_id',$parent_id)
                    ->orWhere('child_id',$parent_id)
                    ->where('last_message_id','!=',null)
                    ->orderBy('updated_at','desc')->paginate(25);

        $data['status'] = false;
        if ($chat_room) {
            $data['status'] = true;
            $chat_room = new ChatRoomCollection($chat_room);
        }

        $data['chat_rooms'] = $chat_room;
        return $data;
    }




    public function chatRoom($room_id){

        $chat_room = Chat_room::find($room_id);
        $data['status'] = false;
        if($chat_room) {
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
        $data = $validator->validate();
        $data['from_id'] = Auth::guard('api')->user();

        $message = ChatRepo::CreateMessage($data);
        Notifi::SenMessageNotifi($data,$message);

        $res['status'] = true;
        $res['message'] = "message sent";

        return $res;
    }




    public function readMessages($room_id){

        $to_id = Auth::guard('api')->id();
        $chat_room = Chat_room::where('id',$room_id)->first();
        if (!empty($chat_room)) {

            Chat_message::where(['room_id'=>$room_id,'to_id'=>$to_id])->update(['readed'=>true]);
       
            if($to_id == $chat_room->parent_id) {
                $chat_room->unread_parent_count = 0;
                $from_id = $chat_room->child_id;
            }else{
                $chat_room->unread_child_count = 0;
                $from_id = $chat_room->parent_id;
            }

            $chat_room->save();
            
            $message = Chat_message::where([
                'room_id' => $chat_room->id,
                'to_id' => $to_id,
            ])->update(['readed' => true]);

            Notifi::ReadedMessageNotifi($from_id,$room_id);
        }
        
        $data['status'] = true;
        $data['message'] = 'all messages readed successfully';

        return $data;
    }




    public function typingNow($to_user_id){
        Notifi::TypingNowNotifi($to_user_id);
        $data['status'] = true;
        $data['message'] = 'typing now...';
        return $data;
    }




    public function translateMessage(Request $request){

        $validator = ChatRepo::TranslateMessageValidate($request);
        if($validator->fails()) {
            return ChatRepo::ValidateResponse($validator);
        }
        $data = $validator->validate();

        Chat_message::where('id',$data['id'])->update($data);

        $res['status'] = true;
        $res['message'] = 'message translated successfully';
        return $res;
    }




    public function deleteMessage(Request $request){

        $validator = ChatRepo::DeleteMessageValidate($request);
        if($validator->fails()) {
            return ChatRepo::ValidateResponse($validator);
        }
        $data = $validator->validate();

        Chat_message::where('id',$data['id'])->delete();

        $res['status'] = true;
        $res['message'] = 'message deleted successfully';
        return $res;
    }





}
