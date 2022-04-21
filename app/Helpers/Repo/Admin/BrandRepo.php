<?php

namespace App\Helpers\Repo\Admin;
use App\Helpers\Repo\Repo;


class BrandRepo extends Repo{

	public static function BrandCreateValidate(){
		return [
            'id' => 'max:5000',
            'brandName' => 'required|max:100',
            'brandNameAr' => 'required|max:100',
            'brandImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4048',
        ];
	}
}