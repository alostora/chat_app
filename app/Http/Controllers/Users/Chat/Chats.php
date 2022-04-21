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
        $info['user_id'] = Auth::guard('api')->id();


        User_lang::where(['user_id'=>$info['user_id'],'type'=>$info['type']])->delete();
        foreach($info['lang_id'] as $lang_id){
            $info['lang_id'] = $lang_id;
            User_lang::create($info);
        }

        $data['status'] = true;
        $data['message'] = 'Langauge created successfully';

        return $data;



    }



}
