<?php

namespace App\Helpers\Repo\Admin;
use App\Helpers\Repo\Repo;
use App\Models\Main_type;


class SizeRepo extends Repo{

	public static function SizeCreateValidate($request){
		return [
            "id" => "nullable",
            "sizeName" => "required|max:15",
            "sizeNameAr" => "required|max:15",
            "sizeValue" => "required|max:100",
            "type_id" => "required|max:100",
        ];
	}






}