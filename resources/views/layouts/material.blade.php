<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- Custom CSS -->
    <link href="{{ asset('material/lite/css/style.css') }}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ asset("material/lite/css/colors/{$config->theme}") }}" id="theme" rel="stylesheet">
    @yield('css')
</head>

<body class="fix-header fix-sidebar text-dark font-weight-normal card-no-border mini-sidebar">
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader center">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <div class="navbar-header">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->

                            <!-- Light Logo icon -->
                            <img src="{{ asset('logo.png') }}" width="50px" height="50px" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span class="text-white shadow-sm">{{ $config->name }}</span>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi text-white mdi-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi text-white mdi-menu"></i></a> </li>
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->

                        <li class="nav-item"><a href="" class="nav-link"> <i class="mdi mdi-bell text-white mdi-18px"></i><span class='badge float-sm-right badge-danger'> 0 </span></a> </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('holder.png') }}" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="{{ asset('holder.png') }}" alt="user"></div>
                                            <div class="u-text">
                                                <h4>{{ Auth::user()->name }}</h4>
                                                <p class="text-muted"></p><a href="" class="btn btn-rounded btn-danger btn-sm">Voir Profil</a></div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a><i class="mdi mdi-account-box-outline"></i> Rôle: <span class="ml-2">{{ Auth::user()->role }}</span></a></li>
                                    <li><a href="{{ route('change.password') }}"><i class="mdi mdi-account-edit"></i> Changer mot de passe <span class="ml-2"></span></a></li>
                                    <li><a href="#" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="mdi mdi-logout-variant"></i> Déconnexion</a></li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
               @include('partials.sidebar')
                <!-- End Sidebar navigation -->
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <!-- End Bottom points-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="loader"></div>
                <br>
               @yield('content')
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer"> © {{ date('Y') }} RHManager </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->

    <script src="{{ mix('js/app.js') }}"></script>

    <script src="{{ asset('js/fileinput.min.js') }}"></script>
    <script src="{{ asset('js/helpers.js') }}"></script>

@yield('js')
    @if(Session::has('success'))
        <script>
            $(function () {
                $.toast({
                    heading: 'SUCCESS',
                    text: '{{ session('success') }}',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'success',
                    hideAfter: 4000,
                    stack: 6
                });
            })
        </script>
    @elseif(Session::has('warning'))

        <script>
            $(function () {
                $.toast({
                    heading: 'WARNING',
                    text: '{{ session('warning') }}',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'warning',
                    hideAfter: 4000,
                    stack: 6
                });
            })
        </script>

    @elseif(Session::has('info'))
        <script>
            $(function () {
                $.toast({
                    heading: 'INFO',
                    text: '{{ session('info') }}',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'info',
                    hideAfter: 4000,
                    stack: 6
                });
            })
        </script>

    @elseif(Session::has('danger'))
        <script>
            $(function () {
                $.toast({
                    heading: 'ERROR',
                    text: '{{ session('danger') }}',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'error',
                    hideAfter: 4000,
                    stack: 6
                });
            })
        </script>

    @endif
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->

</body>

</html>
