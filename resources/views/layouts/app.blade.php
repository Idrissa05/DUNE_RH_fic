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
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('material/lite/css/style.css') }}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
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

<!--Custom JavaScript -->
<script src="{{ mix('js/app.js') }}"></script>
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
