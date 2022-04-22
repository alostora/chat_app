<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Chat\User_lang;

class User extends Authenticatable
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
        'country',
        'country_key',
        'online',//bolean
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'image',
        'phone',
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
        'langauges',
        'operations'
    ];



    public function getImageUrlAttribute($value){
        $image = url('uploads/users/'.$this->image);
        return '<img src="'.$image.'" class="table-image">';
    }


    public function getImagePathAttribute($value){
        return url('uploads/users/'.$this->image);
    }



    public function getLangaugesAttribute($value){
        return User_lang::where('user_id',$this->id)->get();
    }



    public function getOperationsAttribute($value){

        return [
            "edit" => url('admin/User/viewCreateUser/'.$this->id),
            "delete" => url('admin/User/deleteUser/'.$this->id),
        ];
    }

}
