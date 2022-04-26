<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Chat\User_lang;
use Carbon\Carbon;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    
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
        'bio',
        'firebase_token',
    ];

    
    protected $hidden = [
        'image',
        'phone',
        'image_path',
        'password',
        'verify_token',
        'api_token',
        'remember_token',
        'email_verified_at',
        'firebase_token',
        'created_at',
        'updated_at',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];



    protected $appends = [
        'age',
        'image_url',
        'image_path',
        'langauges',
        'operations'
    ];



    public function getImageUrlAttribute($value){
        $image = url('uploads/users/'.$this->image);
        if ($this->image == 'defaultLogo.png') {
            if ($this->gender == 'male') {
                $image = url('uploads/users/male.png');
            }else{
                $image = url('uploads/users/female.jpeg');
            }
        }
        return '<img src="'.$image.'" class="table-image">';
    }


    public function getImagePathAttribute($value){

        $image = url('uploads/users/'.$this->image);
        if ($this->image == 'defaultLogo.png') {
            if ($this->gender == 'male') {
                $image = url('uploads/users/male.png');
            }else{
                $image = url('uploads/users/female.jpeg');
            }
        }

        return $image;
    }



    public function getLangaugesAttribute($value){
        return User_lang::where('user_id',$this->id)->get();
    }


    public function getAgeAttribute()
    {
        return Carbon::parse($this->birthDate)->age;
    }

    public function getOperationsAttribute($value){

        return [
            "edit" => url('admin/User/viewCreateUser/'.$this->id),
            "delete" => url('admin/User/deleteUser/'.$this->id),
        ];
    }



    public function langauges(){
        return $this->hasMany(User_lang::class,'user_id');
    }

}
