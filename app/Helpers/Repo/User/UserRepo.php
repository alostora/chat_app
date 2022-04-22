<?php

namespace App\Helpers\Repo\User;
use App\Helpers\Repo\Repo;
use Validator;
use Auth;


class UserRepo extends Repo{

	public static function UserRegisterValidate($request){

	    $validator = Validator::make($request->all(),[
	        'name' => 'required|max:100',
	        'email' => 'required|unique:users,email|max:100',
	        'password' => 'required|max:100',
	        'confirmPassword' => 'same:password',
	    ]);

        return $validator;
	}




	public static function UserUpdateValidate($request){

	    $validator = Validator::make($request->all(),[
	        'name' => 'max:100',
	        'email' => 'unique:users,email,'.Auth::guard('api')->id().'|max:100',
	        'phone' => 'unique:users,phone,'.Auth::guard('api')->id().'|max:100',
	        'gender' => 'in:male,female',
	        'country' => 'max:10',
	        'country_key' => 'max:10',
	        'birthDate' => 'date',
	        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4048',
	    ]);

        return $validator;
	}





	public static function UserLoginValidate($request){

	    $validator = Validator::make($request->all(),[
	        'email' => 'required|email|max:100',
	        'password' => 'required|max:100',
	    ]);

        return $validator;
	}





	public static function UserForgetPassValidate($request){
   		$validator = Validator::make($request->all(),[
	        'email' => 'required|email|max:100',
	    ]);

        return $validator;
	}




	public static function UserChangePassValidate($request){

	    $validator = Validator::make($request->all(),[
	        'password' => 'required|max:100',
	        'confirmPassword' => 'same:password',
	    ]);

        return $validator;
	}





    public static function ChangeUserImage($image,$destinationPath){
        $data['image'] = "user".\Str::random(30).'.'.$image->getClientOriginalExtension();
        $image->move($destinationPath, $data['image']);
        return $data['image'];
    }
}
