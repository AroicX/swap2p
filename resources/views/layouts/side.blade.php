<!--sidebar-wrapper-->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div class="">
            <img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon-2" alt="" />
        </div>
        <div>
            <h4 class="logo-text">Swap2p</h4>
        </div>
        <a href="javascript:;" class="toggle-btn ml-auto"> <i class="bx bx-menu"></i>
        </a>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('home') }}">
                <div class="parent-icon icon-color-1"><i class="bx bx-home-alt"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="{{ route('merging') }}">
                <div class="parent-icon icon-color-6"><i class="bx bx-shuffle"></i>
                </div>
                <div class="menu-title">Mergings</div>
            </a>
        </li>


        <li>
            <a class="has-arrow" href="javascript:void(0);">
                <div class="parent-icon icon-color-10"><i class="bx bx-link"></i>
                </div>
                <div class="menu-title">My Referrals</div>
            </a>
            <ul>
                <li> <a href="{{ route('genealogy') }}"><i class="bx bx-right-arrow-alt"></i>Genealogy</a>
                </li>
                <li> <a href="{{ route('downlines') }}"><i class="bx bx-right-arrow-alt"></i>Downlines</a>
                </li>
                <li> <a href="{{ route('growth') }}"><i class="bx bx-right-arrow-alt"></i>Growth </a>
                </li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:void(0);">
                <div class="parent-icon icon-color-2"><i class="bx bx-copy"></i>
                </div>
                <div class="menu-title">My Payments</div>
            </a>
            <ul>
                <li> <a href="{{ route('upgrade') }}"><i class="bx bx-right-arrow-alt"></i>Upgrade</a>
                </li>
                <li> <a href="{{ route('payment.history') }}"><i class="bx bx-right-arrow-alt"></i>Payment History</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:void(0);">
                <div class="parent-icon icon-color-5"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">My Profile</div>
            </a>
            <ul>
                <li> <a href="{{ route('profile') }}"><i class="bx bx-right-arrow-alt"></i> Profile</a>
                <li> <a href="{{ route('edit.profile') }}"><i class="bx bx-right-arrow-alt"></i>Edit Profile</a>
                </li>
                <li> <a href="{{ route('bank') }}"><i class="bx bx-right-arrow-alt"></i>Bank Details</a>
                </li>
            </ul>
        </li>
        @if (Auth::user()->email === 'admin@yopmail.com')
        <li>
            <a class="has-arrow" href="javascript:void(0);">
                <div class="parent-icon icon-color-9"><i class="bx bx-archive"></i>
                </div>
                <div class="menu-title">Administrator</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.activites') }}"><i class="bx bx-right-arrow-alt"></i> Activity Log</a>
                <li> <a href="{{ route('admin.users') }}"><i class="bx bx-right-arrow-alt"></i> Manage Users</a>
                <li> <a href="{{ route('admin.merging') }}"><i class="bx bx-right-arrow-alt"></i>Manage Mergings</a>
                <li> <a href="{{ route('admin.toReceive',  2) }}"><i class="bx bx-right-arrow-alt"></i>To Receive</a>
                    {{-- <li> <a href="{{ route('edit.profile') }}"><i class="bx bx-right-arrow-alt"></i>Manage
                    Payments</a> --}}

                </li>

        </li>
    </ul>
    </li>
    @endif
    <li>
        <a href="{{ route('logout') }}">
            <div class="parent-icon icon-color-4"><i class="bx bx-power-off"></i>
            </div>
            <div class="menu-title">Logout</div>
        </a>
    </li>
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar-wrapper-->
