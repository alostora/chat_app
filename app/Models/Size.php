<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $table = 'sizes';
    protected $fillable = [
        "sizeName",
        "sizeNameAr",
        "sizeValue",
        "type_id",//same category type in categories table
    ];



    protected $hidden = [
        'sizeName',
        'sizeNameAr',
        'updated_at',
        'created_at'
    ];


    protected $appends = [
        'name',
        'main_type',
        'operations'
    ];


    public function getNameAttribute($value){
        return app()->getLocale() == 'ar' ? $this->sizeNameAr : $this->sizeName;
    }


    public function getMainTypeAttribute($value){
        $mainType = Main_type::find($this->type_id);
        if(!empty($mainType)) {
            return $mainType->name;
        }
    }


    public function getOperationsAttribute($value){

        return [
            "edit" => url('admin/Size/viewCreateSize/'.$this->id),
            "delete" => url('admin/Size/deleteSize/'.$this->id),
        ];
    }


}

