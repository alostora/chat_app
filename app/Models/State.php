<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $table = 'states';
    protected $fillable = [
        'stateName',
        'stateNameAr',
        'city_id',
        'country_id',
    ];


    
    protected $hidden = [
        'stateName',
        'stateNameAr',
        'city_id',
        'country_id',
        'updated_at',
        'created_at'
    ];





    protected $appends = [
        'name',
        'country',
        'city',
        'operations'
    ];


    public function getNameAttribute($value){
        return app()->getLocale() == 'ar' ? $this->stateName : $this->stateName;
    }


    public function getCountryAttribute($value){
        $country = Country::find($this->country_id);
        if(!empty($country)) {
            return $country->name;
        }
    }


    public function getCityAttribute($value){
        $city = City::find($this->city_id);
        if(!empty($city)) {
            return $city->name;
        }
    }


    public function getOperationsAttribute($value){

        return [
            "edit" => url('admin/State/viewCreateState/'.$this->id),
            "delete" => url('admin/State/deleteState/'.$this->id),
        ];
    }



}
