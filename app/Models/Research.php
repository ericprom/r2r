<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
	protected $fillable = [
        'title', 
        'fiscal_year', 
        'type_id', 
        'level_id', 
        'researcher', 
        'secondry_researcher', 
        'publisher', 
        'research_pdf_id'
    ];

    public function research()
    {
        $instance = $this->hasOne('App\Models\Source', 'id', 'research_pdf_id');
        $instance->getQuery()->where('active','=', '1');
        return $instance;
    }

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("title", "LIKE","%$keyword%")
                    ->orWhere("fiscal_year", "LIKE", "%$keyword%")
                    ->orWhere("researcher", "LIKE", "%$keyword%")
                    ->orWhere("secondry_researcher", "LIKE", "%$keyword%")
                    ->orWhere("publisher", "LIKE", "%$keyword%")
                    ->orWhereHas('research', function($query) use($keyword) {
                        $query->where("name", "LIKE", "%$keyword%");
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


