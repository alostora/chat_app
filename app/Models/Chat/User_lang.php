<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_lang extends Model
{
    use HasFactory;
    protected $table = 'user_langs';
    protected $fillable = [
        'user_id',
        'lang_id',
        'type',//['teach','study']
    ];
}
