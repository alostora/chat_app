<?php

namespace App\Helpers\Repo\Admin;
use App\Helpers\Repo\Repo;


class S_categoryRepo extends Repo{

	public static function CategoryCreateValidate(){
		return [
            'id' => 'max:5000',
            'categoryName' => 'required|max:100',
            'categoryNameAr' => 'required|max:100',
            'categoryNameAr' => 'required|max:100',
            'cat_id' => 'required|max:5000',
        ];
	}

}