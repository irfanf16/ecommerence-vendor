{{-- topbar --}}

{{-- FOR TESTING --}}
@php

$user = session()->get('user');
$user_id = $user->id;
session()->put('user_id', $user_id);

@endphp
{{-- END TESTING --}}

<nav class="navbar custom-navbar navbar-expand-lg py-2">
    <div class="container-fluid px-0">
        <a href="javascript:void(0);" class="menu_toggle"><i class="fa fa-align-left"></i></a>
        <a href="{{ URL::to('/vendor/dashboard') }}" class="navbar-brand h-25 w-25"><img
                src="{{ URL::to('favicon.png') }}" alt="storak" /> <strong>Storak</strong></a>
        <div id="navbar_main">
            <ul class="navbar-nav mr-auto hidden-xs">
                <li class="nav-item page-header">
                    <!--<ul class="breadcrumb">-->
                    <!--    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>-->
                    <!--    <li class="breadcrumb-item active">Vendor Dashboard</li>-->
                    <!--</ul>-->
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                {{-- search bar --}}
                {{-- <li class="nav-item hidden-xs">
                    <form class="form-inline main_search">
                        <input class="form-control form-control-sm mr-sm-2" type="search" placeholder="Search..."
                            aria-label="Search">
                    </form>
                </li> --}}
                {{-- <li class="nav-item"><a class="nav-link nav-link-icon" href="javascript:void(0);"><i
                            class="fa fa-cogs"></i></a></li> --}}
                {{-- notifications --}}
                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-icon notification-call" href="javascript:void(0);"
                        id="navbar_1_dropdown_2" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        @if (session()->has('notifications'))
                            <span class="notification-dot">{{ session()->get('notifications') }}</span>
                        @else
                            <span class="notification-dot d-none">{{ session()->get('notifications') }}</span>
                        @endif

                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-xl py-0">
                        <div class="py-3 px-3">
                            <h5 class="heading h6 mb-0">
                                Notifications
                                <span
                                    class="badge badge-pill badge-primary text-uppercase float-right">{{ session()->get('notifications') }}</span>
                            </h5>
                        </div>
                        <div class="loader-notification">
                            <div class="table-loader-inner">
                                <img src="{{ URL::to('/assets/images/loader-data.gif') }}" alt="Loading">
                            </div>
                        </div>
                        <div class="list-group custom-scroll">

                        </div>
                        <div class="py-3 text-center">
                            <a href="{{ url('/vendor/notifications/all') }}" class="link link-sm link--style-3">View
                                all
                                notifications</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-icon" href="javascript:void(0);" id="navbar_1_dropdown_3" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                            class="fa fa-user"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @php
                            $user = Session::get('user');
                        @endphp
                        <h6 class="dropdown-header text-capitalize">{{ $user->name }}</h6>
                        <a class="dropdown-item" href="{{ url('/vendor/profile/edit') }}">
                            <i class="fa fa-user text-light text-capitalize"></i>Profile
                        </a>
                        <a class="dropdown-item" href="javascript:void(0);">
                            <i class="fa fa-cog text-light text-capitalize"></i>Account Settings
                        </a>
                        <a class="dropdown-item" href="{{ url('/logout') }}">
                            <i class="fas fa-sign-out-alt text-light text-capitalize"></i>Logout
                        </a>

                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>


{{-- Notification pusher on order placing --}}
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var user_id = '<?php echo $user_id; ?>';
    var notifications = "<?php echo session()->get('notifications'); ?>";


    var pusher = new Pusher('32f2d1b0fec4ffd72f2f', {
        cluster: 'ap2'
    });

    var channel = pusher.subscribe('order-notifications');
    channel.bind('orders', function(data) {

        if (user_id == JSON.stringify(parseInt(data['vendor_id']))) {

            //AJAX CALL TO UPDATE SESSION OF NOTIFICATION COUNTER
            $.ajax({
                url: "/notifications/update_session/",
                type: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    'notifications': ++notifications,
                },
                success: function(data) {

                    console.log(data, "successfully send");
                    $('.notification-dot').show();
                    $('.notification-dot').text(data.notifications);
                    $('.badge-pill').text(data.notifications);



                }
            }).done(function() {
                console.log("Success.");
            }).fail(function() {
                console.log("An error has occurred.");
            }).always(function() {
                console.log("Complete.");
            });

        }
    });
</script>

<script>
    $(".notification-call").click(function() {

        $.ajax({
            url: "/vendor/notifications/recent",
            type: "get",

            data: {

            },
            success: function(data) {
                $(".loader-notification").hide();

                var notifications = data.notifications;
                var unreadCounter = data.unreadCounter;
                // $('.badge-pill').html(`${unreadCounter}`);

                $('.notification-dot').hide();

                $(".custom-scroll").empty();

                notifications.forEach(function(data) {
                    console.log(data.link);
                    $(".custom-scroll").append(`

                    <a href="/${data.link}" class="notification-status-change list-group-item list-group-item-action d-flex  ${data.status == 0 ? 'bg-lighter' : ''}">
                        <div class="list-group-img">
                            <img src="/assets/images/notification/${data.icon}.svg"/>
                        </div>
                        <div class="list-group-content">
                            <div class="list-group-heading">${data.message}</div>
                            <p class="text-sm">
                                ${moment(data.created_at).fromNow()}
                            </p>
                        </div>
                    </a>
                `);
                });
            }
        }).done(function() {
            // this part will run when we send and return successfully
            console.log("Success.");
        }).fail(function() {
            // this part will run when an error occurres
            console.log("An error has occurred.");
        }).always(function() {
            // this part will always run no matter what
            console.log("Complete.");
        });
    });

    $(document).on("click", ".notification-status-change", function() {
        $.ajax({
            url: "/vendor/notifications/status",
            type: "post",

            data: {

            },
            success: function(data) {

                console.log(data, "successfully send");

            }
        }).done(function() {
            console.log("Success.");
        }).fail(function() {
            console.log("An error has occurred.");
        }).always(function() {
            console.log("Complete.");
        });
    });
</script>
