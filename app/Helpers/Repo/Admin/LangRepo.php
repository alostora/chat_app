<?php

namespace App\Helpers\Repo\Admin;
use App\Helpers\Repo\Repo;


class LangRepo extends Repo{

	public static function LangCreateValidate($request){
		return [
            "id" => "nullable",
            "langName" => "required|max:15",
            "langCode" => "required|max:15",
        ];
	}


}