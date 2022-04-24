<?php

namespace App\Http\Controllers\Users\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lang;
use App\Models\User;
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




    public function getUsers(){
        $data['status'] = true;
        $user = User::paginate(25);
        $data['users'] = new UserCollection($user);
        return $data;
    }



}
