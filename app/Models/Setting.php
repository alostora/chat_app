<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = "settings";
    protected $fillable = [

        'siteName',//web site name
        'siteNameAr',
        'siteEmail',
        'siteMobile',
        'sitePhone',
        'siteDesc',
        'siteDescAr',
        'siteImage',
        'siteLogo',

    ];



    protected $hidden = [
        'siteName',
        'siteNameAr',
        'siteDesc',
        'siteDescAr',
        'siteImage',
        'siteLogo',
        'updated_at',
        'created_at'
    ];




    protected $appends = [
        'name',
        'desc',
        'image_url',
        'logo_url',
        'operations'
    ];



    public function getNameAttribute($value){
        return app()->getLocale() == 'ar' ? $this->siteNameAr : $this->siteName;
    }


    public function getDescAttribute($value){
        return app()->getLocale() == 'ar' ? $this->siteDescAr : $this->siteDesc;
    }



    public function getImageUrlAttribute($value){
        $siteImage = url('Admin_uploads/settings/'.$this->siteImage);
        return '<img src="'.$siteImage.'" class="table-image">';
    }


    public function getLogoUrlAttribute($value){
        $siteLogo = url('Admin_uploads/settings/'.$this->siteLogo);
        return '<img src="'.$siteLogo.'" class="table-image">';
    }



    public function getOperationsAttribute($value){

        return [
            "edit" => url('admin/Setting/viewCreateSetting/'.$this->id),
            "delete" => url('admin/Setting/deleteSetting/'.$this->id),
        ];
    }


}


