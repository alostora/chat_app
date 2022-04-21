<?php

namespace App\Helpers\Repo\Admin;
use App\Helpers\Repo\Repo;


class PermissionRepo extends Repo{

	public static function PermissionCreateValidate(){
		return [
            'id' => 'max:5000',
            'permissionName' => 'required|max:100',
            'permissionNameAr' => 'required|max:100',
        ];
	}
}