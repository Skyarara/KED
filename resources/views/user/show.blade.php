@extends ('layout.app')

@section ('title', $title)

@section ('content-header')
    <div class="content-header row" style="margin-bottom:7.5px">
        <div class="content-header-left">
            <h4 class="content-header-title" style="margin-left: 10px;"><b>Detail User</b></h4>
        </div>
    </div>
@endsection

@section('content-body')
<div class="row">
    <div class="col-xs-12">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Profile</h4>
            </div>
            <div class="card-body collapse in">
                <div class="card-block card-dashboard">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">Nama</div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                {{ $item->users_profiles->name }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">NPK</div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                {{ $item->users_profiles->employee_number }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">No. HP</div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                {{ $item->users_profiles->phone }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">Alamat</div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                {{ $item->users_profiles->address }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">Username</div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                {{ $item->username }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">Terakhir Login</div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                {{ $item->last_login_formatted }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Role</h4>
            </div>
            <div class="card-body collapse in">
                <div class="card-block card-dashboard">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">Role</div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-8">
                                {{ $item->roles->first()->name ?? '-' }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div>Permission</div>
                        <div>
                            <ul>
                                @foreach ($item->permissions as $permission)
                                    <li>{{ $permission->name }}</li>
                                @endforeach
                            </ul>
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
