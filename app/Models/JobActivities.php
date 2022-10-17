<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobActivities extends Model
{
  protected $table = 'job_activities';

  public function user_profile()
  {
    return $this->belongsTo(UserProfiles::class, 'user_profile_id');
  }

  public function job_category()
  {
    return $this->belongsTo(JobCategories::class, 'job_category_id');
  }

  public function station()
  {
    return $this->belongsTo(Stations::class, 'station_id');
  }

  public function times()
  {
    return $this->hasMany(Times::class, 'job_activity_id');
  }

  public function scopeFilter($query, $request)
  {
    if ($request->has('date')) {
      $search = $request->date;
      $query->whereDate('date', $search);
    }
    return $query;
  }

  public static function boot()
  {
    parent::boot();

    static::deleting(function ($job_activities) { // before delete() method call this
      // if ($job_activities->profile()) {
      //   $job_activities->profile()->first()->delete();
      // }
      if ($job_activities->times) {
        foreach ($job_activities->times as $data) {
          $data->delete();
        }
      }
    });
  }
}
