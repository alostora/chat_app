<?php

namespace App\Helpers\Repo\Admin;
use App\Helpers\Repo\Repo;


class CategoryRepo extends Repo{

	public static function CategoryCreateValidate(){
		return [
            'id' => 'max:5000',
            'categoryName' => 'required|max:100',
            'categoryNameAr' => 'required|max:100',
            'categoryImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4048',
            'type_id' => 'required|max:100',
        ];
	}

}