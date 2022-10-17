<?php

namespace App\Exports;

use App\JobActivities;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;

class JobActivitiesExport implements FromView, ShouldAutoSize, WithEvents
{
    use Exportable, RegistersEventListeners;

    public static function beforeSheet(BeforeSheet $event)
    {
        $vertical = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => false,
            ],
            'font' => [
                'bold' => true,
            ],
        ];
        $event->sheet->getDelegate()->mergeCells('A2:K2');
        $event->sheet->getDelegate()->mergeCells('A3:K3');
        $event->sheet->getDelegate()->mergeCells('A4:K4');
        $event->sheet->getDelegate()->mergeCells('A5:K5');
        $event->sheet->getDelegate()->mergeCells('A1:K1')->getStyle('A1:K4')->applyFromArray($vertical);
    }

    public static function afterSheet(AfterSheet $event)
    {
        $event->sheet->getDelegate()->getStyle('A6:K6')->getFont()->setBold('bold');
        $styleArray = [
                            'borders' => [
                                'allBorders' => [
                                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                    'color' => ['black'],
                                ],
                            ],
                        ];
        $end_row = $event->sheet->getHighestRow();
        $event->sheet->getDelegate()->getStyle("A6:K$end_row")->applyFromArray($styleArray);
    }

    public function view(): View
    {
        $tanggal = request()->get('date');

        $job_activity = [];
        $station = '';
        // if ($request->date && !$request->station) {
        //     $date = $request->date;
        //     $job_activities = JobActivities::with('user_profile', 'job_category', 'station', 'times')
        //         ->filter($request)
        //         ->get();
        // } else if ($request->station) {
        //     $date = $request->date;
        //     $station = $request->station;
        //     $job_activities = JobActivities::with('user_profile', 'job_category', 'station', 'times')
        //         ->where('date', $date)
        //         ->join('stations', 'job_activities.station_id', '=', 'stations.id')
        //         ->where('name', 'like', "%$station%")
        //         ->get();
        // } else {
        if ($tanggal == null) {
            $job_activities = JobActivities::with('user_profile', 'job_category', 'station', 'times')->get();
            $date = null;
        } else {
            $job_activities = JobActivities::with('user_profile', 'job_category', 'station', 'times')
            ->where('date', $tanggal)
            ->get();
            $date = Carbon::parse($tanggal)->format('d F Y');
        }

        // }
        foreach ($job_activities as $dt) {
            $start = $dt->times()->where('start_at', '!=', null)->first();
            $start = $start ? $start->start_at : '';
            $pause = $dt->times()->where('pause_at', '!=', null)->first();
            $pause = $pause ? $pause->pause_at : '';
            $stop = $dt->times()->where('stop_at', '!=', null)->first();
            $stop = $stop ? $stop->stop_at : '';
            $job_activity[] =
                [
                    'id' => $dt->id,
                    'name' => $dt->user_profile->name,
                    'npk' => $dt->user_profile->employee_number,
                    'category' => $dt->job_category->name,
                    'station' => $dt->station->name,
                    'job' => $dt->job,
                    'date' => $dt->date,
                    'material' => $dt->material,
                    'start' => $start,
                    'pause' => $pause,
                    'stop' => $stop,
                    'times' => $dt->times,
                    'rowspan' => $dt->times->count() + 1,
                ];
        }
        $view = [
            'job_activity' => $job_activity,
            'date' => $date,
            'station' => $station,
        ];

        return view('job_activity.export')->with($view);
    }
}
