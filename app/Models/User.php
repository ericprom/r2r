<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Notifiable, Authenticatable, CanResetPassword, EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'avatar', 'email', 'password', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role_user');
    }

    public function info()
    {
        $instance = $this->hasOne('App\Models\UsersInfo', 'user_id');
        return $instance;
    }

    public function work()
    {
        $instance = $this->hasOne('App\Models\UsersWork', 'user_id');
        return $instance;
    }

    public function edu()
    {
        $instance = $this->hasOne('App\Models\UsersEdu', 'user_id');
        return $instance;
    }

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("name", "LIKE","%$keyword%")
                    ->orWhereHas('info', function($query) use($keyword) {
                        $query->where("name", "LIKE", "%$keyword%")
                        ->orWhere("gender", "LIKE", "%$keyword%")
                        ->orWhere("origin", "LIKE", "%$keyword%")
                        ->orWhere("nationality", "LIKE", "%$keyword%")
                        ->orWhere("blood_group", "LIKE", "%$keyword%")
                        ->orWhere("religion", "LIKE", "%$keyword%")
                        ->orWhere("address", "LIKE", "%$keyword%")
                        ->orWhere("id_card", "LIKE", "%$keyword%")
                        ->orWhere("phone", "LIKE", "%$keyword%");
                    })
                    ->orWhereHas('work', function($query) use($keyword) {
                        $query->where("position", "LIKE", "%$keyword%")
                        ->orWhere("code", "LIKE", "%$keyword%")
                        ->orWhere("department", "LIKE", "%$keyword%");
                    })
                    ->orWhereHas('edu', function($query) use($keyword) {
                        $query->where("degree", "LIKE", "%$keyword%")
                        ->orWhere("type", "LIKE", "%$keyword%")
                        ->orWhere("department", "LIKE", "%$keyword%")
                        ->orWhere("faculty", "LIKE", "%$keyword%")
                        ->orWhere("university", "LIKE", "%$keyword%");
                    });
            });
        }
        return $query;
    }

    public function scopeSearchByDate($query, $from, $to, $option = 'created_at')
    {
        $query->where(function ($query) use ($option, $from, $to) {
            $query->whereBetween($option, [$from, $to]);
        });
        return $query;
    }
}
