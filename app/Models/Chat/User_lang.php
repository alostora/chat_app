<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lang;

class User_lang extends Model
{
    use HasFactory;
    protected $table = 'user_langs';
    protected $fillable = [
        'user_id',
        'lang_id',
        'type',//['teach','study']
    ];



    protected $hidden = [
        'lang_id',
        'user_id',
        'created_at',
        'updated_at',
    ];



    protected $appends = [
        'name',
        'code',
    ];





    public function getNameAttribute($value){
        return Lang::find($this->lang_id)->langName;
    }

    public function getCodeAttribute($value){
        return Lang::find($this->lang_id)->langCode;
    }


}
