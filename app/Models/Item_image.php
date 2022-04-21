<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item_image extends Model
{
    use HasFactory;
    protected $table = 'item_images';
    protected $fillable = [

        'imageName',
        'isDefault',
        'isBanner',
        'isSlider',
        'item_id',
    ];


    protected $hidden = [
        'imageName',
        'updated_at',
        'created_at'
    ];


    protected $appends = [
        'image_url',
        'image_path',
    ];



    
    public function getImageUrlAttribute($value){
        $imageName = url('Admin_uploads/items/'.$this->imageName);
        return '<img src="'.$imageName.'" class="table-image">';
    }



    public function getImagePathAttribute($value){
        return url('Admin_uploads/items/'.$this->imageName);
    }




}
