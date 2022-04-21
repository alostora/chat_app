<?php

namespace App\Helpers\Repo\Admin;
use App\Helpers\Repo\Repo;


class StateRepo extends Repo{


	public static function StateCreateValidate(){
		return [
            'id' => 'max:30000',
            'stateName' => 'required|max:100',
            'stateNameAr' => 'required|max:100',
            'city_id' => 'required|max:5000',
            'country_id' => 'required|max:5000',
        ];
	}


}