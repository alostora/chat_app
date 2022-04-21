<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';
    protected $fillable = [
        'countryName',
        'countryNameAr',
        'countryPhoneKey',
        'countryCode',
        'countryCurrency',
        'countryFlag',
    ];



    protected $hidden = [
        'countryName',
        'countryNameAr',
        'countryFlag',
        'updated_at',
        'created_at',
    ];



    protected $appends = [
        'name',
        'image_url',
        'image_path',
        'operations'
    ];



    public function getNameAttribute($value){
        return app()->getLocale() == 'ar' ? $this->countryNameAr : $this->countryName;
    }



    public function getImageUrlAttribute($value){
        $countryFlag = url('Admin_uploads/countries/'.$this->countryFlag);
        return '<img src="'.$countryFlag.'" class="table-image">';
    }

    public function getImagePathAttribute($value){
        return url('Admin_uploads/countries/'.$this->countryFlag);
    }



    public function getOperationsAttribute($value){
        return [
            "edit" => url('admin/Country/viewCreateCountry/'.$this->id),
            "delete" => url('admin/Country/deleteCountry/'.$this->id),
        ];
    }



}
