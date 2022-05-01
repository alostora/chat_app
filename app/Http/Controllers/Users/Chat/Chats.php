<?php

namespace App\Http\Controllers\Users\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lang;
use App\Models\User;
use App\Models\Chat\User_lang;
use App\Models\Chat\Chat_room;
use App\Models\Chat\User_report_list;
use App\Helpers\Repo\User\Chat\ChatRepo;
use App\Http\Resources\Users\UserResource;
use App\Http\Resources\Users\UserCollection;
use App\Helpers\Notifi\Notifi;
use Auth;
use Carbon\Carbon;


class Chats extends Controller
{
    

    public function langs(){
       
        $data['status'] = true;
        $data['Langauges'] = Lang::get()->makeHidden('operations');

        return $data;
    }



    public function createLang(Request $request){

        $validator = ChatRepo::LangValidate($request);
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

        $validator = ChatRepo::ChangeLoginStateValidate($request);
        if($validator->fails()) {
            return ChatRepo::ValidateResponse($validator);
        }
        $validator = $validator->validate();
        
        $validator['last_login_at'] = Carbon::now(config('app.timezone'));
        $user = Auth::guard('api')->user();
        $user->update($validator);

        Notifi::ChangeLoginStatus($user);

        $data['status'] = true;
        $data['message'] = 'login status changed';

        return $data;
    }




    public function getUsers(Request $request){

        $user = new User;
        $users = ChatRepo::UserFilter($request,$user);

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




    public function blockUser(Request $request){
        
        $validator = ChatRepo::BlockUserValidate($request);
        if($validator->fails()) {
            return ChatRepo::ValidateResponse($validator);
        }

        $data = $validator->validate();

        $chat_room = Chat_room::find($data['room_id']);
        $block_from = Auth::guard('api')->id();

        if(!empty($chat_room)){

            $exsits_block_to = $chat_room->block_to;

            if($exsits_block_to == null) {
                if($block_from == $chat_room->parent_id){
                    $block_to = 'child_id';
                }else{
                    $block_to = 'parent_id';
                }
            }

            if($exsits_block_to == 'parent_id') {
                if($block_from == $chat_room->parent_id){
                    $block_to = 'all';
                }else{
                    $block_to = null;
                }
                
            }

            if ($exsits_block_to == 'child_id') {
                if($block_from == $chat_room->parent_id){
                    $block_to = null;
                }else{
                    $block_to = 'all';
                }
            }

            $chat_room->block_to = $block_to;
            $chat_room->save();

        }


        $res['status'] = true;
        $res['message'] = 'user blocked successfully';
        return $res;
    }




    public function reportUser(Request $request){

        $validator = ChatRepo::ReportUserValidate($request);
        if($validator->fails()) {
            return ChatRepo::ValidateResponse($validator);
        }

        $data = $validator->validate();
        $user = User::find($data['report_to']);
        if ($user) {
            User_report_list::create($data);
        }
        
        $res['status'] = true;
        $res['message'] = 'user reported successfully';
        return $res;
    }




}
