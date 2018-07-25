<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="System use to manage ongoing event">
    <meta name="keywords" content="event, management, admin, kuching, sarawak, malaysia">
    <meta name="author" content="kuchingitsolutions">

    <!-- CSRF Token -->
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->

    <title>@yield('title')</title>

    <!-- Scripts -->
<!--     <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script> -->

    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('css/app.css') }}assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('icon/themify-icons/themify-icons.css') }}">
    <!-- ico font -->
     <link rel="stylesheet" type="text/css" href="{{ asset('icon/icofont/css/icofont.css') }}">
    <!-- flag icon framework css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('pages/flag-icon/flag-icon.min.css') }}">
    <!-- Menu-Search css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('pages/menu-search/css/component.css') }}">
    <!-- amchart css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('pages/dashboard/amchart/css/amchart.css') }}">
    <!-- Horizontal Timeline -->
    <link rel="stylesheet" type="text/css" href="{{ asset('pages/dashboard/horizontal-timeline/css/style.css') }}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <!--color css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/linearicons.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('css/simple-line-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.mCustomScrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('node_modules/bootstrap-sweetalert/dist/sweetalert.css') }}">
    <script type="text/javascript" src="{{ asset('js/jquery-2.1.4.js') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style type="text/css">
        .btn i {
            margin-right: 0px;
        }
    </style>
</head>
<body>

    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div></div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            @if(Auth::check())
            <nav class="navbar header-navbar pcoded-header" style="border-radius: 0px;">
                <div class="navbar-wrapper">
                    <div class="navbar-logo" data-navbar-theme="theme4" style="height: 4.5rem;">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <a class="mobile-search morphsearch-search" href="#">
                            <i class="ti-search"></i>
                        </a>
                        <a href="#!">
                            <img class="img-fluid" src="{{ asset('images/logo_.png') }}" alt="Theme-Logo" />
                        </a>
                        <a class="mobile-options">
                            <i class="ti-more"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <div>
                            <ul class="nav-left">
                                <li>
                                    <div class="sidebar_toggle"><a style="top: 1.3rem;" href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                                </li>
                                <li class="hidden">
                                    <a class="main-search morphsearch-search" href="#">
                                        <!-- themify icon -->
                                        <i class="ti-search"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#!" onclick="javascript:toggleFullScreen()">
                                        <i class="ti-fullscreen"></i>
                                    </a>
                                </li>
                                {{-- <li class="mega-menu-top">
                                    <a href="#">
                                        Mega
                                        <i class="ti-angle-down"></i>
                                    </a>
                                    <ul class="show-notification row">
                                        <li class="col-sm-3">
                                            <h6 class="mega-menu-title">Popular Links</h6>
                                            <ul class="mega-menu-links">
                                                <li><a href="form-elements-component.html">Form Elements</a></li>
                                                <li><a href="button.html">Buttons</a></li>
                                                <li><a href="map-google.html">Maps</a></li>
                                                <li><a href="#!">Contact Cards</a></li>
                                                <li><a href="#!">User Information</a></li>
                                                <li><a href="auth-lock-screen.html">Lock Screen</a></li>
                                            </ul>
                                        </li>
                                        <li class="col-sm-3">
                                            <h6 class="mega-menu-title">Mailbox</h6>
                                            <ul class="mega-mailbox">
                                                <li>
                                                    <a href="#" class="media">
                                                        <div class="media-left">
                                                            <i class="ti-folder"></i>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>Data Backup</h5>
                                                            <small class="text-muted">Store your data</small>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="media">
                                                        <div class="media-left">
                                                            <i class="ti-headphone-alt"></i>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>Support</h5>
                                                            <small class="text-muted">24-hour support</small>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="media">
                                                        <div class="media-left">
                                                            <i class="ti-dropbox"></i>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>Drop-box</h5>
                                                            <small class="text-muted">Store large amount of data in one-box only
                                                            </small>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="media">
                                                        <div class="media-left">
                                                            <i class="ti-location-pin"></i>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>Location</h5>
                                                            <small class="text-muted">Find Your Location with ease of use</small>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="col-sm-3">
                                            <h6 class="mega-menu-title">Gallery</h6>
                                            <div class="row m-b-20">
                                                <div class="col-sm-4"><img class="img-fluid img-thumbnail" src="assets/images/mega-menu/01.jpg" alt="Gallery-1">
                                                </div>
                                                <div class="col-sm-4"><img class="img-fluid img-thumbnail" src="assets/images/mega-menu/02.jpg" alt="Gallery-2">
                                                </div>
                                                <div class="col-sm-4"><img class="img-fluid img-thumbnail" src="assets/images/mega-menu/03.jpg" alt="Gallery-3">
                                                </div>
                                            </div>
                                            <div class="row m-b-20">
                                                <div class="col-sm-4"><img class="img-fluid img-thumbnail" src="assets/images/mega-menu/04.jpg" alt="Gallery-4">
                                                </div>
                                                <div class="col-sm-4"><img class="img-fluid img-thumbnail" src="assets/images/mega-menu/05.jpg" alt="Gallery-5">
                                                </div>
                                                <div class="col-sm-4"><img class="img-fluid img-thumbnail" src="assets/images/mega-menu/06.jpg" alt="Gallery-6">
                                                </div>
                                            </div>
                                            <button class="btn btn-primary btn-sm btn-block">Browse Gallery</button>
                                        </li>
                                        <li class="col-sm-3">
                                            <h6 class="mega-menu-title">Contact Us</h6>
                                            <div class="mega-menu-contact">
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-3 col-form-label">Name</label>
                                                    <div class="col-9">
                                                        <input class="form-control" type="text" placeholder="Artisanal kale" id="example-text-input">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-search-input1" class="col-3 col-form-label">Email</label>
                                                    <div class="col-9">
                                                        <input class="form-control" type="email" placeholder="Enter your E-mail Id" id="example-search-input1">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="example-search-input2" class="col-3 col-form-label">Contact</label>
                                                    <div class="col-9">
                                                        <input class="form-control" type="number" placeholder="+91-9898989898" id="example-search-input2">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleTextarea" class="col-3 col-form-label">Message</label>
                                                    <div class="col-9">
                                                        <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li> --}}
                            </ul>


                            <ul class="nav-right">
                                {{-- <li class="header-notification lng-dropdown">
                                    <a href="#" id="dropdown-active-item">
                                        <i class="flag-icon flag-icon-gb m-r-5"></i> English
                                    </a>
                                    <ul class="show-notification">
                                        <li>
                                            <a href="#" data-lng="en">
                                                <i class="flag-icon flag-icon-gb m-r-5"></i> English
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" data-lng="es">
                                                <i class="flag-icon flag-icon-es m-r-5"></i> Spanish
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" data-lng="pt">
                                                <i class="flag-icon flag-icon-pt m-r-5"></i> Portuguese
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" data-lng="fr">
                                                <i class="flag-icon flag-icon-fr m-r-5"></i> French
                                            </a>
                                        </li>
                                    </ul>
                                </li> --}}

                                {{-- <li class="header-notification">
                                    <a href="#!">
                                        <i class="ti-bell"></i>
                                        <span class="badge">5</span>
                                    </a>
                                    <ul class="show-notification">
                                        <li>
                                            <h6>Notifications</h6>
                                            <label class="label label-danger">New</label>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <img class="d-flex align-self-center" src="{{ asset('images/user.png') }}" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="notification-user">John Doe</h5>
                                                    <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                    <span class="notification-time">30 minutes ago</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <img class="d-flex align-self-center" src="{{ asset('images/user.png') }}" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="notification-user">Joseph William</h5>
                                                    <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                    <span class="notification-time">30 minutes ago</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <img class="d-flex align-self-center" src="{{ asset('images/user.png') }}" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="notification-user">Sara Soudein</h5>
                                                    <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                    <span class="notification-time">30 minutes ago</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li> --}}

                                <li class="user-profile header-notification">
                                    <a href="#!">
                                        <img src="{{ asset('images/people.png') }}" alt="User-Profile-Image">
                                        <span>{{Auth::user()->name}}</span>
                                        <i class="ti-angle-down"></i>
                                    </a>
                                    <ul class="show-notification profile-notification">
                                        <li>
                                            <a href="#!">
                                                <i class="ti-settings"></i> Settings
                                            </a>
                                        </li>
                                        <li class="hidden">
                                            <a href="user-profile.html">
                                                <i class="ti-user"></i> Profile
                                            </a>
                                        </li>
                                        <li class="hidden">
                                            <a href="#!">
                                                <i class="ti-email"></i> My Messages
                                            </a>
                                        </li>
                                        <li class="hidden">
                                            <a href="auth-lock-screen.html">
                                                <i class="ti-lock"></i> Lock Screen
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('logout')}}">
                                                <i class="ti-layout-sidebar-left"></i> Logout
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                            <!-- search -->
                            <div id="morphsearch" class="morphsearch">
                                <form class="morphsearch-form">
                                    <input class="morphsearch-input" type="search" placeholder="Search..." />
                                    <button class="morphsearch-submit" type="submit">Search</button>
                                </form>
                                <div class="morphsearch-content">
                                    <div class="dummy-column">
                                        <h2>People</h2>
                                        <a class="dummy-media-object" href="#!">
                                            <img class="round" src="http://0.gravatar.com/avatar/81b58502541f9445253f30497e53c280?s=50&d=identicon&r=G" alt="Sara Soueidan" />
                                            <h3>Sara Soueidan</h3>
                                        </a>
                                        <a class="dummy-media-object" href="#!">
                                            <img class="round" src="http://1.gravatar.com/avatar/9bc7250110c667cd35c0826059b81b75?s=50&d=identicon&r=G" alt="Shaun Dona" />
                                            <h3>Shaun Dona</h3>
                                        </a>
                                    </div>
                                    <div class="dummy-column">
                                        <h2>Popular</h2>
                                        <a class="dummy-media-object" href="#!">
                                            <img src="assets/images/avatar-1.png" alt="PagePreloadingEffect" />
                                            <h3>Page Preloading Effect</h3>
                                        </a>
                                        <a class="dummy-media-object" href="#!">
                                            <img src="assets/images/avatar-1.png" alt="DraggableDualViewSlideshow" />
                                            <h3>Draggable Dual-View Slideshow</h3>
                                        </a>
                                    </div>
                                    <div class="dummy-column">
                                        <h2>Recent</h2>
                                        <a class="dummy-media-object" href="#!">
                                            <img src="assets/images/avatar-1.png" alt="TooltipStylesInspiration" />
                                            <h3>Tooltip Styles Inspiration</h3>
                                        </a>
                                        <a class="dummy-media-object" href="#!">
                                            <img src="assets/images/avatar-1.png" alt="NotificationStyles" />
                                            <h3>Notification Styles Inspiration</h3>
                                        </a>
                                    </div>
                                </div>
                                <!-- /morphsearch-content -->
                                <span class="morphsearch-close"><i class="icofont icofont-search-alt-1"></i></span>
                            </div>
                            <!-- search end -->
                        </div>
                    </div>
                </div>
            </nav>
            @endif
            @include('layouts.navigational')
            
            
            
        </div>
    </div>


<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/jquery/dist/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/tether/dist/js/tether.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="{{ asset('plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
<!-- modernizr js -->
<script type="text/javascript" src="{{ asset('plugins/modernizr/modernizr.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/modernizr/feature-detects/css-scrollbars.js') }}"></script>
<!-- classie js -->
<script type="text/javascript" src="{{ asset('plugins/classie/classie.js') }}"></script>
<!-- Rickshow Chart js -->
<!-- <script src="{{ asset('plugins/d3/d3.js') }}"></script>
<script src="{{ asset('plugins/rickshaw/rickshaw.js') }}"></script> -->
<!-- Morris Chart js -->
<script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('plugins/morris.js/morris.js') }}"></script>
<!-- amchart js -->
<script type="text/javascript" src="{{ asset('pages/dashboard/amchart/js/amcharts.js') }}"></script>
<script type="text/javascript" src="{{ asset('pages/dashboard/amchart/js/serial.js') }}"></script>
<script type="text/javascript" src="{{ asset('pages/dashboard/amchart/js/light.js') }}"></script>
<script type="text/javascript" src="{{ asset('pages/dashboard/amchart/js/custom-amchart.js') }}"></script>
<!-- i18next.min.js -->
<script type="text/javascript" src="{{ asset('plugins/i18next/i18next.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/i18next-xhr-backend/i18nextXHRBackend.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/jquery-i18next/jquery-i18next.min.js') }}"></script>
<!-- Custom js -->
<!--<script type="text/javascript" src="{{ asset('pages/dashboard/custom-dashboard.js') }}"></script>-->
<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/pcoded.min.js') }}"></script>
<script src="{{ asset('js/demo-12.js') }}"></script>
<script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('js/jquery.mousewheel.min.js') }}"></script>
<script src="{{ asset('node_modules/bootstrap-sweetalert/dist/sweetalert.min.js') }}"></script>
</body>
</html>
