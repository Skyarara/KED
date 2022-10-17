@extends ('layout.app')

@section ('title', $title)

@section ('content-header')
    <div class="content-header row" style="margin-bottom:7.5px">
        <div class="content-header-left">
            <h4 class="content-header-title" style="margin-left: 10px;"><b>Detail Role</b></h4>
        </div>
    </div>
@endsection

@section('content-body')
<div class="row">
    <div class="col-xs-12">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Detail Role</h4>
            </div>
            <div class="card-body collapse in">
                <div class="card-block card-dashboard">

                    <div class="form-group">
                        <label style="width: 100px">Nama Role</label>
                        : {{ $item->name }}
                    </div>

                    <div class="form-group">
                        <label style="width: 100px">Status</label>
                        : {!! $item->is_active ? 'Aktif' : 'Tidak Aktif' !!}
                    </div>

                    <div class="form-group">
                        <label class="form-group">Permission</label>
                        <div>
                            @foreach ($item->permissions as $permission)
                                <div class="form-group">
                                    <label class=""><i class="icon-circle-check"></i> {{ $permission->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Basic Tables end -->
@endsection

@section ('js')
@endsection
