@extends('vendor.layouts.master',['navItem'=>'orders'])
@section('title', 'Orders')

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header order-header">
                        <h2 class="d-inline"><strong>Orders Overview</strong></h2>
                    </div>

                    {{-- stats section --}}
                    <div class="order-card-main">
                        <div class="custom-grid">
                            <div class="custom-grid-col">
                                <div class="card state_w1 order-card">
                                    <div class="body d-flex justify-content-between">
                                        <div>
                                            <h5>{{ $data->orders_count }}</h5>
                                            <span>Total</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @foreach ($counters as $key => $counter)
                                <div class="custom-grid-col">
                                    <div class="card state_w1 order-card">
                                        <div class="body d-flex justify-content-between">
                                            <div>
                                                <h5>{{ $counter }}</h5>
                                                <span>{{ $key }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    {{-- tabs section --}}
                    <div class="custom-tabs-order">
                        <ul class="nav nav-pills nav-fill flex-column flex-sm-row" id="OrderTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 active" id="all-order-tab" data-toggle="tab" href="#all-order"
                                    role="tab" aria-controls="home" aria-selected="true">All</a>
                            </li>

                            @foreach ($order_status as $status)
                                <li class="nav-item">
                                    <a class="render-data nav-link mb-sm-3" data-status-id="{{ $status->id }}"
                                        id="{{ $status->status }}" data-toggle="tab"
                                        href="#order_status_{{ $status->id }}" role="tab" aria-controls="home"
                                        aria-selected="true">{{ $status->status }}</a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="table-loader" style="display: none">
                                <div class="table-loader-inner">
                                    <img src="{{ URL::to('/assets/images/loader-data.gif') }}" alt="Loading">
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="all-order" role="tabpanel"
                                aria-labelledby="all-order-tab">
                                <div class="table-responsive">
                                    <table
                                        class="table table-bordered table-striped table-hover dataTable js-basic-example order-table"
                                        id="orders-listing">
                                        <thead>
                                            <tr>
                                                <th>Document</th>
                                                <th>Order No</th>
                                                <th>Order Date</th>
                                                <th>Update Date</th>
                                                <th>Paid With</th>
                                                <th>Total Bill</th>
                                                <th>Fullfilment</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)

                                                <tr>
                                                    <td>
                                                        <a href="{{ url('vendor/order-invoice/' . $order->id) }}"
                                                            target="_blank">Invoice</a>
                                                    </td>
                                                    <td>{{ $order->order_detail->order_no }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($order->order_detail->created_at)->format('d-m-Y') }}
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($order->order_detail->updated_at)->format('d-m-Y') }}
                                                    </td>
                                                    <td>{{ $order->order_detail->payment_method }}</td>
                                                    <td>{{ $order->package_bill }}</td>
                                                    <td class="text-center">
                                                        <span class="fullfilment"
                                                            style="background-color: {{ $order->fulfillment_detail->background_color }}">{{ $order->fulfillment_detail->name }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="status-bg"
                                                            style="background-color: {{ $order->order_status_detail->background_color }}"
                                                            data-toggle="modal" data-target="#exampleModal"
                                                            data-target-id={{ $order->order_status_detail->id }}
                                                            data-target-id2={{ $order->id }}>{{ $order->order_status_detail->status }}</button>
                                                    </td>
                                                    <td class="text-center">
                                                        {{-- view order --}}
                                                        <a href="{{ route('orders.show', $order->id) }}"
                                                            class="btn btn-primary btn-icon-only custom-order-veiw">
                                                            <span class=""><i class=" fa fa-eye"></i></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @foreach ($order_status as $statusKey)
                                <div class="tab-pane fade" id="order_status_{{ $statusKey->id }}" role="tabpanel"
                                    aria-labelledby="{{ $statusKey->status }}">
                                    <div class="custom-order-tab-content">

                                        <div class="table-responsive">
                                            <table
                                                class="table table-bordered table-striped table-hover dataTable js-basic-example order-table"
                                                id="order_status_dt{{ $statusKey->id }}">
                                                <thead>
                                                    <tr>
                                                        {{-- <th>Document</th> --}}
                                                        <th>Order No</th>
                                                        <th>Order Date</th>
                                                        <th>Update Date</th>
                                                        <th>Paid With</th>
                                                        <th>Total Bill</th>
                                                        <th>Fullfilment</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
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



    <!-- Order Status Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="changeStatus" action="" method="POST">
                @csrf

                <div class="modal-content">
                    <div class="modal-header custom-modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Order Status</h5>

                    </div>
                    <div class="modal-body">
                        <div class="status-body">
                            <p>Please select any one status</p>
                            <ul class="order-status-listing">

                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Confirm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>

    <script>
        var orderStatusData = @php echo json_encode($order_status); @endphp;
        console.log(orderStatusData);
        // return;
        // CHANGE PACKAGE-STATUS
        $(document).ready(function() {

            // DATATABLE DESC ORDER-LISTING
            $('.js-basic-example').dataTable({
                order: [
                    [0, 'desc']
                ]
            });

            // Open Modal of Status Update
            $("#exampleModal").on("show.bs.modal", function(e) {
                $(".order-status-listing").empty();

                var orderStatusId = $(e.relatedTarget).data('target-id');
                var orderId = $(e.relatedTarget).data('target-id2');
                var url = `/vendor/order-status/${orderId}`;
                $('#changeStatus').attr('action', url);

                var apiUrl = `/vendor/order/status/listing`;
                // console.log(orderId);
                // console.log(orderStatusData);
                // console.log(orderStatusData[0].status);

                $.ajax({
                    url: apiUrl,
                    type: "post",
                    data: {
                        _token: '{{ csrf_token() }}',
                        'order_id': orderId,
                    },
                    success: function(response) {

                        console.log(response);


                        response.data.forEach(function(orderStatusData) {
                            var statusId = orderStatusData.id;
                            var status = orderStatusData.status;


                            if (statusId == orderStatusId) {
                                $(".order-status-listing").append(`
                                <li>
                                    <div class="custom-control custom-radio mb-3">
                                        <input type="radio" name="order_status_id" class="custom-control-input order-status-check" id="${statusId}" value="${statusId}" checked>
                                        <label class="custom-control-label" for="${statusId}"> ${status}</label>
                                    </div>
                                </li>
                            `);

                            } else {
                                $(".order-status-listing").append(`
                                <li>
                                    <div class="custom-control custom-radio mb-3">
                                        <input type="radio" name="order_status_id" class="custom-control-input order-status-check" id="${statusId}" value="${statusId}" >
                                        <label class="custom-control-label" for="${statusId}"> ${status}</label>
                                    </div>
                                </li>
                            `);
                            }

                        });
                    }
                })




            });


            $(".status-bg").click(function(e) {
                e.preventDefault();
                var clicked_status = $(this).attr("data-target-id");
                $(".order-status-check").each(function(index) {

                    var statusId = $(this).val();


                    if (clicked_status == statusId) {
                        $(this).prop('checked', true);
                    }
                });

            });
        });


        $(".render-data").click(function() {

            $(".table-loader").show();
            var orderStatus = $(this).attr('href');
            var orderStatusId = $(this).attr('data-status-id');
            var url = `/vendor/order-status`;

            var table = $('#order_status_dt' + orderStatusId).DataTable();
            table.clear();

            $.ajax({
                url: url,
                type: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    'orderStatusId': orderStatusId,
                },
                success: function(data) {
                    $(".table-loader").hide();

                    var table;
                    table = $('#order_status_dt' + orderStatusId).DataTable();
                    if (data != '') {
                        $.each(data.data, function(key, value) {

                            //  var date = moment(value.order_detail.created_at).format("DD-MM-YYYY");
                            table.row.add([value.order_detail.order_no,
                                moment(value.order_detail.created_at).format(
                                    "DD-MM-YYYY"),
                                moment(value.order_detail.updated_at).format(
                                    "DD-MM-YYYY"),
                                value.order_detail.payment_method,
                                value.order_detail.packages_bill,
                                `<td class="text-center">
               <span class="fullfilment" style="background-color: ${value.fulfillment_detail.background_color}">${value.fulfillment_detail.name}</span>
               </td>`,

                                `<a href="/vendor/orders/${value.id}" class="btn btn-primary btn-icon-only custom-order-veiw">
                   <span class=""><i class="fa fa-eye"></i></span>
               </a>`
                            ]);
                        });
                    } else {
                        $('#order_status_dt' + orderStatusId).html('<h3>No Orders are available</h3>');
                    }
                    table.draw();
                }
            }).done(function() {
                // this part will run when we send and return successfully
                console.log("Success.");
            }).fail(function() {
                // this part will run when an error occurres
                console.log("An error has occurred.");
            })
        });
    </script>
@endsection
