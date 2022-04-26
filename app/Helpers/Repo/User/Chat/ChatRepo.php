<?php

namespace App\Helpers\Repo\User\Chat;
use App\Helpers\Repo\Repo;
use App\Models\Chat\Chat_room;
use App\Models\Chat\Chat_message;
use App\Models\User;
use Validator;
use Auth;


class ChatRepo extends Repo{


    public static function LangValidate($request){

        $validator = Validator::make($request->all(),[
            'type' => 'required|in:teach,study',
            'lang_id' => 'required|array',
        ]);

        return $validator;
    }




    public static function ChangeLoginStateValidate($request){

        $validator = Validator::make($request->all(),[
            'online' => 'required|boolean',
        ]);

        return $validator;
    }




    public static function UserFilter($request,$model){


        $users = $model->query();
        if($request->name) {
            $users->where('name', 'LIKE', "%{$request->name}%" );
        }

        if($request->country) {
            $users->where('country', 'LIKE', "%{$request->country}%" );
        }

        if($request->country_key) {
            $users->where('country_key', 'LIKE', "%{$request->country_key}%" );
        }

        if($request->gender) {
            $users->where('gender', $request->gender );
        }


        if($request->ageFrom && $request->ageTo) {
            $users->whereBetween('birthDate', [date('Y-m-d', strtotime('-'.($request->ageTo+1).' years')),date('Y-m-d', strtotime('-'.$request->ageFrom.' years'))] );
        }


        return $users->has('langauges')->where('id','!=',Auth::guard('api')->id())->orderBy('online','desc')->paginate(10);


    }






    public static function UserChatRoom($parent_id,$child_id){

        $chatRoom = Chat_room::where(['parent_id'=>$parent_id,'child_id'=>$child_id])->first();
        if (empty($chatRoom)) {
            $chatRoom = Chat_room::where(['parent_id'=>$child_id,'child_id'=>$parent_id])->first();
        }

        if (empty($chatRoom)) {

            $chatRoom = Chat_room::create([
                'code'=>$parent_id."_".$child_id,
                'parent_id'=>$parent_id,
                'child_id'=>$child_id,
            ]);
        }

        $user = User::find($child_id);
        $user->chat_room_id = $chatRoom->id;

        return $user;
    }




    public static function SendMessageValidate($request){

        $validator = Validator::make($request->all(),[
            'text' => 'required|max:500',
            'room_id' => 'required|integer',
        ]);

        return $validator;
    }





    public static function SendMessage($validator){
        $chat_room = Chat_room::find($validator['room_id']);

        $validator['to_id'] = $chat_room->child_id == $validator['from_id'] ? $chat_room->parent_id : $chat_room->child_id;

        $message = Chat_message::create($validator);

        $chat_room->last_message_id = $message->id;
        if($validator['from_id'] == $chat_room->parent_id) {
            $chat_room->unread_child_count = $chat_room->unread_child_count+1;
            $chat_room->unread_parent_count = 0;
        }else{
            $chat_room->unread_parent_count = $chat_room->unread_parent_count+1;
            $chat_room->unread_child_count = 0;
        }

        $chat_room->save();
        return $message;
    }



    

}