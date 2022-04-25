<?php

namespace App\Helpers\Repo\User\Chat;
use App\Helpers\Repo\Repo;
use App\Models\Chat\Chat_room;
use App\Models\User;
use Validator;

class ChatRepo extends Repo{


    public static function UserLangValidate($request){

        $validator = Validator::make($request->all(),[
            'type' => 'required|in:teach,study',
            'lang_id' => 'required|array',
        ]);

        return $validator;
    }




    public static function UserChangeLoginState($request){

        $validator = Validator::make($request->all(),[
            'online' => 'required|boolean',
            'last_login_at' => 'required',
        ]);

        return $validator;
    }




    public static function UserSendMessage($request){

        $validator = Validator::make($request->all(),[
            'text' => 'required|max:500',
            'room_id' => 'required|integer',
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

        return $users->orderBy('online','desc')->paginate(25);


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



    

}