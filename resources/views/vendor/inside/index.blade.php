@extends('vendor.layouts.master', ['navItem' => 'inside'])
@section('title', 'Statistic ')

@section('content')
    <style>
        .modal-header .close {
            padding: 0px !important;
            margin: 0px !important;
        }

        button {
            outline: none !important;
        }

        .close > span:not(.sr-only) {
            background-color: transparent;
            line-height: 20px;
            height: 1.25rem;
            width: 1.25rem;
            border-radius: 50%;
            font-size: 1.8rem;
            color: black;
            display: block;
            transition: all 0.2s ease-in-out;
        }

        .close > span:hover {
            background-color: transparent !important;
        }

    </style>
    <div class="container-fluid">

        <div class="row clearfix order-card-main center-block">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <input type="date" name="start_date" id="statistic_start_date" class="form-control">
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <input type="date" name="end_date" id="statistic_end_date"  class="form-control">
            </div>
        </div>

        <div id="statistic_table"></div>

    </div>

@endsection

@section('customScripts')
    @if (Session::has('response'))
        {{ $response = Session::get('response')['action'] }}
        {{ $message = Session::get('response')['message'] }}

        <script>
            $(document).ready(function () {
                let response = "<?php echo $response; ?>";
                let message = "<?php echo $message; ?>";
                sweetAlert(response, message);
                $('#clickyes').click(function (e) {
                    e.preventDefault();
                    alert("element");
                    var element = $('#invoice').html();
                    alert(element);

                });
            });
        </script>
    @endif
@endsection
