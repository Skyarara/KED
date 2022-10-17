<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\JobActivities;
use Validator;
use App\Times;
use App\UserProfiles;
use App\JobCategories;
use App\Stations;

class DailyActivityController extends Controller
{
    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        $user_profile = UserProfiles::find($user_id)->id;
        $job_activities = JobActivities::where('user_profile_id', $user_profile)->orderBy('date', 'desc')->filter($request)->get();
        if ($job_activities->isEmpty()) {
            $response = [
                'code' => 404,
                'message' => 'tidak ada job activity dengan user ini',
                'data' => null
            ];
            return response()->json($response, 404);
        }

        $data_result = [];
        foreach ($job_activities as $dt) {
            $data_times = Times::select('id', 'job_activity_id', 'time_start', 'start_at', 'pause_at', 'time_stop', 'stop_at', 'description')
                ->where('job_activity_id', $dt->id)
                ->get();
            $category = JobCategories::find($dt->job_category_id);
            $station = Stations::find($dt->station_id);
            $data_result[] = ([
                'id' => (int) $dt->id,
                'job_category_id' => (int) $dt->job_category_id,
                'job_category_name' => $category->name,
                'station_id' => (int) $dt->station_id,
                'station_name' => $station->name,
                'job' => $dt->job,
                'material' => $dt->material,
                'date' => $dt->date,
                'user_profile_id' => (int) $dt->user_profile_id,
                'time'  =>  $data_times
            ]);
        }
        $response = [
            'code' => 200,
            'message' => 'Sukses Mengambil data Job Activities',
            'data' => $data_result
        ];
        return response()->json($response, 200);
    }
    public function add(Request $request)
    {
        $rules = array(
            'job_category_id' => 'required',
            'station_id' => 'required',
            'job' => 'required',
            'material' => 'required',
            'date' => 'required',
            'user_profile_id' => 'required'
        );
        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()) {
            return response()->json(['error' => 'data tidak valid'], 401);
        }
        $job_activities = new JobActivities();
        $job_activities->job_category_id = $request->job_category_id;
        $job_activities->station_id = $request->station_id;
        $job_activities->job = $request->job;
        $job_activities->material = $request->material;
        $job_activities->date = $request->date;
        $job_activities->user_profile_id = $request->user_profile_id;
        $job_activities->save();

        $response = [
            'code' => 200,
            'message' => 'Sukses menambahkan data Job Activities',
            'data' => [
                'id' => (int) $job_activities->id,
                'job_category_id' => (int) $job_activities->job_category_id,
                'station_id' => (int) $job_activities->station_id,
                'job' => $job_activities->job,
                'material' => $job_activities->material,
                'date' => $job_activities->date,
                'user_profile_id' => (int) $job_activities->user_profile_id,
            ],
        ];
        return response()->json($response, 200);
    }
    public function detail(Request $request)
    {
        $id = $request->job_activity_id;
        $data_time = [];
        if ($id == null) {
            return response()->json(['error' => 'data tidak valid'], 401);
        }
        $job_activities = JobActivities::with('user_profile', 'job_category', 'station', 'times')->find($id);
        $time = Times::where('job_activity_id', $id)->get();
        foreach ($time as $dt) {
            $data_time[] = ([
                'id' => $dt->id,
                'job_activity_id' => (int) $dt->job_activity_id,
                'time_start' => $dt->time_start,
                'time_stop' => $dt->time_stop,
                'start_at' => $dt->start_at,
                'stop_at' => $dt->pause_at,
                'pause_at' => $dt->stop_at,
                'description' => $dt->description
            ]);
        }
        $response = [
            'code' => 200,
            'message' => 'Sukses menampilkan detail data Job Activities',
            'data' => [
                'id' => (int) $job_activities->id,
                'job_category_id' => (int) $job_activities->job_category_id,
                'station_id' => (int) $job_activities->station_id,
                'job' => $job_activities->job,
                'material' => $job_activities->material,
                'date' => $job_activities->date,
                'user_profile_id' => (int) $job_activities->user_profile_id,
                'time'  => $data_time,
            ],
        ];
        return response()->json($response, 200);
    }
}
