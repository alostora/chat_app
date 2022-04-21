<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item_size extends Model
{
    use HasFactory;

    protected $table = 'item_sizes';
    protected $fillable = [
        'item_id',
        'size_id',
    ];
}
