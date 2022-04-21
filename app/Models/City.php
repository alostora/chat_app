<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;


class City extends Model
{
    use HasFactory;

    
    protected $table = 'cities';
    protected $fillable = [
        'cityName',
        'cityNameAr',
        'country_id',
    ];

    
    protected $hidden = [
        'cityName',
        'cityNameAr',
        'country_id',
        'updated_at',
        'created_at'
    ];



    protected $appends = [
        'name',
        'country_name',
        'operations'
    ];




    public function getNameAttribute($value){
        return app()->getLocale() == 'ar' ? $this->cityNameAr : $this->cityName;
    }


    public function getCountryNameAttribute($value){
        $country = Country::find($this->country_id);
        return $country->countryName;
    }


    public function getOperationsAttribute($value){

        return [
            "edit" => url('admin/City/viewCreateCity/'.$this->id),
            "delete" => url('admin/City/deleteCity/'.$this->id),
        ];
    }

}
