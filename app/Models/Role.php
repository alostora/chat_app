<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = "roles";
    protected $fillable = [
        'roleName',
        'roleNameAr',
    ];



    protected $hidden = [
        'roleName',
        'roleNameAr',
        'updated_at',
        'created_at'
    ];

    protected $appends = [
        'name',
        'operations'
    ];




    public function getNameAttribute($value){
        return app()->getLocale() == 'ar' ? $this->roleNameAr : $this->roleName;
    }




    public function getOperationsAttribute($value){

        return [
            "edit" => url('admin/Admin/Role/viewCreateRole/'.$this->id),
            "delete" => url('admin/Admin/Role/deleteRole/'.$this->id),
        ];
    }
}
