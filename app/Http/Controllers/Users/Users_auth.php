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

        $validator = UserRepo::UserRegisterValidate($request);
        if($validator->fails()) {
            return UserRepo::ValidateResponse($validator);
        }

        $validator = $validator->validated();
        unset($validator['confirmPassword']);
        $validator['api_token'] = Str::random(50);
        $userr = User::create($validator);
        $data['status'] = true;
        $data['user'] = $userr->makeHidden(['image_url','operations'])->makeVisible(['image_path','api_token']);

        return $data;
    }





    public function login(Request $request){


        $validator = UserRepo::UserLoginValidate($request);
        if($validator->fails()) {
            return UserRepo::ValidateResponse($validator);
        }
        $validator = $validator->validated();

        $user = User::where('email',$validator['email'])->first();

        if(!empty($user)) {
            if(Hash::check($validator['password'],$user->password)){

                $user->api_token = empty($user->api_token) ? Str::random(50) : $user->api_token;
                $user->save();

                $data['status'] = true;
                $data['user'] = $user->makeHidden(['image_url','operations'])->makeVisible(['image_path','api_token']);
            }else{
                $data['status'] = false;
                $data['message'] = 'Error_pass';
            }

        }else{
            $data['status'] = false;
            $data['message'] = 'Error_email';
        }
        return $data;
    }





    public function profile(Request $request){

        if(Auth::guard('api')->check()) {
            $data['status'] = true;
            $data['user'] = Auth::guard('api')->user()->makeHidden(['image_url','operations'])->makeVisible(['image_path','api_token']);
        }else{
            $data['status'] = false;
            $data['message'] = Lang::get('leftsidebar.plz_login');
        }

        return $data;
    }





    public function updateProfile(Request $request){

        $validator = UserRepo::UserUpdateValidate($request);
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
        $info['user'] = $user->makeHidden(['image_url','operations'])->makeVisible(['image_path','api_token']);

        return $info;
    }





    public function postForgetPass(Request $request){

        $validator = UserRepo::UserForgetPassValidate($request);
        if($validator->fails()) {
            return UserRepo::ValidateResponse($validator);
        }
        $validator = $validator->validate();

        $user = User::where('email',$validator['email'])->first();
        if (!empty($user)) {
            $user->verify_token = Str::random(50);
            $user->save();

            \Mail::to($user->email)->send(new Forget_pass($user));
            $data['status'] = true;
            $data['message'] = 'email sent successfully';
        }else{
            $data['status'] = false;
            $data['message'] = 'email not found';
        }

        return $data;
    }





    public function changePassword(Request $request){

        $validator = UserRepo::UserChangePassValidate($request);
        if($validator->fails()) {
            return UserRepo::ValidateResponse($validator);
        }
        $validator = $validator->validate();


        $user = Auth::guard('api')->user();
        $password = Hash::make($validator['password']);
        $user->password = $password;
        $user->save();

        $data['status'] = true;
        $data['message'] = 'password changed successfully';

        return $data;
    }






    public function logOut(Request $request){
        $user = Auth::guard('api')->user();
        $user->api_token = null;
        $user->save();

        $data['status'] = true;
        $data['message'] = "Logged out successfully";
        return $data;
    }




}
