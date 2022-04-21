<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $table = 'colors';
    protected $fillable = [
        "colorName",
        "colorNameAr",
        "colorCode",
    ];



    protected $hidden = [
        'colorName',
        'colorNameAr',
        'colorCode',
        'updated_at',
        'created_at'
    ];

    protected $appends = [
        'name',
        'code',
        'operations'
    ];




    public function getNameAttribute($value){
        return app()->getLocale() == 'ar' ? $this->colorNameAr : $this->colorName;
    }


    public function getCodeAttribute($value){
        return '<label class="colorCode" style="background-color:'.$this->colorCode.'"></label>';
    }



    public function getOperationsAttribute($value){

        return [
            "edit" => url('admin/Color/viewCreateColor/'.$this->id),
            "delete" => url('admin/Color/deleteColor/'.$this->id),
        ];
    }


}
