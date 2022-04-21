<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $table = 'permissions';
    protected $fillable = [
        'permissionName',
        'permissionNameAr'

    ];


    protected $hidden = [
        'permissionName',
        'permissionNameAr',
        'created_at',
        'updated_at',
    ];



    protected $appends = [
        'name',
        'operations',
    ];



    public function getNameAttribute($value){
        return app()->getLocale() == 'ar' ? $this->permissionName : $this->permissionNameAr;
    }


    public function getOperationsAttribute($value){
        return [
            "edit" => url('admin/Admin/Permission/viewCreatePermission/'.$this->id),
            "delete" => url('admin/Admin/Permission/deletePermission/'.$this->id),
        ];
    }
}
