<!--header-->
<header class="top-header">
    <nav class="navbar navbar-expand">
        <div class="left-topbar d-flex align-items-center">
            <a href="javascript:;" class="toggle-btn"> <i class="bx bx-menu"></i>
            </a>
        </div>
        <div class="flex-grow-1 search-bar">
        </div>
        <div class="right-topbar ml-auto">
            <ul class="navbar-nav">
                {{-- <li class="nav-item dropdown dropdown-lg">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="javascript:;"
                        data-toggle="dropdown"> <i class="bx bx-bell vertical-align-middle"></i>
                        <span class="msg-count">8</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:;">
                            <div class="msg-header">
                                <h6 class="msg-header-title">1 New</h6>
                                <p class="msg-header-subtitle">Notifications</p>
                            </div>
                        </a>
                        <div class="header-notifications-list">
                            <a class="dropdown-item" href="javascript:;">
                                <div class="media align-items-center">
                                    <div class="notify bg-light-primary text-primary"><i class="bx bx-group"></i>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="msg-name">New Customers<span class="msg-time float-right">14 Sec
                                                ago</span></h6>
                                        <p class="msg-info">5 new user registered</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <a href="javascript:;">
                            <div class="text-center msg-footer">View All Notifications</div>
                        </a>
                    </div>
                </li> --}}
                <li class="nav-item dropdown dropdown-user-profile">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                        data-toggle="dropdown">
                        <div class="media user-box align-items-center">
                            <div class="media-body user-info">
                                <p class="user-name mb-0">
                                    {{ strtoupper(Auth::user()->firstname." ".Auth::user()->lastname) }}</p>
                                <p class="designattion mb-0">{{ Auth::user()->status }}</p>

                            </div>
                            <span class="avatar avatar-96 img-thumbnail text-white text-uppercase text-center"
                                style="background: {{"#".substr(rand(),0,6)}};">
                                {{ substr(Auth::user()->firstname,0,1).substr(Auth::user()->lastname,0,1) }}
                            </span>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('profile') }}"><i
                                class="bx bx-user"></i><span>Profile</span></a>
                        <a class="dropdown-item" href="{{ route('edit.profile') }}"><i
                                class="bx bx-cog"></i><span>Settings</span></a>
                        <div class="dropdown-divider mb-0"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"><i
                                class="bx bx-power-off"></i><span>Logout</span></a>
                    </div>
                </li>
                <li class="nav-item dropdown dropdown-language">
                    @if(Auth::user()->status=="pending")
                    <a href="{{ route('activate') }}"
                        class="btn btn-sm btn-primary text-white font-weight-bold p-1"><small>VERIFY</small></a>
                    @else
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                        data-toggle="dropdown">
                        <div class="lang d-flex">
                            <div><i class="flag-icon flag-icon-ng"></i>
                            </div>
                            <div><span>NG</span>
                            </div>
                        </div>
                    </a>
                    @endif
        </div>
        </li>
        </ul>
        </div>
    </nav>
</header>
<!--end header-->
