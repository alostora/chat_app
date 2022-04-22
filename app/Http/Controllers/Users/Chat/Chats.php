<?php

namespace App\Http\Controllers\Users\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lang;
use App\Models\Chat\User_lang;
use App\Helpers\Repo\User\Chat\ChatRepo;
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
        $user = Auth::guard('api')->user();
        $info['user_id'] = $user->id;


        User_lang::where(['user_id'=>$info['user_id'],'type'=>$info['type']])->delete();
        foreach($info['lang_id'] as $lang_id){
            $info['lang_id'] = $lang_id;
            User_lang::create($info);
        }

        $data['status'] = true;
        $data['user'] = $user->makeHidden(['image_url','operations'])->makeVisible(['image_path','api_token']);

        return $data;

    }





    public function changeLoginStatus(Request $request){
        $validator = ChatRepo::UserChangeLoginState($request);
        if($validator->fails()) {
            return ChatRepo::ValidateResponse($validator);
        }

        $validator = $validator->validate();
        $user = Auth::guard('api')->user();
        $user->online = $validator['online'];
        $user->last_login_at = $validator['last_login_at'];
        $user->save();


        $data['status'] = true;
        $data['message'] = 'login status changed';

        return $data;
    }



}
