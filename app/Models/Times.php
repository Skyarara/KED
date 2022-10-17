<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Times extends Model
{
    protected $table = 'times';

    protected $fillable = ['time_start', 'time_stop', 'start_at', 'pause_at', 'stop_at', 'description', 'job_activity_id'];
    public function job_activity()
    {
        return $this->belongsTo(JobActivities::class, 'job_activity_id');
    }
}
