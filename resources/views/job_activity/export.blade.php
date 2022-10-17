<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    {{-- <h6> --}}
        <p>JOB HARIAN MAINTANCE</p>
        <p>PALM OIL MILL</p>
        <p>PT.KARYANUSA EKA DAYA 1</p>
        <P>{{ $date }}</p>
    {{-- </h6> --}}
            <br>
        <table>
                    <thead style="border-bottom:3px grey solid;"> 
                        <tr>
                            <th>No</th>
                            <th>Nama Mekanik</th>
                            <th>NPK</th>
                            <th>Kategori</th>
                            <th>Job Mekanik</th>
                            <th>Material</th>
                            <th>Start</th>
                            <th>Pause</th>
                            <th>Stop</th>
                            <th>Durasi</th>
                            <th>Ket. Pause</th>
                        </tr>
                    </thead>
                    <tbody>   
                        <?php $no = 1;?>
                        @foreach ($job_activity as $dt)  
                        <tr>
                            <td rowspan="{{ $dt['rowspan'] }}">{{$no++}}</td>
                            <td rowspan="{{ $dt['rowspan'] }}">{{$dt['name']}}</td>
                            <td rowspan="{{ $dt['rowspan'] }}">{{$dt['npk']}}</td>
                            <td rowspan="{{ $dt['rowspan'] }}" style="text-transform:uppercase;">{{$dt['category']}}</td>    
                            <td rowspan="{{ $dt['rowspan'] }}">{{$dt['job']}}</td>
                            <td rowspan="{{ $dt['rowspan'] }}">{{$dt['material']}}</td> 
                        </tr>
                        @foreach ($dt['times'] as $time)
                            <tr>
                                <td>{{ $time->start_at }}</td>
                                <td>{{ $time->pause_at}}</td>
                                <td>{{ $time->stop_at }}</td>
                                <?php 
                                $start = new DateTime($time->time_start);
                                $stop = new DateTime($time->time_stop);
                                $interval = $start->diff($stop); 
                                ?>
                                @if ($time->time_stop != null)
                                    <td>{{$interval->format("%H:%I:%S") != '00:00:00' ? $interval->format("%H:%I:%S") :''}}</td>
                                @else
                                    <td></td>
                                @endif
                                <td>{{ $time->description }}</td>
                            </tr>
                        @endforeach
                        @endforeach                 
                    </tbody>
                </table>
</body>
</html>
