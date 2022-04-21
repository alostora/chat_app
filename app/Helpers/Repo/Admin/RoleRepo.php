<?php

namespace App\Helpers\Repo\Admin;
use App\Helpers\Repo\Repo;


class RoleRepo extends Repo{

	public static function RoleCreateValidate($request){
		return [
            "id" => "nullable",
            "roleName" => "required|max:15",
            "roleNameAr" => "required|max:15",
        ];
	}


}