<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Vendor extends Authenticatable
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
        'phone',
        'image',
        'gender',
        'birthDate',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'image',
        'image_path',
        'password',
        'verify_token',
        'api_token',
        'remember_token',
        'email_verified_at',
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
        'image_url',
        'image_path',
        'operations'
    ];



    public function getImageUrlAttribute($value){
        $image = url('uploads/vendors/'.$this->image);
        return '<img src="'.$image.'" class="table-image">';
    }


    public function getImagePathAttribute($value){
        return url('uploads/vendors/'.$this->image);
    }



    public function getOperationsAttribute($value){

        return [
            "edit" => url('admin/Vendor/viewCreateVendor/'.$this->id),
            "delete" => url('admin/Vendor/deleteVendor/'.$this->id),
        ];
    }

}
