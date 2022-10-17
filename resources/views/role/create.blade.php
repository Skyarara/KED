@extends ('layout.app')

@section ('title', $title)

@section ('content-header')
    <div class="content-header row" style="margin-bottom:7.5px">
        <div class="content-header-left">
            <h4 class="content-header-title" style="margin-left: 10px;"><b>Tambah Role</b></h4>
        </div>
    </div>
@endsection

@section('content-body')
<div class="row">
    <div class="col-xs-12">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Role</h4>
            </div>
            <div class="card-body collapse in">
                <div class="card-block card-dashboard">

                    @include ('layout.flash')

                    <form class="form" action="{{ route('admin.role.store') }}" method="POST">
                        @csrf
                        <div class="form-body">
                            <div class="form-group">
                                <label>Nama Role</label>
                                <input type="text" id="" class="form-control" name="name" value="{{ old('name') }}">
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <div>
                                    <label class="control-icheck">
                                        <input type="checkbox" name="is_active" value="1" class="icheck"> 
                                        <span>Aktif</span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Permission</label>
                                <div>
                                    @foreach ($permissions as $permission)
                                        <div>
                                            <label class="control-icheck">
                                                <input type="checkbox" name="permission[]" value="{{ $permission->name }}" class="icheck"> 
                                                <span>{{ $permission->name }}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="text-xs-right">
                                <a href="{{ route('admin.role.index') }}" class="btn btn-secondary btn-md" style="border-radius: 25px; padding-left: 80px; padding-right: 80px;">Batal</a>
                                <input type="submit" value="Simpan" class="btn btn-secondary btn-md btn-dark" style="border-radius: 25px; padding-left: 80px; padding-right: 80px; color: #FFF">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Basic Tables end -->
@endsection

@section ('js')
    <script>
        $('.icheck').iCheck({
            checkboxClass: 'icheckbox_square',
            radioClass: 'iradio_square',
            increaseArea: '20%' // optional
        });
    </script>
@endsection
