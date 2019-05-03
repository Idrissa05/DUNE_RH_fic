<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('material/assets/images/favicon.png') }}">
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('material/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('material/assets/plugins/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('material/lite/css/style.css') }}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ asset('material/lite/css/colors/blue-gray.css') }}" id="theme" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<section id="wrapper">
    @yield('content')
</section>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{ asset('material/assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap tether Core JavaScript -->


<script src="{{ asset('material/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('material/assets/plugins/popper/popper.min.js') }}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('material/lite/js/jquery.slimscroll.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('material/lite/js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ asset('material/lite/js/sidebarmenu.js') }}"></script>
<!--stickey kit -->
<script src="{{ asset('material/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('material/lite/js/custom.min.js') }}"></script>
<script src="{{ asset('js/fileinput.min.js') }}"></script>
<script src="{{ asset('material/assets/plugins/toast-master/js/jquery.toast.js') }}"></script>
@if(Session::has('success'))
    <script>
        $(function () {
            $.toast({
                heading: 'SUCCES',
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
                heading: 'ERREUR',
                text: '{{ session('error') }}',
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
                text: '{{ session('success') }}',
                position: 'top-right',
                loaderBg:'#ff6849',
                icon: 'danger',
                hideAfter: 4000,
                stack: 6
            });
        })
    </script>

@endif

</body>

</html>
