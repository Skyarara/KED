@extends('layout.app')

@section ('title', 'Tambah User')     

@section ('content-header')  
<div class="content-header row" style="margin-bottom:7.5px">
  <div class="content-header-left">
    <h4 class="content-header-title" style="margin-left: 10px;"><b>Tambah User</b></h4>
  </div>
</div>


@stop

@section ('content-body')
<form method="post" action="{{ url('/user/tambah')}}" role="form" enctype="multipart/form-data">
{{csrf_field()}}
<div class="card row" style="margin-bottom: 10px">
    <div class="card-header" style="border: none;"></div>  
    <div class="card-body">
    <div class="form-group col-md-11" style="width:97.5%; margin-left: 10px;">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control" id="username" placeholder="" style="border-radius: 5px;" required>
    </div>
    <div class="form-group col-md-11" style="width:97.5%; margin-left: 10px;">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="" style="border-radius: 5px;" required>
    </div>
     <div class="form-group col-md-11" style="width:97.5%; margin-left: 10px;">
        <label for="nama">Nama</label>
        <input type="text" name="nama" class="form-control" id="nama" placeholder="" style="border-radius: 5px;" required>
    </div>
     <div class="form-group col-md-11" style="width:97.5%; margin-left: 10px;">
        <label for="npk">NPK</label>
        <input type="text" name="npk" class="form-control" id="npk" placeholder="" style="border-radius: 5px;" required>
    </div>
    <div class="form-group col-md-11" style="width:97.5%; margin-left: 10px;">
        <label for="nohp">No. HP</label>
        <input type="text" name="nohp" class="form-control" id="nohp" placeholder="" style="border-radius: 5px;" required>
    </div>
    <div class="form-group col-md-11" style="width:97.5%; margin-left: 10px;">
        <label for="alamat">Alamat</label>
        <textarea id="alamat" rows="8" name="alamat" class="form-control square" placeholder="" style="border-radius: 5px;" required></textarea>
    </div>
    <label class="col-md-11" style="margin-left: 10px;">Pegawai Mekanik</label>
    <div class="form-group col-md-11" style="width:97.5%; margin-left: 10px;">
        <label><input type="checkbox" value="1" id="mekanik" name="mekanik" style="filter: invert(100%); transform: scale(1.25);"> Ya</label>
    </div>
    <label class="col-md-11" style="margin-left: 10px;">Status</label>
    <div class="form-group col-md-11" style="width:97.5%; margin-left: 10px;">
        <label><input type="checkbox" value="1" id="aktif" name="aktif" style="filter: invert(100%); transform: scale(1.25);"> Aktif</label>
    </div>
    <div class="form-group col-md-11" style="width:97.5%; margin-left: 10px;">
        <label for="role">Role</label>  
        <select class="form-control" data-placeholder="-- Pilih Role --" name="role" id="role" style="width: 100%; border-radius: 5px;">
            <option value="00">-- Pilih Role --</option>
            @foreach($role as $dt)
            <option value="{{ $dt->id }}">{{ $dt->name }}</option>     
            @endforeach             
        </select>
        <div id="textDiv" style="font-family:Calibri; font-size:small; font-weight:bold"> </div>
    </div>
    </div>
    <div class="card-footer" style="border: none;">
        <a href="{{ route('user') }}">
            <input type="button" value="Batal" class="btn btn-secondary btn-md" style="border-radius: 25px; width: 15%; margin-left: 700px">
        </a>
        <input type="submit" value="Simpan" class="btn btn-secondary btn-md" style="filter: invert(100%); border-radius: 25px; width: 15%; margin-left: 17.5px;">
    </div>
</div>

@stop

@section('js')

<script src="{{ url('js/user/tambah.js') }}"></script>

@stop