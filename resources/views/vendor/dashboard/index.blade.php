@extends('vendor.layouts.master',['navItem' => 'dashsboard'])
@section('title', 'Dashboard ')

@section('content')

    {{-- DASHBOARD SPECIFIC CSS FILES --}}
    <link rel="stylesheet" href="{{ URL::to('/assets/vendor/charts-c3/plugin.css') }}"/>
    <link rel="stylesheet" href="{{ URL::to('/assets/vendor/jvectormap/jquery-jvectormap-2.0.3.css') }}"/>
    <link rel="stylesheet" href="{{ URL::to('/assets/vendor/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/assets/vendor/morrisjs/morris.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/assets/vendor/jquery-steps/jquery.steps.css') }}">
    <style>
        .checked {
            color: orange;
        }

        .go-btn:hover {
            color: #113150;
            cursor: pointer;

        }

    </style>


    {{-- ============================================================================
                                Cards section
    =========================================================================== --}}
    <div class="container-fluid">
        {{-- <div class="custom-notification warning card">
            <div class="notification-content">
                <h2>Incomplete Profile Information</h2>
                <p>Please complete your profile first </p>
            </div>
        </div>
        <div class="custom-notification success card">
            <div class="notification-content">
                <h2>Incomplete Profile Information</h2>
                <p>Please complete your profile first </p>
            </div>
        </div>
        <div class="custom-notification danger card">
            <div class="notification-content">
                <h2>Incomplete Profile Information</h2>
                <p>Please complete your profile first </p>
            </div>
        </div> --}}



        {{-- --------------- Alert => Vendor Profile Status  ---------------- --}}
        {{-- ---------------------------------------------------------------- --}}
        @if ($profile_status == 0)
            <div class="custom-notification danger card">
                <div class="notification-content">
                    <h2>Incomplete Profile Information !</h2>
                    <p>Please complete your profile first </p>
                </div>
            </div>
        @elseif($profile_status == 1)
            <div class="custom-notification warning card">
                <div class="notification-content">
                    <h2>Profile Information Under Review !</h2>
                    <p>Please wait until profile verification process is completed</p>
                </div>
            </div>
        @elseif($profile_status == 3)
            <div class="custom-notification danger card">
                <div class="notification-content">
                    <h2>Update Profile Information!</h2>
                    <p>Please update your profile information.</p>
                </div>
            </div>
        @endif


        {{-- --------------- Quick Statistics Cards Section  ---------------- --}}
        {{-- ---------------------------------------------------------------- --}}
        <div class="row clearfix">

            {{-- Total Products --}}
            <div class="col-lg-3 col-md-8 col-sm-12  ">
                <a href="{{ URL::to('/vendor/products') }}" title="Go to all products page">
                    <div class="card shadow-sm">
                        <div class="body pb-1">
                            <div class="row">
                                <div class="col-8">
                                    <h6>Products</h6>
                                    <h2>{{ $products_count }}</h2>
                                </div>
                                <div class="col-4 px-2">
                                    <img src="{{ url('vendor/images/icons/order/order.svg') }}"
                                         class="rounded w-100 stats-icons" alt="Total Orders">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Total Orders --}}
            <div class="col-lg-3 col-md-8 col-sm-12  ">
                {{-- <a href="{{ URL::to('/vendor/orders') }}" title="Go to all order page"> --}}
                <div class="card  shadow-sm">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h6>Orders</h6>
                                <h2>{{ $orders_count }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ url('vendor/images/icons/order/inactive-order.svg') }}"
                                     class="rounded w-100 stats-icons" alt="Pending Orders ">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- </a> --}}
            </div>

            {{-- Total Coupons --}}
            <div class="col-lg-3 col-md-8 col-sm-12  ">
                {{-- <a href="{{ URL::to('/vendor/coupons') }}" title="Go to all coupons page"> --}}
                <div class="card border-0 shadow-sm">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h6>Coupons</h6>
                                <h2>{{ $coupons_count }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ url('vendor/images/icons/order/inactive-order.svg') }}"
                                     class="rounded w-100 stats-icons" alt="Cancelled Orders ">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- </a> --}}
            </div>

            {{-- Active Offers --}}
            <div class="col-lg-3 col-md-8 col-sm-12  ">
                <div class="card shadow-sm">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h6>Active Offers</h6>
                                <h2>12</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ url('vendor/images/icons/order/active-order.svg') }}"
                                     class="rounded w-100 stats-icons" alt="Active Offers ">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- order sale graph --}}
            {{-- <div class="col-lg-12 col-md-12">
                <div class="card shadow-lg form-bdr-top">
                    <div class="header">
                        <img src="https://img.icons8.com/fluent/22/4a90e2/order-history.png" />
                        <h2>Order-Sale</h2>
                    </div>
                    <div class="body">
                        <div id="multiple-chart" class="ct-chart"></div>
                    </div>
                </div>
            </div> --}}

            {{-- Store  Analytics graph --}}
            {{-- <div class="col-lg-6 col-md-6">
                <div class="card shadow-lg form-bdr-top">
                    <div class="header">
                        <span><img src="https://img.icons8.com/fluent/22/000000/combo-chart.png" />
                        </span>
                        <h2>Store Analytics</h2>
                    </div>
                    <div class="body">
                        <div id="line-chart" class="ct-chart"></div>
                    </div>
                </div>
            </div> --}}

            {{-- sale-product graph --}}

            {{-- <div class="col-lg-6 col-md-6">
                <div class="card shadow-lg form-bdr-top">
                    <div class="header">
                        <span><img src="https://img.icons8.com/fluent/22/000000/statistics.png" />
                        </span>
                        <h2>Sales by Product</h2>
                    </div>
                    <div class="body text-center">
                        <div id="chart-pie" class="c3_chart d_distribution"></div>
                        <button class="btn btn-primary mt-4 mb-4">View More</button>
                    </div>
                </div>
            </div> --}}

            {{-- Store stats --}}
            <div class="col-lg-6 col-md-6">
                <div class="card shadow-lg form-bdr-top">
                    <div class="header">
                        <img src="https://img.icons8.com/fluent/22/000000/online-shopping.png"/>
                        <h2>Store Stats</h2>
                    </div>
                    <div class="body">
                        <div>
                            <ul class="list-group list-group-flush">

                                <li class="list-group-item text-default"><img
                                        src="https://img.icons8.com/fluent/22/000000/iphone-spinner.png"/>
                                    <h5 class="d-inline pl-2"><a
                                            href="{{ url('/') }}/vendor/orders">{{ $orders_count }} orders </a>
                                    </h5>
                                    -Total
                                </li>

                                <li class="list-group-item text-default"><img style="height:20px;"
                                                                              src="{{ url('/') }}/vendor/images/icons/order/active-order.svg"/>
                                    <h5 class="d-inline pl-2"><a
                                            href="{{ url('/') }}/vendor/orders">{{ $orders_count }} orders </a>
                                    </h5>
                                    -Delivered
                                </li>

                                <li class="list-group-item text-danger">
                                    <img src="https://img.icons8.com/fluent/22/000000/iphone-spinner.png"/>
                                    <h5 class="d-inline pl-2">
                                        <a href="{{ url('/') }}/vendor/products">
                                            {{ $products_count }} products
                                        </a>
                                    </h5>
                                    -Total
                                </li>
                                {{-- <li class="list-group-item text-danger"><img
                                        src="https://img.icons8.com/fluent/22/000000/feed-in.png" />
                                    <h5 class="d-inline pl-2"><a href="">9 products </a></h5>- low in stock
                                </li> --}}
                                {{-- <li class="list-group-item text-danger"> <img
                                        src="https://img.icons8.com/fluent/22/000000/delete-sign.png" />
                                    <h5 class="d-inline pl-2"><a href="">6 products </a></h5>- out of stock
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Notifications --}}
            <div class="col-lg-6 col-md-6">
                <div class="card shadow-lg form-bdr-top">
                    <div class="header">
                        <img src="https://img.icons8.com/fluent/22/000000/bell.png"/>
                        <h2>Notifications</h2>
                        <a class="btn btn-sm btn-primary ml-4" href="{{ url('/') }}/vendor/notications/all">
                            Show All Notifications
                        </a>
                    </div>
                    <div class="body">
                        <div>
                            <ul class="list-group list-group-flush">
                                @if ($recent_notifications)

                                    @foreach ($recent_notifications as $recent_notification)
                                        <li class="list-group-item text-danger">
                                            <img src="https://img.icons8.com/fluent/22/000000/push-notifications.png"/>
                                            {{ $recent_notification->message }}

                                            <div class="timestamp ml-4" style="color:gray;">
                                                {{ Carbon\Carbon::parse($recent_notification->created_at)->diffForHumans() }}
                                            </div>
                                        </li>
                                    @endforeach
                                @endif

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Inquiries --}}
            <div class="col-lg-6 col-md-6 text-dark">
                <div class="card shadow-lg form-bdr-top">
                    <div class="header">
                        <img src="https://img.icons8.com/fluent/22/000000/why-us-male.png"/>
                        <h2>Inquiries</h2>
                    </div>
                    <div class="body">
                        <div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item text-warning"><img
                                        src="https://img.icons8.com/fluent/22/000000/ask-question.png"/> Order #32140
                                    delivered by Linga t.?
                                </li>
                                <li class="list-group-item text-warning"><img
                                        src="https://img.icons8.com/fluent/22/000000/ask-question.png"/> have You
                                    received
                                    a Booking #33535 for Kiran ?
                                </li>
                                <li class="list-group-item text-warning"><img
                                        src="https://img.icons8.com/fluent/22/000000/ask-question.png"/> what is #33479
                                    order status
                                    updated to Processing
                                    ?
                                </li>
                                <li class="list-group-item text-warning"><img
                                        src="https://img.icons8.com/fluent/22/000000/ask-question.png"/> Have You
                                    received
                                    a Booking #33535 for Kiran ?
                                </li>
                                <li class="list-group-item text-warning"><img
                                        src="https://img.icons8.com/fluent/22/000000/ask-question.png"/> Have You
                                    received
                                    an Order #33534 for Kiran ?
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Visitors Statistics --}}
            <div class="col-md-6 col-lg-6">
                <div class="card shadow-lg form-bdr-top">
                    <div class="header">
                        <h2>Customer Reviews & Rating </h2>
                    </div>
                    <div class="body" style="height: 450px;">
                        <div class="row">
                            <div class="col-md-2">

                            </div>
                            <div class="col-md-8"
                                 style="border: 1px solid lightgray; padding: 10px; border-radius: 7px;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="total-rating" style="text-align:center; font-size:40px;">
                                            4.3
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="stars" style="font-size: 25px;">
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>
                                        <div class="total-reviews">
                                            50 total reviews
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="recomendation-percent" style="text-align:center; font-size:25px;">
                                            80%
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="recomendation-title">
                                            of customers recommend this product
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 center-block"
                                 style=" margin:10px auto;height:220px;red; padding:5px;">
                                <div class="row mb-2"
                                     style="border: 1px solid lightgray;border-radius:10px; padding:5px;">
                                    <div class="col-md-3"
                                         style="text-align: center; display:grid; align-items:center;">
                                        <img style=" height: 50px;" src="{{ url('/') }}/assets/images/avatar-png.png"
                                             alt="" class="img">
                                    </div>
                                    <div class="col-md-7">
                                        <div class="stars" style="font-size: 15px;">
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>
                                        <div class="customer-review">
                                            I like this product very much . also recommend this product
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="display:grid; align-items:center;">
                                        <span class="fa fa-chevron-circle-right go-btn"
                                              style=" font-size:35px; float:right;"></span>
                                    </div>
                                </div>

                                <div class="row mb-2"
                                     style="border: 1px solid lightgray;border-radius:10px; padding:5px;">
                                    <div class="col-md-3"
                                         style="text-align: center; display:grid; align-items:center;">
                                        <img style=" height: 50px;" src="{{ url('/') }}/assets/images/avatar-png.png"
                                             alt="" class="img">
                                    </div>
                                    <div class="col-md-7">
                                        <div class="stars" style="font-size: 15px;">
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>
                                        <div class="customer-review">
                                            I like this product very much . also recommend this product
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="display:grid; align-items:center;">
                                        <span class="fa fa-chevron-circle-right  go-btn"
                                              style=" font-size:35px; float:right;"></span>
                                    </div>
                                </div>
                                <div class="row mb-2"
                                     style="border: 1px solid lightgray;border-radius:10px; padding:5px;">
                                    <div class="col-md-3"
                                         style="text-align: center; display:grid; align-items:center;">
                                        <img style=" height: 50px;" src="{{ url('/') }}/assets/images/avatar-png.png"
                                             alt="" class="img">
                                    </div>
                                    <div class="col-md-7">
                                        <div class="stars" style="font-size: 15px;">
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>
                                        <div class="customer-review">
                                            I like this product very much . also recommend this product
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="display:grid; align-items:center; ">
                                        <span class="fa fa-chevron-circle-right go-btn"
                                              style=" font-size:35px; float:right;"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- end content section --}}

@endsection

@section('customScripts')

    {{-- DASHBOARD SPECIFIC JAVASCRIPT FILES --}}
    <script src="{{ URL::to('/assets/bundles/c3.bundle.js') }}"></script>
    <script src="{{ URL::to('/assets/bundles/jvectormap.bundle.js') }}"></script>
    <!--for js charts  -->
    <script src="{{ URL::to('/assets/bundles/chartist.bundle.js') }}"></script>
    <script src="{{ URL::to('/assets/vendor/chartist/polar_area_chart.js') }}"></script>

    <!-- Polar Area Chart Js -->
    <script src="{{ URL::to('/assets/js/pages/charts/chartjs.js') }}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{ URL::to('/assets/bundles/morrisscripts.bundle.js') }}"></script>
    <script src="{{ URL::to('/assets/js/pages/charts/morris.js') }}"></script>

@endsection
