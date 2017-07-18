<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annoucement extends Model
{

	protected $fillable = [
        'title', 
        'detail'
    ];

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("title", "LIKE","%$keyword%")
                    ->orWhere("detail", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }

    public function reporter()
    {
        $instance = $this->hasOne('App\Models\User', 'id', 'user_id');
        $instance->getQuery()->where('active','=', '1');
        return $instance;
    }
}
