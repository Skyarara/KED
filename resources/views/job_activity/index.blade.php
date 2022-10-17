@extends('layout.app') 

@section ('title', 'Job Activities')     

@section ('content-header')  
<h3><b>Daily Activity</b></h3><br>
@stop

@section ('content-body')  
<div class="container">
        <div class="row">
                <div class="col-md-1">
                        <div class="btn-group mb-1">
                                <button type="button" class="btn btn-secondary dropdown-toggle btn-lg" id="option" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{!$station ? 'Tanggal ':'Station' }}</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item date">Tanggal</a>
                                    <a class="dropdown-item station">Station</a>
                                </div>
                            </div>
                </div>
            <form method="get" action="{{url()->current()}}" >
                <div class="col-md-8" id="search_input">
                <input type="date" class="form-control" name="date" id="date" value="{{$date}}" {{$station ? 'hidden' :''}}>
                <input type="text" class="form-control" name="station" id="station" placeholder="Masukan Station" value="{{$station}}" {{$station ? '' :'hidden'}}>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-secondary btn-lg" id="search"><i class="icon-search" style="font-size:15px; color:white;"></i></button>
                </div>
            </form>
                <div class="col-md-1">
                    <form method="POST" action="{{route('activity.excel')}}">
                        <input type="hidden" name="date" id="exportdate">
                    @csrf
                    <button type='submit' class="btn btn-secondary btn-md" id='print'>Print</button>
                    </form>
                </div>
            </div>
    <div class="row">
        <div class="col-md-9">
            <div class="card" style="zoom: 1;">
                <div class="card-header">
                    <h6 class="card-title">Persentase Kategori Pekerjaan Mekanik</h6>
                        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                </div>
        <div class="card-body collapse in">
            <div class="card-block">
                <iframe class="chartjs-hidden-iframe" tabindex="-1" id="iframe"></iframe>
                    <canvas id="myChart" height="150px" width="471"></canvas>
                    @php 
                        $data = [$count, $count_second];
                        $summed = array_sum($data);
                    @endphp
                    @if($summed >= 1)
                        @foreach ($category as $i => $item)
                            @if(isset($data[$i]))
                                {!! $item.": ".($data[$i]/$summed*100)."%<br>" !!}
                            @endif
                        @endforeach
                    @endif
                </div>
        </div>
            </div>
        </div>
        <div class="col-md-3">
                <div class="card" style="height: 316px;">
                    <div class="card-header">
                        <h6 class="card-title">Tanggal</h6>
                    </div>
                    <div class="card-body">
                        <div class="card-block" style="margin-top:30%; margin-left:25px;">
                             <?php $explode = explode('-',$date)?>
                            <p class="card-text" style="font-size:30px;" id="date-text">
                                {{$explode[2] . '.' . $explode[1] . '.' . $explode[0]}}
                            </p>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="card">
        <div class="card-content">
            <div class="card-body card-dashboard ">
            </div>
            <div class="table-responsive str">
                <table class="table mb-0 table-borderless table-striped table-responsive table-hover">
                    <thead style="border-bottom:3px grey solid;"> 
                        <tr>
                            <th style="vertical-align:middle; text-align:center;">No</th>
                            <th style="vertical-align:middle; text-align:center;">Nama Mekanik</th>
                            <th style="vertical-align:middle; text-align:center;">NPK</th>
                            <th style="vertical-align:middle; text-align:center;">Kategori</th>
                            <th style="vertical-align:middle; text-align:center;">Station</th>
                            <th style="vertical-align:middle; text-align:center;">Job Mekanik</th>
                            <th style="vertical-align:middle; text-align:center;">Tanggal</th>
                            <th style="vertical-align:middle; text-align:center;">Material</th>
                            <th style="vertical-align:middle; text-align:center;">Start</th>
                            <th style="vertical-align:middle; text-align:center;">Stop</th>
                            <th style="vertical-align:middle; text-align:center;">Durasi</th>
                            <th style="vertical-align:middle; text-align:center;">Option</th>
                        </tr>
                    </thead>
                    <tbody>   
                        <?php $no = 1;?>
                        @foreach ($job_activity as $dt)  
                        <tr>
                        <td>{{$no++}}</td>
                        <td>{{$dt['name']}}</td>
                        <td>{{$dt['npk']}}</td>
                        <td style="text-transform:uppercase;">{{$dt['category']}}</td>    
                        <td>{{$dt['station']}}</td>
                        <td>{{$dt['job']}}</td>
                        <td>{{$dt['date']}}</td>
                        <td>{{$dt['material']}}</td>
                        <td>{{$dt['start']}}</td>
                        <td>{{$dt['stop']}}</td>
                        <?php 
                        $start = new DateTime($dt['start']);
                        $stop = new DateTime($dt['stop']);
                        $interval = $start->diff($stop); 
                        ?>
                        <td>{{$interval->format("%H:%I:%S") != '00:00:00' ? $interval->format("%H:%I:%S") :''}}</td>
                        <td>
                            <a style="color:#696B6C;" href="/daily_activity/detail/{{$dt['id']}}"><i class="icon-ei-eye" style="font-size:25px;"></i> Detail</a>
                            <a onclick="delete_data({{$dt['id']}});"><i class="icon-trash-o" style="margin-left:10px; color:#696B6C;"> Hapus</i></a>
                        </td>
                        </tr>
                            @endforeach                 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/job_activities.css') }}">
@endsection

@section('js')
<script src="{{ url('js/daily_activity/index.js') }}"></script>
<script>
    $('#date').on('change', function(){
        $('#exportdate').val(this.value);
    });
    $('document').ready(function(){
        $('#exportdate').val($('#date').val());
    })
</script>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($category) !!},
        datasets: [{
            data: [{{$count}}, {{$count_second}}],
            backgroundColor: [
                '#94C557',
                '#57C2C3',
            ],
        }]
    },
    options: {
         legend: {
            display: true
         },
    }
});

        $(document).ready(function(){
            @if(session('info'))
            swal({
             title: "{{session('info')}}",
             text: "",
             icon: "success",        
         })
            @endif
        });
</script>
@endsection
