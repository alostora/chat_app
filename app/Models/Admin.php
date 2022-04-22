<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'permission_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'permission_id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];





    protected $appends = [
        'permissions',
        'operations',
    ];


    public function getPermissionsAttribute($value){

        $permission = Permission::find($this->permission_id);
        if ($permission){
            return $permission->name;
        }

        return 'no permission for this user';
    }



    public function getOperationsAttribute($value){

        return [
            "edit" => url('admin/Admin/viewCreateAdmin/'.$this->id),
            "delete" => url('admin/Admin/deleteAdmin/'.$this->id),
        ];
    }
}
