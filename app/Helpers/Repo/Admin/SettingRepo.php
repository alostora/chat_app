<?php

namespace App\Helpers\Repo\Admin;
use App\Helpers\Repo\Repo;


class SettingRepo extends Repo{

	public static function SettingCreateValidate(){
		return [
            'id' => 'nullable',
            'siteName' => 'required|max:100',
            'siteNameAr' => 'required|max:100',
            'siteEmail' => 'required|email|max:100',
            'is_live' => 'required|boolean|max:1',
            'siteMobile' => 'required|max:100',
            'sitePhone' => 'required|max:100',
            'siteDesc' => 'required|max:1500',
            'siteDescAr' => 'required|max:1500',
            'siteImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4048',
            'siteLogo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4048',
        ];
	}


}