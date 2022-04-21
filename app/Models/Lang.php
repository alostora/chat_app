<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{
    use HasFactory;
    protected $table = 'langs';
    protected $fillable = [
        "langName",
        "langCode",
    ];



    protected $hidden = [
        'langName',
        'updated_at',
        'created_at'
    ];


    

    protected $appends = [
        'name',
        'operations'
    ];


    public function getNameAttribute($value){
        return $this->langName;
    }

    public function getOperationsAttribute($value){

        return [
            "edit" => url('admin/Lang/viewCreateLang/'.$this->id),
            "delete" => url('admin/Lang/deleteLang/'.$this->id),
        ];
    }
}
