<?php

namespace App\Helpers\Repo\Admin;
use App\Helpers\Repo\Repo;


class MainTypeRepo extends Repo{

	public static function MainTypeCreateValidate($request){
		return [
            "id" => "nullable",
            "typeName" => "required|max:15",
            "typeNameAr" => "required|max:15",
        ];
	}

}