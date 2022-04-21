<?php

namespace App\Helpers\Repo\Admin;
use App\Helpers\Repo\Repo;


class CityRepo extends Repo{

	public static function CityCreateValidate(){
		return [
            'id' => 'max:30000',
            'cityName' => 'required|max:100',
            'cityNameAr' => 'required|max:100',
            'country_id' => 'required|max:5000',
        ];
	}


}