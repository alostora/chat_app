<?php

namespace App\Helpers\Repo\Admin;
use App\Helpers\Repo\Repo;


class CountryRepo extends Repo{

	public static function CountryCreateValidate(){
		return [
            'id' => 'max:5000',
            'countryName' => 'required|max:100',
            'countryNameAr' => 'required|max:100',
            'countryPhoneKey' => 'required|max:5',
            'countryCode' => 'required|max:10',
            'countryCurrency' => 'required|max:10',
            'countryFlag' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4048',
        ];
	}
}