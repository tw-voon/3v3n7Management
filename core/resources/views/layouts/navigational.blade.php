<div class="pcoded-main-container">

    <div class="pcoded-wrapper">

        <nav class="pcoded-navbar" >

            <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>

            <div class="pcoded-inner-navbar main-menu">

                <div class="">

                    <div class="main-menu-header">

                        <img class="img-40" src="{{ asset('images/people.png') }}" alt="User-Profile-Image">

                        <div class="user-details">

                            <span>{{Auth::user()->name}}</span>

                            <span id="more-details">{{Auth::user()->roles_name->roles_name}}<i class="ti-angle-down"></i></span>

                        </div>

                    </div>



                    <div class="main-menu-content">

                        <ul>

                            <li class="more-details">

                                <a href="{{route('profile.info')}}"><i class="ti-user"></i>View Profile</a>

                                {{-- <a href="#!"><i class="ti-settings"></i>Settings</a> --}}

                                <a href="{{route('logout')}}"><i class="ti-layout-sidebar-left"></i>Logout</a>

                            </li>

                        </ul>

                    </div>

                </div>



                <div class="pcoded-navigatio-lavel">Event</div>

                <ul class="pcoded-item pcoded-left-item">

                    <li class="{{ Request::is('home') ? 'active' : '' }} pcoded-trigger">

                        <a href="{{route('home')}}">

                            <span class="pcoded-micon"><i class="icofont icofont-dashboard-web"></i></span>

                            <span class="pcoded-mtext">Dashboard</span>

                            <span class="pcoded-mcaret"></span>

                        </a>

                    </li>

                </ul>

                <ul class="pcoded-item pcoded-left-item">

                    <li class="{{ Request::is('events') || Request::is('events/*') ? 'active' : '' }} pcoded-trigger">

                        <a href="{{ route('event.index') }}">

                            <span class="pcoded-micon"><i class="icofont icofont-list"></i></span>

                            <span class="pcoded-mtext">Event List</span>

                            <span class="pcoded-mcaret"></span>

                        </a>

                    </li>

                </ul>



                <ul class="pcoded-item pcoded-left-item">

                    <li class="{{ Request::is('events_category') || Request::is('events_category/*') ? 'active' : '' }} pcoded-trigger">

                        <a href="{{ route('event_cat.index') }}">

                            <span class="pcoded-micon"><i class="icofont icofont-label"></i></span>

                            <span class="pcoded-mtext">Event Category</span>

                            <span class="pcoded-mcaret"></span>

                        </a>

                    </li>

                </ul>



                @if(Auth::user()->roles_id == 1)

                <div class="pcoded-navigatio-lavel">User</div>

                <ul class="pcoded-item pcoded-left-item">

                    <li class="{{ Request::is('agency') || Request::is('agency/*') ? 'active' : '' }} pcoded-trigger">

                        <a href="{{route('agency.index')}}">

                            <span class="pcoded-micon"><i class="icofont icofont-building-alt"></i></span>

                            <span class="pcoded-mtext">Agency</span>

                            <span class="pcoded-mcaret"></span>

                        </a>

                    </li>

                </ul>



                <ul class="pcoded-item pcoded-left-item">

                    <li class="{{ Request::is('app_user') || Request::is('app_user/*') ? 'active' : '' }} pcoded-trigger">

                        <a href="{{route('app_user.index')}}">

                            <span class="pcoded-micon"><i class="icofont icofont-users"></i></span>

                            <span class="pcoded-mtext">Apps User</span>

                            <span class="pcoded-mcaret"></span>

                        </a>

                    </li>

                </ul>

                @endif



                <div class="pcoded-navigatio-lavel">Report</div>

                <ul class="pcoded-item pcoded-left-item">

                    <li class="{{ Request::is('report/*') ? 'active' : '' }} pcoded-trigger ">

                        <a href="{{route('report.index')}}">

                            <span class="pcoded-micon"><i class="icofont icofont-files"></i></span>

                            <span class="pcoded-mtext">Event Report</span>

                            <span class="pcoded-mcaret"></span>

                        </a>

                    </li>

                </ul>



                <div class="pcoded-navigatio-lavel">System</div>

                <ul class="pcoded-item pcoded-left-item">

                    <li class="{{ Request::is('info/*') ? 'active' : '' }} pcoded-trigger ">

                        <a href="{{route('info.index')}}">

                            <span class="pcoded-micon"><i class="icofont icofont-files"></i></span>

                            <span class="pcoded-mtext">Info Page</span>

                            <span class="pcoded-mcaret"></span>

                        </a>

                    </li>

                </ul>



            </div>

        </nav>

        <div class="pcoded-content">

            <div class="pcoded-inner-content">

                <div class="main-body">

                    <div class="page-wrapper">

                        @yield('content')

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>