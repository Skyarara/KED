@extends('layout.app') 

@section ('title', 'Edit Job Activities')     

@section ('content-header')  
<h3><b>Edit Waktu Daily Activity</b></h3><br>
@stop
@section ('content-body')  
    <div class="card">
            <div class="card-block">
                <form class="form" method="POST" action="{{ url('/daily_activity/detail/'.$id.'/'.'update/'.$Id) }}">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-body">
                                <div class="form-group">
                                    <label for="eventInput1">Tanggal</label>
                                    <input type="text" class="form-control" name="tanggal" value="{{$time->job_activity->date}}" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="eventInput2">Waktu</label>
                                    @switch($time)
                                        @case($time->start_at != '00:00:00')
                                        <input type="time" class="form-control" name="waktu" step="1" value="{{$time->start_at}}">                                            
                                            @break
                                        @case($time->pause_at != '00:00:00')
                                        <input type="time" class="form-control" name="waktu" step="1" value="{{$time->pause_at}}"> 
                                            @break
                                        @default
                                        <input type="time" class="form-control" name="waktu" step="1" value="{{$time->stop_at}}">  
                                    @endswitch
                                </div>

                                <div class="form-group">
                                        <label>Status</label>
                                        <div class="input-group">
                                            <label class="display-inline-block custom-control custom-radio ml-1">
                                                @if($time->start_at != '00:00:00')
                                                <input type="radio" name="check" checked value="1" class="custom-control-input">
                                                @else
                                                <input type="radio" name="check" value="1" class="custom-control-input">
                                                @endif
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description ml-0">Start</span>
                                            </label>
                                            <label class="display-inline-block custom-control custom-radio">
                                                @if($time->pause_at != '00:00:00')
                                                <input type="radio" name="check" checked value="2" class="custom-control-input">
                                                @else
                                                <input type="radio" name="check" value="2" class="custom-control-input">
                                                @endif
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description ml-0">Pause</span>
                                            </label>
                                            <label class="display-inline-block custom-control custom-radio">
                                                @if($time->stop_at != '00:00:00')
                                                    <input type="radio" name="check" checked value="3" class="custom-control-input">
                                                @else
                                                <input type="radio" name="check" value="3" class="custom-control-input">
                                                @endif
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description ml-0">Stop</span>
                                                </label>
                                        </div>
                                    </div>
                                <div class="form-group">
                                        <label for="issueinput8">Deskripsi</label>
                                        <textarea rows="5" class="form-control" name="deskripsi" placeholder="Deskripsi">{{$time->description}}</textarea>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions right">
                        <button type="button" class="btn btn-secondary" style="width:150px; border:2px grey solid; font-weight:bolder; border-radius:20px;">
                            <i class="icon-cross2"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-secondary" style="background-color:#808080; width:150px; border:2px grey solid; font-weight:bolder; border-radius:20px; color:white;">
                            <i class="icon-check2"></i> Simpan
                        </button>
                    </div>
                </form>	
            </div>
    </div>
@stop
