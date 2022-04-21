<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Main_type extends Model
{
    use HasFactory;

    protected $table = 'main_types';
    protected $fillable = [
        "typeName",
        "typeNameAr",
    ];



    protected $hidden = [
        'typeName',
        'typeNameAr',
        'updated_at',
        'created_at'
    ];


    protected $appends = [
        'name',
        'operations'
    ];


    public function getNameAttribute($value){
        return app()->getLocale() == 'ar' ? $this->typeNameAr : $this->typeName;
    }

    public function getOperationsAttribute($value){

        return [
            "edit" => url('admin/Main_type/viewCreateMainType/'.$this->id),
            "delete" => url('admin/Main_type/deleteMainType/'.$this->id),
        ];
    }

}
