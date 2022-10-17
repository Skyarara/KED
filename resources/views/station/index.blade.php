@extends('layout.app')

@section ('title', 'Station')     

@section ('content-header')  
<div class="content-header row" style="margin-bottom:15px">
  <div class="content-header-left col-md-10">
    <h4 class="content-header-title"><b>Station</b></h4>
  </div>
  <div class="content-header-right">
    <a href="/station/tambah_page">
      <button type="button" id="#" class="btn btn-secondary" style="width:15%; border-radius:25px; filter: invert(100%);"><i class="icon-plus2" style="margin-right:5px"></i><b>Tambah</b></button>
    </a>
  </div>
</div>

<div class="box-header row" style="margin-bottom:10px">
  <div class="box-header-left col-md-2">
    <button type="button" class="btn btn-secondary dropdown-toggle" id="option" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 100%; border-radius:7.5px">Nama  </button>
    <div class="dropdown-menu">
        <a class="dropdown-item">Nama</a>
    </div>
  </div>
  <form method="get" action="{{url()->current()}}">
    <div class="box-header-center col-md-9">
      <input type="text" id="search" name="search" placeholder="Cari" class="menu-search form-control" style="width: 100%; border-radius:7.5px">
    </div>
    <div class="box-header-right col-md-1">
      <button type="submit" id="search" class="btn btn-flat" style="width:85%; border-radius:25px; margin-left: -10px; filter: invert(100%);"><i class="icon-search7"></i>
      </button>
    </div>
  </form>
</div>
@stop

@section ('content-body')
{{ csrf_field() }}
<input type="text" id="_token" value="{{ csrf_token() }}" hidden>
  <div class="card">
      <table class="table table-borderless table-striped table-hover">
        <thead style="border-bottom:3px grey solid;">
          <tr>
            <th style="vertical-align:middle; text-align:center;">Nama Station</th>
            <th style="vertical-align:middle; text-align:center;">Option</th>
          </tr>
          </thead>
          <tbody>
          <tr>
          @foreach($station as $dt)
          <td style="vertical-align:middle; text-align:center;">{{ $dt->name }}</td>
          <td style="vertical-align:middle; text-align:center;">
              <a href="/station/ubah_page/{{ $dt->id }}"><button type="button" class="btn" onclick="" style="border: none; background: none;"><i class="icon-edit2"></i> Edit</button></a>
              <button type="button" class="btn" onclick="delete_data({{ $dt->id }})" style="border: none; background: none;"><i class="icon-trash4"></i> Hapus</button>
          </td>
          </tr>
          @endforeach
        </tbody>
      </table>
</div>
<footer style="text-align:center;">{{ $station->links() }}</footer>

@stop

@section('js')

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ url('js/station/index.js') }}"></script>

@stop