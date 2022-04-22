<?php

namespace App\Helpers\Repo\Admin;
use App\Helpers\Repo\Repo;


class AdminRepo extends Repo{

	public static function AdminCreateValidate($request){
		return [
            "id" => "nullable|integer",
            "name" => "required|string|max:100",
            'email' => 'required|unique:admins,email,'.$request->id.'|max:100',
            'password' => 'max:100',
            'confirmPassword' => 'same:password',
            'permission_id' => 'required|integer',
        ];
	}




    public static function AdminLoginValidate(){
        return [
            "email" => "required|email|max:100",
            "password" => "required|max:200",
        ];
    }


}