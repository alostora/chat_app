<?php
namespace App\Helpers\Repo;


class Repo{
	

	public static function imageHandle($image,$destinationPath){
		
        $imageName = \Str::random(30).'.'.$image->getClientOriginalExtension();
        $image->move($destinationPath, $imageName);
        return $imageName;
	}



	

    public static function ValidateResponse($validator){

        $data['status'] = false;
        $err = $validator->errors()->toArray();
        $data['message'] = array_values($err)[0][0];
        return $data;
    }

}