<?php
namespace App\Helpers\Repo;


class Repo{
	

	public static function imageHandle($image,$destinationPath){
		
        $imageName = \Str::random(30).'.'.$image->getClientOriginalExtension();
        $image->move($destinationPath, $imageName);
        return $imageName;
	}
}