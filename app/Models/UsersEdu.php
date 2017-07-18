<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersEdu extends Model
{
	protected $table = 'users_edu';
    protected $fillable = [
        'degree', 
        'type', 
        'department', 
        'faculty', 
        'university'
    ];
}
