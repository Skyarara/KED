@extends ('layout.app')

@section ('title', $title)

@section ('css')
@endsection

@section ('content-header')
    <div class="content-header row" style="margin-bottom:15px">
        <div class="content-header-left col-md-10">
            <h4 class="content-header-title"><b>{{ $title }}</b></h4>
        </div>
        <div class="content-header-right">
            <a href="{{ route('admin.role.create') }}">
                <button type="button" id="#" class="btn btn-secondary" style="width:15%; border-radius:25px; filter: invert(100%);"><i class="icon-plus2" style="margin-right:5px"></i><b>Tambah</b></button>
            </a>
        </div>
    </div>

    <div class="box-header row" style="margin-bottom:10px">
        <form action="{{ url()->current() }}">
            <input type="hidden" name="filter" value="{{ request()->get('filter', 'Role') }}" id="filter_by">
            <div class="box-header-left col-md-2">
                <button type="button" class="btn btn-secondary dropdown-toggle" id="option" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 100%; border-radius:7.5px">
                    @if (request()->get('filter') !== null)
                        {{ request()->get('filter') }}
                    @else
                        Role
                    @endif
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item item-filter" data-filter="role">Role</a>
                    <a class="dropdown-item item-filter" data-filter="status">Status</a>
                    <a class="dropdown-item item-filter" data-filter="permission">Permission</a>
                </div>
            </div>
            <div class="box-header-center col-md-9">
                <div class="filter-form filter-role {{ request()->get('filter') == 'Role' || request()->get('filter') == null ? '' : 'hidden' }}">
                    <input type="text" name="role" placeholder="Cari" class="menu-search form-control" style="width: 100%; border-radius:7.5px" value="{{ request()->get('role') }}">
                </div>

                <div class="filter-form filter-status {{ request()->get('filter') == 'Status' ? '' : 'hidden' }}">
                    <select name="status" id="" class="form-control">
                        <option value="1" {{ request()->get('status') == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ request()->get('status') == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

                <div class="filter-form filter-permission {{ request()->get('filter') == 'Permission' ? '' : 'hidden' }}">
                    <input type="text" name="permission" placeholder="Cari" class="menu-search form-control" style="width: 100%; border-radius:7.5px" value="{{ request()->get('permission') }}">
                </div>
            </div>
            <div class="box-header-right col-md-1">
                <button type="submit" id="search" class="btn btn-flat" style="width:85%; border-radius:25px; margin-left: -10px; filter: invert(100%);">
                    <i class="icon-search7"></i>
                </button>
            </div>
        </form>
    </div>
@endsection

@section('content-body')
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-borderless table-striped table-hover">
                        <thead style="border-bottom:3.3px grey solid;">
                            <tr>
                                <th style="vertical-align:middle; text-align:center;">Role</th>
                                <th style="vertical-align:middle; text-align:center;">Jumlah User</th>
                                <th style="vertical-align:middle; text-align:center;">Status</th>
                                <th style="vertical-align:middle; text-align:center;">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td style="vertical-align:middle; text-align:center;">{{ $item->name }}</td>
                                    <td style="vertical-align:middle; text-align:center;">{{ $item->users_count }}</td>
                                    <td style="vertical-align:middle; text-align:center;">{!! $item->is_active_formatted !!}</td>
                                    <td style="vertical-align:middle; text-align:center;">
                                        <a href="{{ route('admin.role.show', $item->id) }}" class="btn" style="border: none; background: none; color: #000"><i class="icon-eye4"></i> Detail</a>
                                        <a href="{{ route('admin.role.edit', $item->id) }}" class="btn" style="border: none; background: none; color: #000"><i class="icon-edit2"></i> Edit</a>
                                        <form action="{{ route('admin.role.destroy', $item->id) }}" class="form-inline-block form-destroy" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn" style="border: none; background: none; color: #000"><i class="icon-trash4"></i> Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $items->appends(request()->all())->links() }}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('body').on('click', '.item-filter', function (e) {
            var el = $(this);

            $('#option').html(
                el.html()
            );

            $('#filter_by').val(
                el.html()
            );

            var filter = el.data('filter');

            $('.menu-search').val('');
            $('.filter-form').addClass('hidden');
            $('.filter-' + filter).removeClass('hidden');
        });
        
    </script>
@endsection
