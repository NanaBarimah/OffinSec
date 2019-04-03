<!--

    Created By: Nii Codbit
    Date: 30/03/13

    empty container with the base layout of the dashboard.
    Created this so that we can have something to play around layouts with.
    Copy this whenever you want to create a new page.

    
-->
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

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fi-lock"></i> <span>Lock Screen</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fi-power"></i> <span>Logout</span>
                                </a>

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
                            <a href="#" class="active">Dashboard</a>
                        </li>

                        <li class="has-submenu">
                            <a href="#">Guards</a>
                            <ul class="submenu">
                                <li><a href="#">View Guards</a></li>
                                <li><a href="#">New Guard</a></li>
                                <li><a href="#">Guard Reports</a></li>
                            </ul>
                        </li>

                        <li class="">
                            <a href="#">Clients</a>
                        </li>

                        <li class="has-submenu">
                            <a href="#">Attendance</a>
                            <ul class="submenu">
                                <li><a href="#">View Attendance</a></li>
                                <li><a href="#">Mark Attendance</a></li>
                                <li><a href="#">Permissions</a></li>
                                <li><a href="#">Attendance Reports</a></li>
                            </ul>
                        </li>

                        <li class="has-submenu">
                            <a href="#">Deductions</a>
                            <ul class="submenu">
                                <li>
                                    <a href="#">Record Deduction</a>
                                </li>
                                <li>
                                    <a href="#">View Guard Deductions</a>
                                </li>
                                <li>
                                    <a href="#">Deduction Types</a>
                                </li>
                            </ul>
                        </li>

                        <li class="has-submenu">
                            <a href="#">Reports</a>
                            <ul class="submenu">
                                <li>
                                    <a href="#">New Report</a>
                                </li>
                                <li>
                                    <a href="#">View Reports</a>
                                </li>
                                <li>
                                    <a href="#">Report Templates</a>
                                </li>
                            </ul>
                        </li>
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