<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersInfo extends Model
{
    protected $table = 'users_info';
    protected $fillable = [
        'name', 
        'gender', 
        'origin', 
        'nationality', 
        'status', 
        'blood_group', 
        'religion', 
        'address', 
        'id_card', 
        'phone'
    ];
}
