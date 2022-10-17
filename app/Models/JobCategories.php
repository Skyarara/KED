<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobCategories extends Model
{
    protected $table = 'job_categories';

    public function job_activity()
	{
		return $this->hasMany(JobActivities::class, 'job_category_id');
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
