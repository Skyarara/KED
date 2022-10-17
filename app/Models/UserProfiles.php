<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfiles extends Model
{
    public function user()
	  {
		return $this->hasOne(User::class, 'id', 'user_id');
    }
    
    public function job_activities()
	  {
		return $this->hasMany(JobActivities::class, 'user_profile_id');
    }

    public function scopeFiltername($query, $request)
    {
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%");
        }
        return $query;
    }

    public function scopeFilternpk($query, $request)
    {
        if ($request->has('search2')) {
            $search = $request->search;
            $query->where('employee_number', 'like', "%$search%");
        }
        return $query;
    }

}
