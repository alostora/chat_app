<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models;


class Category extends Model
{
    use HasFactory;
    protected $table = "categories";
    protected $fillable = [
        "categoryName",
        "categoryNameAr",
        "categoryImage",
        "type_id",//same size type in sizes table
    ];
    

    protected $hidden = [
        'categoryName',
        'categoryNameAr',
        'categoryImage',
        'image_path',
        'type_id',
        'updated_at',
        'created_at'
    ];



    protected $appends = [
        'name',
        'image_url',
        'image_path',
        'type',
        'operations'
    ];



    public function getNameAttribute($value){
        return app()->getLocale() == 'ar' ? $this->categoryNameAr : $this->categoryName;
    }



    public function getImageUrlAttribute($value){
        $categoryImage = url('Admin_uploads/categories/'.$this->categoryImage);
        return '<img src="'.$categoryImage.'" class="table-image">';
    }


    public function getImagePathAttribute($value){
        return url('Admin_uploads/categories/'.$this->categoryImage);
    }



    public function getTypeAttribute($value){

        $mainType = Main_type::find($this->type_id);
        if(!empty($mainType)) {
            return $mainType->name;
        }
        return false;
    }



    public function getOperationsAttribute($value){

        return [
            "edit" => url('admin/Category/viewCreateCategory/'.$this->id),
            "delete" => url('admin/Category/deleteCategory/'.$this->id),
        ];
    }



}
