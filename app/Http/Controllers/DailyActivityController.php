<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JobActivities;
use App\JobCategories;
use App\Times;
use Carbon\Carbon;
use App\Exports\JobActivitiesExport;
use Excel;
use DateTime;

class DailyActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $categories = JobCategories::get();
        $station = '';
        $category = [];
        $id = [];
        $job_activity = [];
        foreach ($categories as $data) {
            $id[] = $data->id;
            $category[] = $data->name;
        }
        if ($request->date && !$request->station) {
            $date = $request->date;
            $job_activities = JobActivities::with('user_profile', 'job_category', 'station', 'times')
                ->filter($request)
                ->get();
        } else if ($request->station) {
            $date = $request->date;
            $station = $request->station;
            $job_activities = JobActivities::with('user_profile', 'job_category', 'station', 'times')
                ->where('date', $date)
                ->join('stations', 'job_activities.station_id', '=', 'stations.id')
                ->where('name', 'like', "%$station%")
                ->get();
        } else {
            $date = Carbon::now()->toDateString();
            $job_activities = JobActivities::with('user_profile', 'job_category', 'station', 'times')
                ->where('date', $date)
                ->get();
        }
        $count = count($job_activities->where('job_category_id', ($id != [] ? $id[0] : '')));
        $count_second = count($job_activities->where('job_category_id', ($id != [] ? $id[1] : '')));
        foreach ($job_activities as $dt) {
            $start = $dt->times()->where('start_at', '!=', null)->first();
            $start = $start ? $start->start_at : '';
            $pause = $dt->times()->where('pause_at', '!=', null)->first();
            $pause = $pause ? $pause->pause_at : '';
            $stop = $dt->times()->where('stop_at', '!=', null)->first();
            $stop = $stop ? $stop->stop_at : '';
            $job_activity[] =
                [
                    'id'        => $dt->id,
                    'name'      => $dt->user_profile->name,
                    'npk'       => $dt->user_profile->employee_number,
                    'category'  => $dt->job_category->name,
                    'station'   => $dt->station->name,
                    'job'       => $dt->job,
                    'date'      => $dt->date,
                    'material'  => $dt->material,
                    'start'     => $start,
                    'pause'     => $pause,
                    'stop'      => $stop
                ];
        }
        $view = [
            'job_activity' => $job_activity,
            'date' => $date,
            'category' => $category,
            'count' => $count,
            'count_second' => $count_second,
            'station'   => $station
        ];
        return view('job_activity.index')->with($view);
    }

    public function delete_job($id)
    {
        JobActivities::find($id)->delete();
        return redirect()->back()->with('info', 'Berhasil Mengapus Daily Activity');
    }

    public function detail(Request $request, $id)
    {
        $job_activities = JobActivities::with('user_profile', 'job_category', 'station', 'times')->find($id);
        $date = $job_activities->date;
        $user_profile_id = $job_activities->user_profile_id;
        $station = '';
        if ($request->date && !$request->station) {
            $date = $request->date;
            $id = JobActivities::where('date', $request->date)->where('user_profile_id', $user_profile_id)->first();
            if ($id == null) {
                $view = [
                    'user'  =>  $job_activities->user_profile,
                    'job_activities' => '',
                    'start' => '',
                    'stop' => '',
                    'date' => $request->date,
                    'time_stop' => '',
                    'station' => $station
                ];
                return view('job_activity.detail')->with($view);
            }
            $id = $id->id;
            $job_activities = JobActivities::with('user_profile', 'job_category', 'station', 'times')->find($id);
        } else if ($request->station) {
            $station = $request->station;
            $date = $request->date;
            $job_activities = JobActivities::with('user_profile', 'job_category', 'station', 'times')
                ->where('date', $date)
                ->join('stations', 'job_activities.station_id', '=', 'stations.id')
                ->where('name', 'like', "%$station%")
                ->find($id);
            if (!$job_activities) {
                $job_activities = JobActivities::with('user_profile', 'job_category', 'station', 'times')->find($id);
                $view = [
                    'user'  =>  $job_activities->user_profile,
                    'job_activities' => '',
                    'start' => '',
                    'stop' => '',
                    'date' => $request->date,
                    'time_stop' => '',
                    'station' => $station
                ];
                return view('job_activity.detail')->with($view);
            }
        }
        $start = Times::where('job_activity_id', $id)->where('start_at', '!=', '')->value('start_at');
        $stop = Times::where('job_activity_id', $id)->where('stop_at', '!=', '')->value('stop_at');
        $time_stop = Times::where('job_activity_id', $id)->where('time_stop', '!=', '')->value('time_stop');
        $time_stop = $time_stop ? $time_stop : '';
        $start = $start ? $start : '';
        $stop = $stop ? $stop : '';
        $begin = new DateTime($start);
        $end = new DateTime($stop);
        $interval = $begin->diff($end)->format("%H:%I:%S");
        $view = [
            'job_activities' => $job_activities,
            'start' => $start,
            'stop' => $stop,
            'date' => $date,
            'time_stop' => $time_stop,
            'station' => $station,
            'interval' => $interval
        ];
        return view('job_activity.detail')->with($view);
    }

    public function delete($Id)
    {
        Times::find($Id)->delete();
        return redirect()->back()->with('info', 'Berhasil Mengapus Data');
    }

    public function edit_page($id, $Id)
    {
        $time = Times::with('job_activity')->find($Id);
        return view('job_activity.edit', compact('time', 'id', 'Id'));
    }

    public function update($id, $Id, Request $request)
    {
        $time = Times::with('job_activity')->find($Id);
        switch ($request->check) {
            case '1':
                $time->start_at = $request->waktu;
                $time->pause_at = null;
                $time->stop_at = null;
                break;
            case '2':
                $time->start_at = null;
                $time->pause_at = $request->waktu;
                $time->stop_at = null;
                break;
            default:
                $time->start_at = null;
                $time->pause_at = null;
                $time->stop_at = $request->waktu;
                break;
        }
        $time->update();
        $path = "/daily_activity/detail/$id";
        return redirect($path)->with('info', 'Berhasil Mengubah Data');
    }

    public function export()
    {
        return Excel::download(new JobActivitiesExport, 'Job_Activity.xlsx');
    }
}
