<?php

namespace App\Helpers\Repo\User\Chat;
use App\Helpers\Repo\Repo;
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



    

}