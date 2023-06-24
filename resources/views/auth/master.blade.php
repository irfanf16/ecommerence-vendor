<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="ThemeMakker">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Storak</title>
    <link rel="stylesheet" href="{{ URL::to('assets/vendor/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/vendor/fontawesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/main.css') }}" type="text/css">
    {{-- cutome js and css for error alert and sweet alerts --}}
    <link rel="stylesheet" href="{{ URL::to('/vendor/css/custom.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ URL::to('/vendor/css/sweetalerts.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ URL::to('/vendor/js/customscripts.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ URL::to('/vendor/css/sweetalerts.js') }}" type="text/css">
    <link rel="stylesheet" href="{{ URL::to('/vendor/css/signupSlider.css') }}" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body class="theme-indigo">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img src="{{ URL::to('/assets/images/storaklogo/preloader.svg') }}" alt="ArrOw"></div>

        </div>
    </div>

    <!-- WRAPPER -->
    @yield('content')
    <!-- END WRAPPER -->

    <!-- Core -->
    <script src="{{ URL::to('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ URL::to('assets/bundles/vendorscripts.bundle.js') }}"></script>

    <script src="{{ URL::to('assets/js/theme.js') }}"></script>
    {{-- <script src="{{ asset('assets/bundles/summernote-ext-rtl.js') }}"></script> --}}
</body>

</html>
