@extends('layout.app') 

@section ('title', 'Detail Job Activities')     

@section ('content-header')  
<h3><b>Detail Daily Activity</b></h3><br>
@stop

@section ('content-body')  
<div class="container">
        <div class="row">
                <div class="col-md-2 ">
                        <div class="btn-group mb-1">
                                <button type="button" class="btn btn-secondary dropdown-toggle btn-lg" id="option" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{!$station ? 'Tanggal ':'Station' }}</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item date">Tanggal</a>
                                    <a class="dropdown-item station">Station</a>
                                </div>
                            </div>
                </div>
            <form method="get" action="{{url()->current()}}" >
                <div class="col-md-9" id="search_input">
                        <input type="date" class="form-control" name="date" id="date" value="{{$date}}" {{$station ? 'hidden' :''}}>
                        <input type="text" class="form-control" name="station" id="station" placeholder="Masukan Station" value="{{$station}}" {{$station ? '' :'hidden'}}>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-secondary btn-lg" id="search"><i class="icon-search" style="font-size:15px; color:white;"></i></button>
                </div>
            </form>
            </div>
        <div class="row">
    <div class="col-md-2">
        <div class="card" style="height: 110px;">
            <div class="card-body">
                <div class="card-block">
                    <P style="font-size:11px;" class="card-title">Karyawan Mekanik</P>
                    <h4 class="card-text">{{$job_activities ? $job_activities->user_profile->name : $user->name}}</h4>
                    <h6 class="card-text">NIK: {{$job_activities ? $job_activities->user_profile->employee_number : $user->employee_number}}</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card" style="height: 110px;">
            <div class="card-body">
                <div class="card-block">
                    <P style="font-size:11px;" class="card-title">Kategori</P>
                    <h4 class="card-text" style="text-align:center; text-transform:uppercase; margin-top:20%;">{{$job_activities ? $job_activities->job_category->name : ''}}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
            <div class="card" style="height: 110px;">
                    <div class="card-body">
                        <div class="card-block">
                            <P style="font-size:11px;" class="card-title">Job Mekanik</P>
                            <a style="font-size:9px; font-weight:bold;" class="card-text">{{$job_activities ? $job_activities->job : ''}}</a>
                        </div>
                    </div>
                </div>
    </div>
    <div class="col-md-2">
            <div class="card" style="height: 110px;">
                    <div class="card-body">
                        <div class="card-block">
                            <P style="font-size:11px;" class="card-title">Station</P>
                            <h6 class="card-text" style="text-align:center; margin-top:20%;">{{$job_activities ? $job_activities->station->name : ''}}</h6>
                        </div>
                    </div>
                </div>
    </div>
    <div class="col-md-2">
            <div class="card" style="height: 110px;">
                    <div class="card-body">
                        <div class="card-block">
                            <P style="font-size:11px;" class="card-title">Material</P>
                            <a style="font-size:9px; font-weight:bold;" class="card-text">{{$job_activities ? $job_activities->material : ''}}</a>
                        </div>
                    </div>
                </div>
    </div>
    <div class="col-md-2">
            <div class="card" style="height: 110px;">
                    <div class="card-body">
                        <div class="card-block">
                            <P style="font-size:11px;" class="card-title">Tanggal</P>
                        <h6 class="card-text" style="text-align:center; margin-top:20%;">{{$job_activities ? $job_activities->date : $date}}</h6>
                        </div>
                    </div>
                </div>
    </div>
        </div>
        <div class="row ">
            <div class="col-md-4">
                    <div class="card" style="height: 110px;">
                            <div class="card-body">
                                <div class="card-block">
                                    <P style="font-size:11px; font-weight:bold;" class="card-title">Start</P>
                                <h2 class="card-text" style="text-align:center; font-weight:bold;">{{$start}}</h2>
                                </div>
                            </div>
                        </div>
            </div>
            <div class="col-md-4">
                    <div class="card" style="height: 110px;">
                            <div class="card-body">
                                <div class="card-block">
                                    <P style="font-size:11px; font-weight:bold;" class="card-title">Stop</P>
                                <h2 class="card-text" style="text-align:center; font-weight:bold;">{{$stop}}</h2>
                                </div>
                            </div>
                        </div>
            </div>
            <div class="col-md-4">
                    <div class="card" style="height: 110px;">
                            <div class="card-body">
                                <div class="card-block">
                                    <P style="font-size:11px; font-weight:bold;" class="card-title">Waktu Durasi</P>
                                <h2 class="card-text" style="text-align:center; font-weight:bold;">{{$job_activities ? $interval : ''}}</h2>
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
                <table class="table mb-0 table-borderless table-hover table-striped">
                    <thead style="border-bottom:3px grey solid;"> 
                        <tr>
                            <th style="text-align:center;">Tanggal</th>
                            <th style="text-align:center;">Start</th>
                            <th style="text-align:center;">Pause</th>
                            <th style="text-align:center;">Stop</th>
                            <th style="text-align:center;">Deskripsi Pause</th>
                            <th style="text-align:center;">Option</th>
                        </tr>
                    </thead>
                    <tbody> 
                        @If($job_activities)
                        @foreach ($job_activities->times as $data)
                        <tr>            
                        <td style="text-align:center;">{{$job_activities->date}}</td>
                        <td style="text-align:center;">{{$data->start_at}}</td>
                        <td style="text-align:center;">{{$data->pause_at}}</td>
                        <td style="text-align:center;">{{$data->stop_at}}</td>
                        <td style="text-align:center;">{{$data->description}}</td>
                        <td><a href="/daily_activity/detail/{{$job_activities->id}}/edit/{{$data->id}}"><i class="icon-edit2" style="color:#696B6C;"> Edit</i></a><a onclick="delete_data({{$data->id}},{{$job_activities->id}});"><i class="icon-trash-o" style="margin-left:10px; color:#696B6C;"> Hapus</i></a>
                        </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@stop
@section('css')
<style>
#option{
    font-size:13px; 
    border:none;
    border-radius: 5px;
    width: 150%
}

#date{
    font-size:13px; 
    border:none;
    border-radius: 5px;
    height:36.4px;
    width: 102%;
}

#station{
    font-size:13px; 
    border:none;
    border-radius: 5px;
    height:36.4px;
    width: 102%;
}

#search{
    font-size:13px; 
    border:none;
    border-radius: 20px;
    height:36.4px;
    background: #1D2B36;

}
#iframe{
    width: 100%; 
    display: block; 
    border: 0px; 
    height: 300px; 
    margin: 0px; 
    position: absolute; 
    left: 0px; right: 0px; top: 0px; bottom: 0px;
}
#myChart{
    display: line; 
    width: 471px; 
    height: 300px;
}
</style>    
@endsection

@section('js')

<script src="{{ url('js/daily_activity/detail.js') }}"></script>
<script>
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
