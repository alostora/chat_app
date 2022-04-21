<?php

namespace App\Helpers\Repo\Admin;
use App\Helpers\Repo\Repo;


class ItemRepo extends Repo{

	public static function ItemCreateValidate(){
		return [
            'id' => 'nullable',
            'itemName' => 'required|max:100',
            'itemNameAr' => 'required|max:100',
            'itemDesc' => 'required|max:1000',
            'itemDescAr' => 'required|max:1000',
            'itemPrice' => 'required|integer|max:20000',
            'itemCount' => 'required|integer|max:1000',
            'itemDiscount' => 'nullable|integer|max:1000',
            'country_id' => 'required|max:5000',
            'sub_cat_id' => 'required|max:5000',

        ];
	}public 


    static function createImageValidate(){
        return [
            'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
        ];
    }


}