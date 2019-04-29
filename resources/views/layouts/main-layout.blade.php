<!--

    Created By: Nii Codbit
    Date: 30/03/13

    empty container with the base layout of the dashboard.
    Created this so that we can have something to play around layouts with.
    Copy this whenever you want to create a new page.

    
-->
<?php $user = Auth::user(); ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{$page_title}} | GUARD ATTENDANCE MANAGEMENT SYSTEM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Guard attendance management system. Allows security agencies to track the attendance of their guards."
        name="description" />
    <meta content="Codbit Developers" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!--Custom css-->
    @yield('styles')


    <!-- App css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css" />


    <script src="{{asset('assets/js/modernizr.min.js')}}"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Rubik" rel="stylesheet">

</head>

<body>

    <!-- Navigation Bar-->
    <header id="topnav">
        <div class="topbar-main">
            <div class="container-fluid">

                <!-- Logo container-->
                <div class="logo">
                    <a href="index.html" class="logo">
                        <img src="{{asset('assets/images/offin-logo.png')}}" alt="" height="48" class="logo-small">
                        <img src="{{asset('assets/images/offin-logo.png')}}" alt="" height="42" class="logo-large">
                    </a>

                </div>
                <!-- End Logo container-->


                <div class="menu-extras topbar-custom">

                    <ul class="list-unstyled topbar-right-menu float-right mb-0">

                        <li class="menu-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle nav-link">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>
                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect nav-user" data-toggle="dropdown" href="#"
                                role="button" aria-haspopup="false" aria-expanded="false">
                                <img class="rounded-circle" height="30" style="width: 30px" avatar="{{ucwords(Auth::user()->firstname.' '.Auth::user()->lastname)}}" />
                                <span class="ml-1 pro-user-name">
                                    {{ucwords(Auth::user()->firstname.' '.Auth::user()->lastname)}} <i class="mdi mdi-chevron-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">


                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fi-head"></i> <span>My Account</span>
                                </a>

                                <a href="{{ route('logout') }}" class="dropdown-item notify-item" 
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    <i class="fi-power"></i>
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                            </div>
                        </li>
                    </ul>
                </div>
                <!-- end menu-extras -->

                <div class="clearfix"></div>

            </div> <!-- end container -->
        </div>
        <!-- end topbar-main -->

        <div class="navbar-custom">
            <div class="container-fluid">
                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">

                        <li>
                            <a href="/home" class="active">Dashboard</a>
                        </li>

                        <li class="has-submenu">
                            <a href="javascript:void(0)">Guards</a>
                            <ul class="submenu">
                                <li><a href="/guards">View Guards</a></li>
                                <li><a href="/guards/add">New Guard</a></li>
                                <li><a href="/guards/reports">Guard Reports</a></li>
                            </ul>
                        </li>

                        <li class="">
                            <a href="/clients">Clients</a>
                        </li>

                        <li class="has-submenu">
                            <a href="javascript:void(0)">Attendance</a>
                            <ul class="submenu">
                                <li><a href="/attendance">View Attendance</a></li>
                                <li><a href="/permissions">Permissions</a></li>
                            </ul>
                        </li>

                        <li class="has-submenu">
                            <a href="javascript:void(0)">Offences</a>
                            <ul class="submenu">
                                <li>
                                    <a href="/offences">Guard Offences</a>
                                </li>
                                <li>
                                    <a href="/offence-types">Offence Types</a>
                                </li>
                                <li>
                                    <a href="/view-deductions">View Monthly Offences</a>
                                </li>
                            </ul>
                        </li>

                        <li class="has-submenu">
                            <a href="javascript:void(0)">Reports</a>
                            <ul class="submenu">
                                <li>
                                    <a href="/send-report">New Report</a>
                                </li>
                                <li>
                                    <a href="/view-reports">View Reports</a>
                                </li>
                            </ul>
                        </li>
                        @if(strtolower(Auth::user()->role) == 'Admin')
                        <li>
                            <a href="/users">Users</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <!-- End Navigation Bar-->


    <div class="wrapper">
        <div class="container-fluid">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#">OSAMS</a></li>
                                <li class="breadcrumb-item active">{{$page_title}}</li>
                            </ol>
                        </div>
                        <h4 class="page-title">{{$page_title}}</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <!--
                content you want comes here
            -->
            @yield('content')
            
        </div> <!-- end container -->
    </div>
    <!-- end wrapper -->
    @yield('modals')

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    2019 &copy; OSAMS. - Made with ❤️ By <a href="http://codbitgh.com">Codbit Ghana Limited</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->


    <!-- jQuery  -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/waves.js')}}"></script>
    <script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('assets/js/avatar.js')}}"></script>

    
    @yield('scripts')

    <!-- App js -->
    <script src="{{asset('assets/js/jquery.core.js')}}"></script>
    <script src="{{asset('assets/js/jquery.app.js')}}"></script>

</body>

</html>