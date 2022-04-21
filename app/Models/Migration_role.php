<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Migration_role extends Model
{
    use HasFactory;

    protected $table = 'migration_roles'; 
    protected $fillable = [
        'permission_id',
        'migration_id',
        'role_id',
    ];
}
