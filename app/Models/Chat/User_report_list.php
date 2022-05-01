<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_report_list extends Model
{
    use HasFactory;
    protected $table = 'user_report_lists';
    protected $fillable = [

        'admin_action',//boolean
        'report_reason',
        'report_to',//user_id users table
        'report_from',//user_id users table
        'admin_id',//admin_id admins table

    ];
}
