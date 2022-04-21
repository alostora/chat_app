<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measur_unit extends Model
{
    use HasFactory;
    protected $table = 'measur_units';
    protected $fillable = [
        "unitName",
        "unitNameAr",
        "unitCode",
        "unitType",//tall,weight,lequed,....
    ];



    protected $hidden = [
        'unitName',
        'unitNameAr',
        'updated_at',
        'created_at'
    ];


    

    protected $appends = [
        'name',
        'operations'
    ];


    public function getNameAttribute($value){
        return app()->getLocale() == 'ar' ? $this->unitNameAr : $this->unitName;
    }

    public function getOperationsAttribute($value){

        return [
            "edit" => url('admin/Measur_unit/viewCreateMeasurUnit/'.$this->id),
            "delete" => url('admin/Measur_unit/deleteMeasurUnit/'.$this->id),
        ];
    }
}
