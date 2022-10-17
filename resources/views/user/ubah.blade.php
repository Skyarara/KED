@extends('layout.app')

@section ('title', 'Edit User')     

@section ('content-header')  
<div class="content-header row" style="margin-bottom:7.5px">
  <div class="content-header-left">
    <h4 class="content-header-title" style="margin-left: 10px;"><b>Edit User</b></h4>
  </div>
</div>


@stop

@section ('content-body')
<form method="post" action="{{ url('/user/ubah', $old_users->id) }}" role="form" enctype="multipart/form-data">
{{csrf_field()}}
<div class="card row" style="margin-bottom: 10px">
    <div class="card-header" style="border: none;"></div>  
    <div class="card-body">
    <div class="form-group col-md-11" style="width:97.5%; margin-left: 10px;">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control" id="username" value="{{ $old_users->username }}" style="border-radius: 5px;" required>
    </div>
    <div class="form-group col-md-11" style="width:97.5%; margin-left: 10px;">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" value="" style="border-radius: 5px;" required>
        </div>
    <div class="form-group col-md-11" style="width:97.5%; margin-left: 10px;">
        <label for="nama">Nama</label>
        <input type="text" name="nama" class="form-control" id="nama" value="{{ $old_users->users_profiles->name }}" style="border-radius: 5px;" required>
    </div>
    <div class="form-group col-md-11" style="width:97.5%; margin-left: 10px;">
        <label for="npk">NPK</label>
        <input type="text" name="npk" class="form-control" id="npk" value="{{ $old_users->users_profiles->employee_number }}" style="border-radius: 5px;" required>
    </div>
    <div class="form-group col-md-11" style="width:97.5%; margin-left: 10px;">
        <label for="nohp">No. HP</label>
        <input type="text" name="nohp" class="form-control" id="nohp" value="{{ $old_users->users_profiles->phone }}" style="border-radius: 5px;" required>
    </div>
    <div class="form-group col-md-11" style="width:97.5%; margin-left: 10px;">
        <label for="alamat">Alamat</label>
        <textarea rows="8" name="alamat" class="form-control" id="alamat" style="border-radius: 5px;" required>{{ $old_users->users_profiles->address }}</textarea>
    </div>
    <label class="col-md-11" style="margin-left: 10px;">Pegawai Mekanik</label>
    <div class="form-group col-md-11" style="width:97.5%; margin-left: 10px;">
        <label><input type="checkbox" value="1" {{ $old_users->users_profiles->is_mechanic ? 'checked' : null }} id="mekanik" name="mekanik" style="filter: invert(100%); transform: scale(1.25);"> Ya</label>
    </div>
    <label class="col-md-11" style="margin-left: 10px;">Status</label>
    <div class="form-group col-md-11" style="width:97.5%; margin-left: 10px;">
        <label><input type="checkbox" value="1" {{ $old_users->is_active ? 'checked' : null }} id="aktif" name="aktif" style="filter: invert(100%); transform: scale(1.25);"> Aktif</label>
    </div>
    <div class="form-group col-md-11" style="width:97.5%; margin-left: 10px;">
        <label for="role">Role</label>  
        <select class="form-control" name="role" id="role" style="width: 100%; border-radius: 5px;">
            @foreach($role as $dt)
            <option value="{{ $dt->id}}"  {{ $old_users->id == $dt->id ? 'selected':'' }}>{{ $dt->name }}</option>
            @endforeach                
        </select>
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

<script src="{{ url('js/user/index.js') }}"></script>

@stop