<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class S_category extends Model
{
    use HasFactory;
    protected $table = "s_categories";
    protected $fillable = [
        "categoryName",
        "categoryNameAr",
        "categoryImage",
        "cat_id",
    ];
    

    protected $hidden = [
        'categoryName',
        'categoryNameAr',
        'categoryImage',
        'cat_id',
        'updated_at',
        'created_at'
    ];





    protected $appends = [
        'name',
        'image_url',
        'image_path',
        'main_category',
        'operations'
    ];



    public function getNameAttribute($value){
        return app()->getLocale() == 'ar' ? $this->categoryNameAr : $this->categoryName;
    }



    public function getImageUrlAttribute($value){
        $categoryImage = url('Admin_uploads/s_categories/'.$this->categoryImage);
        return '<img src="'.$categoryImage.'" class="table-image">';
    }



    public function getImagePathAttribute($value){
        return url('Admin_uploads/s_categories/'.$this->categoryImage);
    }



    public function getMainCategoryAttribute($value){

        $mainCat = Category::find($this->cat_id);
        if(!empty($mainCat)) {
            return $mainCat->name;
        }
        return false;
    }



    public function getOperationsAttribute($value){

        return [
                "edit" => url('admin/S_category/viewCreateS_category/'.$this->id),
                "delete" => url('admin/S_category/deleteS_category/'.$this->id),
            ];
    }




}
