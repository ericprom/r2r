<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersWork extends Model
{

	protected $table = 'users_work';
    protected $fillable = [
        'position', 
        'code', 
        'department', 
        'start_date'
    ];
}
