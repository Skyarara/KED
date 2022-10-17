<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Times;
use Validator;
use Carbon\Carbon;

class TimeController extends Controller
{
    public function add(Request $request)
    {
        $rules = array(
            'job_activity_id' => 'required',
            'time_start' => 'required',
            'description' => 'required'
        );
        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()) {
            return response()->json(['error' => 'data tidak valid'], 401);
        }
        $times = new Times();
        $times->job_activity_id = $request->job_activity_id;
        $times->time_start = $request->time_start;
        $times->time_stop = $request->time_stop;
        $times->start_at = $request->start_at;
        $times->pause_at = $request->pause_at;
        $times->stop_at = $request->stop_at;
        $times->description = $request->description;
        $times->save();

        $response = [
            'code' => 200,
            'message' => 'Sukses menambahkan data Times',
            'data' => [
                'id' => $times->id,
                'job_activity_id' => (int) $times->job_activity_id,
                'time_start' => $times->time_start,
                'time_stop' => $times->time_stop,
                'start_at' => $times->start_at,
                'stop_at' => $times->pause_at,
                'pause_at' => $times->stop_at,
                'description' => $times->description
            ],
        ];
        return response()->json($response, 200);
    }

    public function update_pause(Request $request)
    {
        $time = Times::find($request->id);
        if ($time == null) {
            return response()->json(['error' => 'data tidak valid'], 404);
        }
        $data = [
            'time_start' => $time->time_start,
            'time_stop' => null,
            'start_at' => $time->start_at,
            'stop_at' => null,
            'pause_at' => $request->pause_at,
            'description' => $request->description
        ];
        $time->update($data);

        $response = [
            'code' => 200,
            'message' => 'Sukses mengubah data Pause',
            'data' => [
                'id' => $time->id,
                'job_activity_id' => (int) $time->job_activity_id,
                'time_start' => $time->time_start,
                'time_stop' => $time->time_stop,
                'start_at' => $time->start_at,
                'stop_at' => $time->stop_at,
                'pause_at' => $time->pause_at,
                'description' => $time->description
            ],
        ];
        return response()->json($response, 200);
    }

    public function update_stop(Request $request)
    {
        $time = Times::find($request->id);
        if ($time == null) {
            return response()->json(['error' => 'data tidak valid'], 404);
        }
        $data = [
            'time_start' => $time->time_start,
            'time_stop' => $request->time_stop,
            'start_at' => $time->start_at,
            'stop_at' => $request->stop_at,
            'pause_at' => $time->pause_at,
            'description' => $time->description
        ];

        $time->update($data);

        $response = [
            'code' => 200,
            'message' => 'Sukses mengubah data Stop',
            'data' => [
                'id' => $time->id,
                'job_activity_id' => (int) $time->job_activity_id,
                'time_start' => $time->time_start,
                'time_stop' => $time->time_stop,
                'start_at' => $time->start_at,
                'stop_at' => $time->stop_at,
                'pause_at' => $time->pause_at,
                'description' => $time->description
            ],
        ];
        return response()->json($response, 200);
    }
}
