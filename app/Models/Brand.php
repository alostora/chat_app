<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory; 

    protected $table = "brands";
    protected $fillable = [
        "brandName",
        "brandNameAr",
        "brandImage",
    ];
    

    protected $hidden = [
        'brandName',
        'brandNameAr',
        'brandImage',
        'updated_at',
        'created_at'
    ];




    protected $appends = [
        'name',
        'image_url',
        'image_path',
        'operations'
    ];


    public function getNameAttribute($value){
        return app()->getLocale() == 'ar' ? $this->brandNameAr : $this->brandName;
    }



    public function getImageUrlAttribute($value){

        $brandImage = url('Admin_uploads/brands/'.$this->brandImage);
        return '<img src="'.$brandImage.'" class="table-image">';
    }



    public function getImagePathAttribute($value){
        return url('Admin_uploads/brands/'.$this->brandImage);
    }



    public function getOperationsAttribute($value){

        return [
            "edit" => url('admin/Brand/viewCreateBrand/'.$this->id),
            "delete" => url('admin/Brand/deleteBrand/'.$this->id),
        ];
    }




}
