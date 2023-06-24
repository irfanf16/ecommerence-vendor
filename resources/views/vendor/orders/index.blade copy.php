@extends('vendor.layouts.master',['navItem'=>'orders'])
@section('title', 'Orders')
@section('content')




{{-- Orders --}}

<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header order-header">
                    <h2 class="d-inline"><strong>Orders Overview</strong></h2>
                </div>
                <div class="order-card-main">
                    <div class="custom-grid">
                        <div class="custom-grid-col">
                            <div class="card state_w1 order-card">
                                <div class="body d-flex justify-content-between">
                                    <div>
                                        <h5>2,365</h5>
                                        <span>All</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach ($order_status as $status)
                        <div class="custom-grid-col">
                            <div class="card state_w1 order-card">
                                <div class="body d-flex justify-content-between">
                                    <div>
                                        <h5>165</h5>
                                        <span>{{$status->status}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="custom-tabs-order">
                    <ul class="nav nav-pills nav-fill flex-column flex-sm-row" id="OrderTab" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 active" id="all-order-tab" data-toggle="tab" href="#all-order" role="tab" aria-controls="home" aria-selected="true">All</a>
                        </li>
                        @foreach ($order_status as $status)
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3" data-status-id="{{$status->id}}" id="{{$status->status}}" data-toggle="tab" href="#order_status_{{$status->id}}" role="tab" aria-controls="home" aria-selected="true">{{$status->status}}</a>
                        </li>
                        @endforeach

                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="all-order" role="tabpanel" aria-labelledby="all-order-tab">

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-basic-example order-table">
                                    <thead>
                                        <tr>
                                            <th>Document</th>
                                            <th>Order No</th>
                                            <th>Order Date</th>
                                            <th>Update Date</th>
                                            <th>Paid With</th>
                                            <th>Retail Price</th>
                                            <th>Fullfilment</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($orders as $order)

                                        <tr>
                                            <td><a href="#">Invoice</a></td>
                                            <td>{{$order->order_id}}</td>
                                            <td>{{ \Carbon\Carbon::parse($order->order_detail->created_at)->format('d-m-Y')}}</td>
                                            <td>{{ \Carbon\Carbon::parse($order->order_detail->updated_at)->format('d-m-Y')}}</td>
                                            <td>{{$order->order_detail->payment_method}}</td>
                                            <td>{{$order->order_detail->invoice_bill}}</td>
                                            <td class="text-center">
                                                <span class="fullfilment" style="background-color: {{$order->fulfillment->background_color}}">{{$order->fulfillment->name}}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="status-orange" data-toggle="modal" data-target="#exampleModal">{{$order->order_status->status}}</span>
                                            </td>
                                            <td class="text-center">
                                                {{-- view order --}}
                                                <a href="{{ route('orders.show', 1) }}" class="btn btn-primary btn-icon-only custom-order-veiw">
                                                    <span class=""><i class="fa fa-eye"></i></span>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>



                        @foreach ($order_status as $statusKey)
                        <div class="tab-pane fade" id="order_status_{{$statusKey->id}}" role="tabpanel" aria-labelledby="{{$statusKey->status}}">
                            <div class="custom-order-tab-content">

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example order-table" id="order_status_dt{{$statusKey->id}}">
                                        <thead>
                                            <tr>
                                                <th>Document</th>
                                                <th>Order No</th>
                                                <th>Order Date</th>
                                                <th>Update Date</th>
                                                <th>Paid With</th>
                                                <th>Retail Price</th>
                                                <th>Fullfilment</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody class="new-table">




                                        </tbody>
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
@section('customScripts')
<script>
    $(".nav-link").click(function() {
        var orderStatus = $(this).attr('href');
        console.log(orderStatus);
        var orderStatusId = $(this).attr('data-status-id');
        var url = '/vendor/order-status';
        console.log(orderStatusId);
        $.ajax({
            url: url,
            type: "post",
            data: {
                _token: '{{ csrf_token() }}',
                'orderStatus': orderStatus,
                'order_status_id': orderStatusId,
            },
            success: function(response) {
                console.log(response.data, "successfully send");
                $('.new-table').empty();
                // var table = $('#order-status-table').DataTable();
                // table
                // .column( 0 )
                // .response.data()
                // .each( function ( value, index ) {
                //     console.log( 'Data in index: '+index+' is: '+value );
                // } );
                $.each(response.data, function(key, value) {
                    console.log("value", value.invoice_bill)
                    $('.new-table').append(`<tr role="row" class="even">
                        <td><a href="#">Invoice</a></td>
                        <td>${value.order_id}</td>
                        <td>${value.created_at}</td>
                        <td>${value.updated_at}</td>
                        <td>${value.payment_method}</td>
                        <td>${value.invoice_bill}</td>
                        <td class="text-center">
                            <span class="fullfilment" style="background-color: ${value.fulfillment.background_color}">${value.fulfillment.background_color}</span>
                        </td>
                        <td class="text-center">
                            <span class="status-orange" data-toggle="modal" data-target="#exampleModal">${value.order_status.status}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('orders.show', 1) }}" class="btn btn-primary btn-icon-only custom-order-veiw">
                                <span class=""><i class="fa fa-eye"></i></span>
                            </a>
                        </td>
                    </tr>`);
                })

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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header custom-modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Status</h5>

            </div>
            <div class="modal-body">
                <div class="status-body">
                    <p>Please select any one status</p>
                    <ul>
                        @foreach ($order_status as $status)

                        <li>
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" name="order-status" class="custom-control-input" id="{{$status->id}}">
                                <label class="custom-control-label" for="{{$status->id}}"> {{$status->status}}</label>
                            </div>
                        </li>
                        @endforeach

                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLose</button>
                <button type="button" class="btn btn-success">Confirm</button>
            </div>
        </div>
    </div>
</div>
@endsection