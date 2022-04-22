<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Repo\User\UserRepo;
use App\Models\User;
use Validator;
use Hash;
use Str;
use Auth;
use File;
use Lang;
use App\Mail\Forget_pass;

class Users_auth extends Controller
{
    



    public function register(Request $request){
    
        
        $validator = UserRepo::UserCreateValidate($request);
        if($validator->fails()) {
            return UserRepo::ValidateResponse($validator);
        }

        $userr = User::create($request->except(['confirmPassword']));
        $data['status'] = true;
        $data['user'] = $userr->makeHidden(['image_url','operations'])->makeVisible('image_path') ;
        
        return $data;
    }





    public function login(Request $request){

        if(UserRepo::UserLoginValidate($request)){
            return  UserRepo::UserLoginValidate($request);
        }

        $user = User::where('email',$request->email)->first();

        if(!empty($user)) {
            if(Hash::check($request->password,$user->password)){
                
                $user->api_token = empty($user->api_token) ? Str::random(50) : $user->api_token;
                $user->save();

                $data['status'] = true;
                $data['user'] = $user->makeVisible(['api_token','image_path'])->makeHidden(['image_url','operations']);
            }else{
                $data['status'] = false;
                $data['message'] = Lang::get('leftsidebar.Error_pass');
            }

        }else{
            $data['status'] = false;
            $data['message'] = Lang::get('leftsidebar.Error_email');
        }
        return $data;
    }





    public function profile(Request $request){

        if(Auth::guard('api')->check()) {
            $data['status'] = true;
            $data['user'] = Auth::guard('api')->user()->makeHidden(['image_url','operations'])->makeVisible('image_path');
        }else{
            $data['status'] = false;
            $data['message'] = Lang::get('leftsidebar.plz_login');
        }

        return $data;
    }





    public function updateProfile(Request $request){
        
        $validator = UserRepo::UserCreateValidate($request);
        if($validator->fails()) {
            return UserRepo::ValidateResponse($validator);
        }

        $data = $validator->validate();
        $destinationPath = public_path('uploads/users/');
        $user = Auth::guard("api")->user();
        $data['image'] = $user->image;

        if ($request->hasFile('image')) {
            if ($data['image'] != "defaultLogo.png") {
                File::delete($destinationPath.$data['image']);
            }
            $data['image'] = UserRepo::ChangeUserImage($request->file('image'),$destinationPath);
        }

        $user->update($data);
        $info['status'] = true;
        $info['user'] = $user->makeHidden(['image_url','operations'])->makeVisible('image_path');

        return $info;
    }





    public function postForgetPass(Request $request){

        if(UserRepo::UserForgetPassValidate($request)){
            return  UserRepo::UserForgetPassValidate($request);
        }
        

        $user = User::where('email',$request->email)->first();
        if (!empty($user)) {
            $user->verify_token = Str::random(50);
            $user->save();

            \Mail::to($user->email)->send(new Forget_pass($user));
            $data['status'] = true;
            $data['message'] = Lang::get('leftsidebar.Sent');
        }else{
            $data['status'] = false;
            $data['message'] = Lang::get('leftsidebar.Empty');
        }

        return $data;
    }





    public function changePassword(Request $request){
        
        if(UserRepo::UserChangePassValidate($request)){
            return  UserRepo::UserChangePassValidate($request);
        }

        $user = Auth::guard('api')->user();
        $password = Hash::make($request->password);
        $user->password = $password;
        $user->save();

        $data['status'] = true;
        $data['message'] = Lang::get('leftsidebar.Done');

        return $data;
    }





    public function createLang(Request $request){
        return $request->all();
    }









    public function logOut(Request $request){
        $user = Auth::guard('api')->user();
        $user->api_token = null;
        $user->save();
        
        $data['status'] = true;
        $data['message'] = Lang::get('leftsidebar.Logged_out');
        return $data;
    }




}
