<?php

namespace App\Helpers\Repo\Admin;
use App\Helpers\Repo\Repo;


class UserRepo extends Repo{

	public static function UserCreateValidate($request){
		return [
            "id" => "nullable",
            "name" => "required|max:100",
            'email' => 'required|unique:users,email,|max:100',
            'password' => 'required|max:100',
            'confirmPassword' => 'same:password',
        ];
	}



}