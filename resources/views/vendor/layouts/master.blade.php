<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{-- TITLE --}}
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    {{-- THEME BASICS FILES --}}
    <link rel="stylesheet" href="{{ URL::to('/assets/vendor/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/assets/vendor/fontawesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/assets/css/main.css') }}" type="text/css">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ URL::to('/assets/vendor/select2/select2.css') }}" />

    {{-- sweetalerts --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- colorpicker -->
    <link rel="stylesheet"
        href="{{ URL::to('/assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}" />

    <!-- tagsinput -->
    <link rel="stylesheet" href="{{ URL::to('/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/assets/css/main.css') }}" type="text/css">

    {{-- files includes for datatables in index pages --}}
    <link rel="stylesheet" href="{{ URL::to('/assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">

    {{-- custom css for **form-bdr-top ** --}}
    <link rel="stylesheet" href="{{ URL::to('/vendor/css/custom.css') }}">

    {{-- for field info message class --}}
    <link rel="stylesheet" href="{{ URL::to('/vendor/css/field_info.css') }}">


    {{-- SUMMERNOTE EDITOR --}}
    <link rel="stylesheet" href="{{ URL::to('/assets/vendor/summernote/dist/summernote.min.css') }}" />

    {{-- preview tables --}}
    <link rel="stylesheet" href="{{ URL::to('/vendor/css/preview.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

    @yield('head')

</head>

<body class="theme-indigo">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img src="{{ URL::to('/assets/images/storaklogo/preloader.svg') }}"
                    alt="ArrOw">
            </div>
        </div>
    </div>

    {{-- INCLUDE TOPBAR --}}
    @include('vendor.layouts.topbar')

    <div class="main_content" id="main-content">

        {{-- INCLUDE SIDEBAR --}}
        @include('vendor.layouts.sidebar')

        {{-- INCLUDE SEETTINGS0-BAR --}}
        {{-- @include('vendor.layouts.settingsbar') --}}

        <div class="page">

            {{-- breadcrumb navbar --}}
            {{-- @include('vendor.layouts.navbar') --}}

            @yield('content')

        </div>
    </div>

    {{-- jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


    <!-- Core -->
    <script src="{{ URL::to('/assets/bundles/c3.bundle.js') }}"></script>
    <script src="{{ URL::to('/assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ URL::to('/assets/bundles/vendorscripts.bundle.js') }}"></script>


    <!-- JVectorMap Plugin Js -->
    <script src="{{ URL::to('/assets/js/theme.js') }}"></script>
    <script src="{{ URL::to('/assets/js/pages/index.js') }}"></script>
    {{-- <script src="{{ URL::to('/assets/js/pages/todo-js.js') }}"></script> --}}

    <!-- Select2 Js -->
    <script src="{{ URL::to('/assets/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ URL::to('/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ URL::to('/assets/js/pages/tables/jquery-datatable.js') }}"></script>
    {{-- <script src="{{ URL::to('/assets/js/pages/advanced-form.js') }}"></script> --}}

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ URL::to('/assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::to('/assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::to('/assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::to('/assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::to('/assets/vendor/jquery-datatable/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ URL::to('/assets/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::to('/assets/vendor/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
    <!-- <script src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script> -->
    <script src="{{ URL::to('/vendor/js/customscripts.js') }}"></script>

    <!-- Theme JS -->
    <script src="{{ URL::to('/assets/js/theme.js') }}"></script>
    <script src="{{ URL::to('/assets/js/pages/advanced-form.js') }}"></script>

    <script src="{{ URL::to('/vendor/js/bootstrap-colorpicker.js') }}"></script>
    <!-- Bootstrap Colorpicker Js -->
    <script src="{{ URL::to('/vendor/js/jquery.inputmask.bundle.js') }}"></script>


    <!-- summernote css/js -->
    {{-- <script src="{{ URL::to('/vendor/summernote/dist/summernote.js') }}"></script> --}}

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    @yield('customScripts')



</body>

</html>
