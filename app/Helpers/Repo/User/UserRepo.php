<?php

namespace App\Helpers\Repo\User;
use App\Helpers\Repo\Repo;
use Validator;
use Auth;


class UserRepo extends Repo{

	public static function UserCreateValidate($request){

	    $validator = Validator::make($request->all(),[
	        'name' => 'required|max:100',
	        'email' => 'required|unique:users,email,'.Auth::guard('api')->id().'|max:100',
	        'phone' => 'required|unique:users,phone,'.Auth::guard('api')->id().'|max:100',
	        'gender' => 'in:male,female',
	        'birthDate' => 'date',
	        'password' => 'required|max:100',
	        'confirmPassword' => 'same:password',
	    ]);

        if($validator->fails()) {
            return self::ValidateResponse($validator);
        }
	}





	public static function UserLoginValidate($request){

	    $validator = Validator::make($request->all(),[
	        'email' => 'required|email|max:100',
	        'password' => 'required|max:100',
	    ]);

        if($validator->fails()) {
            return self::ValidateResponse($validator);
        }
	}




   	public static function UserUpdateValidate($request){

	    $validator = Validator::make($request->all(),[
	        'name' => 'required|max:100',
	        'email' => 'required|unique:users,email,'.Auth::guard('api')->id().'|max:100',
	        'phone' => 'required|unique:users,phone,'.Auth::guard('api')->id().'|max:100',
	        'gender' => 'in:male,female',
	        'birthDate' => 'date',
	        'password' => 'max:100',
	        'confirmPassword' => 'same:password',
	        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4048',
	    ]);

        if($validator->fails()) {
            return self::ValidateResponse($validator);
        }

        $data['status'] = true;
        $data['validator'] = $validator->validated();
        return $data;
	}




	public static function UserForgetPassValidate($request){
   		$validator = Validator::make($request->all(),[
	        'email' => 'required|email|max:100',
	    ]);

        if($validator->fails()) {
            return self::ValidateResponse($validator);
        }
	}




	public static function UserChangePassValidate($request){
   		
	    $validator = Validator::make($request->all(),[
	        'password' => 'required|max:100',
	        'confirmPassword' => 'same:password',
	    ]);

        if($validator->fails()) {
            return self::ValidateResponse($validator);
        }
	}




    public static function ValidateResponse($validator){

        $data['status'] = false;
        $err = $validator->errors()->toArray();
        $data['message'] = array_values($err)[0][0];
        return $data;
    }



    public static function ChangeUserImage($image,$destinationPath){
        $data['image'] = "user".\Str::random(30).'.'.$image->getClientOriginalExtension();
        $image->move($destinationPath, $data['image']);
        return $data['image'];
    }
}