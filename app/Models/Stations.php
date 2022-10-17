<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stations extends Model
{
    protected $table = 'stations';

    public function job_activity()
    {
        return $this->hasMany(JobActivities::class, 'station_id');
    }

    public function scopeFilter($query, $request)
    {
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%");
        }
        return $query;
    }
}
