<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Migration extends Model
{
    use HasFactory;
    protected $table = 'migrations';
    
    protected $hidden = [
        'migration',
    ];

    protected $appends = [
        'name',
    ];




    public function getNameAttribute($value){
        $str = $this->migration;
        if (preg_match('/_create_(.*?)_table/', $str, $match) == 1) {
            return $match[1];
        }
    }


}
