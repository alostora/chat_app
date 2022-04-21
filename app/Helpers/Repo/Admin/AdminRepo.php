<?php

namespace App\Helpers\Repo\Admin;
use App\Helpers\Repo\Repo;


class AdminRepo extends Repo{

	public static function AdminCreateValidate($request){
		return [
            "id" => "nullable",
            "name" => "required|max:100",
            'email' => 'required|unique:admins,email,'.$request->id.'|max:100',
            'password' => 'required|max:100',
            'confirmPassword' => 'same:password',
        ];
	}




    public static function AdminLoginValidate(){
        return [
            "email" => "required|email|max:100",
            "password" => "required|max:200",
        ];
    }


}