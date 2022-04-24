<?php

namespace App\Helpers\Repo\User\Chat;
use App\Helpers\Repo\Repo;;

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




    public function UserFilter($request,$model){


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

        return $users->paginate(25);


    }



    

}