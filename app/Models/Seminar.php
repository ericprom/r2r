<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    
	protected $fillable = [
        'title', 
        'start_date', 
        'end_date', 
        'fiscal_year', 
        'seminar_pdf_id', 
        'knowledge_pdf_id'
    ];

    public function seminar()
    {
        $instance = $this->hasOne('App\Models\Source', 'id', 'seminar_pdf_id');
        $instance->getQuery()->where('active','=', '1');
        return $instance;
    }
    
    public function knowledge()
    {
        $instance = $this->hasOne('App\Models\Source', 'id', 'knowledge_pdf_id');
        $instance->getQuery()->where('active','=', '1');
        return $instance;
    }

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("title", "LIKE","%$keyword%")
                    ->orWhere("start_date", "LIKE", "%$keyword%")
                    ->orWhere("end_date", "LIKE", "%$keyword%")
                    ->orWhere("fiscal_year", "LIKE", "%$keyword%")
                    ->orWhereHas('seminar', function($query) use($keyword) {
                        $query->where("name", "LIKE", "%$keyword%");
                    })->orWhereHas('knowledge', function($query) use($keyword) {
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
