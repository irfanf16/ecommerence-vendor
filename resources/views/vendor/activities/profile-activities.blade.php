@extends('vendor.layouts.master', ['navItem' => 'account_settings'])
@section('title', 'Account Setting ')

@section('content')
    <style>
        .modal-header .close {
            padding: 0px !important;
            margin: 0px !important;
        }

        button {
            outline: none !important;
        }

        .close>span:not(.sr-only) {
            background-color: transparent;
            line-height: 20px;
            height: 1.25 rem;
            width: 1.25 rem;
            border-radius: 50%;
            font-size: 1.8rem;
            color: black;
            display: block;
            transition: all 0.2s ease-in-out;
        }

        .close>span:hover {
            background-color: transparent !important;

        }

        .activity-title {
            color: white;
            font-size: 18px;
            font-weight: bold;
        }

        .activity-title .module {
            background-color: black;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 14px;
        }

        .activity-detail {
            color: white;
        }

        .activity-date {
            color: lightgray;
        }

    </style>
    <div class="container-fluid">



        {{-- Data Table Row --}}
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card border">
                    <div class="card-header text-center">
                        <h3 class="mb-0">Activity Log</h3>
                    </div>

                    <div class="card-header border-0">
                        <h6>



                            {{-- <a href="{{ URL::to('/vendor/products/create') }}" title="Go to Add New User "
                                    class="btn btn-primary ">Add User</a> --}}


                            {{-- <a href="{{ URL::to('/vendor/product/upload-csv') }}"
                                    title="Go to Product CSV File Upload Page" class="btn btn-success float-right mx-2">Add
                                    CSV
                                    File</a> --}}



                        </h6>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            @foreach ($activities as $activity)

                                <div class="card bg-gray" style="padding: 20px;">
                                    <div class="row p-1">
                                        <div class="col-1 ">
                                            <img src="{{ url('/') }}/assets/images/avatar-png.png"
                                                style="height: 60px;" alt="">
                                        </div>
                                        <div class="col-6">
                                            <div class="activity-title">
                                                <span class="module">{{ $activity->module }}</span> |
                                                {{ $activity->message }}
                                            </div>
                                            <div class="activity-detail">
                                                {{ $activity->detail }}
                                            </div>
                                            <div class="activity-date">
                                                {{-- {{ \Carbon\Carbon::diffForHumans($activity->created_at) }} --}}
                                                {{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('customScripts')
    @if (Session::has('response'))
        {{ $response = Session::get('response')['action'] }}
        {{ $message = Session::get('response')['message'] }}

        <script>
            $(document).ready(function() {
                let response = "<?php echo $response; ?>";
                let message = "<?php echo $message; ?>";
                sweetAlert(response, message);

            });
        </script>

    @endif




    <script>
        $(document).ready(function() {


        });
    </script>


@endsection
