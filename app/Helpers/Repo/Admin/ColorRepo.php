<?php

namespace App\Helpers\Repo\Admin;
use App\Helpers\Repo\Repo;


class ColorRepo extends Repo{

	public static function ColorCreateValidate($request){
		return [
            "id" => "nullable",
            "colorName" => "required|max:15",
            "colorNameAr" => "required|max:15",
            "colorCode" => "required|max:10",
        ];
	}


}