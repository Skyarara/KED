<ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
    <li class="nav-item" style="margin-top:12.5%; margin-bottom:2.5%;">
        <a href="/user">
            <i class="icon-users3">
            </i>
            <span class="menu-title">User</span>
        </a>
    </li>
    <li class="nav-item" style="margin-bottom:3.5%;">
        <a href="/job_category">
            <i class="icon-briefcase4">
            </i>
            <span class="menu-title">Kategori Pekerjaan</span>
        </a>
    </li>
    <li class="nav-item" style="margin-bottom:3.5%;">
        <a href="/station">
            <i class="icon-compass3">
            </i>
            <span class="menu-title">Station</span>
        </a>
    </li>
    <li class="nav-item" style="margin-bottom:3.5%;">
        <a href="/daily_activity">
            <i class="icon-pie-graph2">
            </i>
            <span class="menu-title">Daily Activity</span>
        </a>
    </li>
    @foreach ($menus as $role => $menu)
        @if ($menu->isNotEmpty())
            <li class="navigation-header">
                <span>{{ $role }}</span>
                <i class="icon-ellipsis icon-ellipsis"></i>
            </li>
            @if ($loop->first)
                <li class="nav-item">
                    <a href="#">
                        <i class="fa fa-home"></i>
                        <span class="menu-title">Home</span>
                    </a>
                </li>
            @endif
            @foreach ($menu as $singleMenu)
                {!! $singleMenu !!}
            @endforeach
        @endif
    @endforeach
</ul>