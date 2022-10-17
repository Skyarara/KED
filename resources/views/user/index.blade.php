@extends('layout.app')

@section ('title', 'Manajemen User')     

@section ('content-header')  
<div class="content-header row" style="margin-bottom:15px">
  <div class="content-header-left col-md-10">
    <h4 class="content-header-title"><b>Manajemen User | User</b></h4>
  </div>
  <div class="content-header-right">
    <a href="/user/tambah_page">
      <button type="button" id="#" class="btn btn-secondary" style="width:15%; border-radius:25px; filter: invert(100%);"><i class="icon-plus2" style="margin-right:5px"></i><b>Tambah</b></button>
    </a>
  </div>
</div>

<div class="box-header row" style="margin-bottom:10px">
  {{-- <form method="get" action="{{url()->current()}}"> --}}
    <div class="box-header-left col-md-2">
      <button type="button" class="btn btn-secondary dropdown-toggle" id="option" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 100%; border-radius:7.5px">@if($fil != ""){{ $fil }}@else Nama @endif</button>
    <div class="dropdown-menu">
        <a class="dropdown-item" onclick="setFilter('Nama')">Nama</a>
        <a class="dropdown-item" onclick="setFilter('NPK')">NPK</a>
        <a class="dropdown-item" onclick="setFilter('Username')">Username</a>
        <a class="dropdown-item" onclick="setFilter('Role')">Role</a>
    </div>
  </div>
    <div class="box-header-center col-md-9">
      <input type="text" id="search" name="search" placeholder="Cari" class="menu-search form-control" style="width: 100%; border-radius:7.5px">
    </div>
    <div class="box-header-right col-md-1">
      <button id="btn-search" class="btn btn-flat" style="width:85%; border-radius:25px; margin-left: -10px; filter: invert(100%);"><i class="icon-search7"></i>
      </button>
    </div>
  {{-- </form> --}}
</div>
@stop

@section ('content-body')
{{ csrf_field() }}
<input type="text" id="_token" value="{{ csrf_token() }}" hidden>
  <div class="card row">
      <table class="table table-borderless table-striped table-responsive table-hover">
        <thead style="border-bottom:3.3px grey solid;">
          <tr>
            <th rowspan="2" style="vertical-align:middle; text-align:center;">Nama</th>
            <th rowspan="2" style="vertical-align:middle; text-align:center;">NPK</th>
            <th rowspan="2" style="vertical-align:middle; text-align:center;">No. HP</th>
            <th rowspan="2" style="vertical-align:middle; text-align:center;">Alamat</th>
            <th rowspan="2" style="vertical-align:middle; text-align:center;">Username</th>
            <th rowspan="2" style="vertical-align:middle; text-align:center;">Role</th>
            <th rowspan="2" style="vertical-align:middle; text-align:center;">Terakhir Login</th>
            <th rowspan="2" style="vertical-align:middle; text-align:center;">Option</th>
          </tr>
          </thead>
          <tbody>
          <tr>
          @foreach($result as $dt)
          <td style="vertical-align:middle; text-align:center;">{{ $dt['nama'] }}</td>
          <td style="vertical-align:middle; text-align:center;">{{ $dt['npk'] }}</td>
          <td style="vertical-align:middle; text-align:center;">{{ $dt['nohp'] }}</td>
          <td style="vertical-align:middle; text-align:center;">{{ $dt['alamat'] }}</td>
          <td style="vertical-align:middle; text-align:center;">{{ $dt['username'] }}</td>
          <td style="vertical-align:middle; text-align:center;">{{ $dt['role'] }}</td>
          <td style="vertical-align:middle; text-align:center;">{{ $dt['last_login'] }} WITA</td>
          <td>
              <a href="{{ route('user.show', $dt['id']) }}" class="btn" style="border: none; background: none; color: #000"><i class="icon-eye4"></i> Detail</a>
              <a href="{{ route('user.ubah', $dt['id']) }}"><button type="button" class="btn" style="border: none; background: none;"><i class="icon-edit2"></i> Edit</button></a>
              <button type="button" class="btn" onclick="delete_data({{ $dt['id'] }})" style="border: none; background: none;"><i class="icon-trash-o"></i> Hapus</button>
          </td>
          </tr>
          @endforeach
        </tbody>
      </table>
</div>
<footer style="text-align:center;">{{ $users->links() }}</footer>
@stop

@section('js')

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ url('js/user/index.js') }}"></script>

@stop