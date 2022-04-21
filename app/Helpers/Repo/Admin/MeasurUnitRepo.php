<?php

namespace App\Helpers\Repo\Admin;
use App\Helpers\Repo\Repo;


class MeasurUnitRepo extends Repo{

	public static function MeasurUnitCreateValidate($request){
		return [
            "id" => "nullable",
            "unitName" => "required|max:20",
            "unitNameAr" => "required|max:20",
            "unitCode" => "required|max:10",
            "unitType" => "required|max:10",
        ];
	}

}