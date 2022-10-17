<nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header" style="border-bottom:3px white solid;">
            <ul class="nav navbar-nav">
                <li class="nav-item mobile-menu hidden-md-up float-xs-left">
                    <a class="nav-link nav-menu-main menu-toggle hidden-xs">
                        <i class="icon-menu5 font-large-1"></i>
                    </a>
                </li>
                <li class="nav-item" style="margin-left:35%; margin-top:5%;">
                    <h3 style="color:white;"><b>KED</b></h3>
                        {{-- <img alt="" src="" data-expand="" data-collapse="" class="brand-logo"> --}}
                </li>
                <li class="nav-item hidden-md-up float-xs-right">
                    <a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container">
                        <i class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content container-fluid">
            <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
                <ul class="nav navbar-nav">
                    <li class="nav-item hidden-sm-down"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5"></i></a></li>   
                </ul>
            <h4 style='position:relative; top:10px;'><a href="{{route('logout')}}" style="float:right; color:white;"><i class="icon-power3"></i> Logout</a></h4>
            </div>
        </div>  
    </div>
</nav>
