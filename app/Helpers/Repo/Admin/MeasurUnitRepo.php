<?php

namespace App\Helpers\Repo\Admin;
use App\Helpers\Repo\Repo;


class MeasurUnitRepo extends Repo{

	public static function MeasurUnitCreateValidate($request){
		return [
            "id" => "nullable",
            "unitName" => "required|max:20",
            "unitNameAr" => "required|max:20",
            "unitCode" => "required|max:10",
            "unitType" => "required|max:10",
        ];
	}




    public static function MeasurUnitRows($data){

        if (!empty($data)) {
            foreach($data as $daa){

                $daa->unitName = app()->getLocale() == 'ar' ? $daa->unitNameAr : $daa->unitName;
                $daa->operations = [
                    "edit" => url('admin/viewCreateMeasurUnit/'.$daa->id),
                    "delete" => url('admin/deleteMeasurUnit/'.$daa->id),
                ];
            }
        }
        $data = array_values($data->toArray());
        return $data;
        
    }





}