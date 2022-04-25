<?php

namespace App\Http\Controllers\Users\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lang;
use App\Models\User;
use App\Models\Chat\Chat_room;
use App\Models\Chat\Chat_message;
use App\Models\Chat\User_lang;
use App\Helpers\Repo\User\Chat\ChatRepo;
use App\Http\Resources\Users\UserResource;
use App\Http\Resources\Users\UserCollection;
use Auth;


class Chats extends Controller
{
    

    public function langs(){
        $data['status'] = true;
        $data['Langauges'] = Lang::get()->makeHidden('operations');

        return $data;
    }



    public function createLang(Request $request){

        $validator = ChatRepo::UserLangValidate($request);
        if($validator->fails()) {
            return ChatRepo::ValidateResponse($validator);
        }
        $info = $validator->validate();
        $info['user_id'] = Auth::guard('api')->id();


        User_lang::where(['user_id'=>$info['user_id'],'type'=>$info['type']])->delete();
        foreach($info['lang_id'] as $lang_id){
            $info['lang_id'] = $lang_id;
            User_lang::create($info);
        }

        $data['status'] = true;
        $data['user'] = new UserResource(User::find($info['user_id']));
        return $data;

    }





    public function changeLoginStatus(Request $request){
        $validator = ChatRepo::UserChangeLoginState($request);
        if($validator->fails()) {
            return ChatRepo::ValidateResponse($validator);
        }

        $validator = $validator->validate();
        $user = Auth::guard('api')->user()->update($validator);

        $data['status'] = true;
        $data['message'] = 'login status changed';

        return $data;
    }




    public function getUsers(Request $request){

        $user = new User;
        $users = ChatRepo::UserFilter($request,$user);

        $newUsers = $users;
        $users->data = $newUsers ;

        $data['status'] = true;
        $data['users'] = new UserCollection($users);
        return $data;

    }





    public function getUserProfile($user_id){
        $parent_id = Auth::guard('api')->id();
        $user = ChatRepo::UserChatRoom($parent_id,$user_id);
        $data['status'] = true;
        $data['user'] = new UserResource($user);
        return $data;

    }





    public function sendMessage(Request $request){


        $validator = ChatRepo::UserSendMessage($request);
        if($validator->fails()) {
            return ChatRepo::ValidateResponse($validator);
        }
        $validator = $validator->validate();


        $chat_room = Chat_room::find($validator['room_id']);

        $validator['from_id'] = Auth::guard('api')->id();
        $validator['to_id'] = $chat_room->child_id;
        $message = Chat_message::create($validator);


        $chat_room->last_message_id = $message->id;
        if($validator['from_id'] == $chat_room->unread_parent_count) {
            $chat_room->unread_child_count = $chat_room->unread_child_count+1;
            $chat_room->unread_parent_count = 0;
        }else{
            $chat_room->unread_parent_count = $chat_room->unread_parent_count+1;
            $chat_room->unread_child_count = 0;
        }

        $chat_room->save();


        $data['status'] = true;
        $data['message'] = "message sent";

        return $data;


    }



}
