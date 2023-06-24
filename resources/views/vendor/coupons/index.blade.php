@extends('vendor.layouts.master', ['navItem' => 'coupons'])
@section('title', 'All Coupons ')

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            {{-- Total Coupons --}}
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Total</h5>
                                <h2>{{ $coupons_count }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ url('vendor/images/icons/product/newproduct.svg') }}"
                                    class="rounded w-100 stats-icons" alt="Total Coupons">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Active Coupons --}}
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Active</h5>
                                <h2>{{ $active_coupons }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ url('vendor/images/icons/product/active-product.svg') }}"
                                    class="rounded w-100 stats-icons" alt="Active Coupons">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Inactive Coupons --}}
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Inactive</h5>
                                <h2>{{ $inactive_coupons }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ url('vendor/images/icons/product/inactive-product.svg') }}"
                                    class="rounded w-100 stats-icons" alt="Inactive Coupons">
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            {{-- Expired Coupons --}}
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Expired</h5>
                                <h2>{{ $expired_coupons }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ url('vendor/images/icons/product/featured-product.svg') }}"
                                    class="rounded w-100 stats-icons" alt="Expired Coupons">
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Data Table Row --}}
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card border">
                    <div class="card-header border-0">
                        <h6>
                            <strong>Coupons</strong>
                            <a href="{{ URL::to('/vendor/coupons/create') }}" title="Go to Add New Coupon Page"
                                class="btn btn-primary float-right">Add Coupon</a>
                        </h6>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table id="example-datatable" class="table table-hover dataTable js-basic-example">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Code</th>
                                        <th>Applied To</th>
                                        <th>Discount</th>
                                        <th>Qty</th>
                                        <th>Remaining</th>
                                        <th>Coupon</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coupons as $coupon)
                                        <tr class="text-capitalize">
                                            <td>{{ $coupon->title }}</td>
                                            <td>{{ $coupon->code }}</td>
                                            <td>{{ $coupon->apply_to }}</td>
                                            <td>{{ $coupon->discount_type == 'percent' ? "$coupon->discount_value %" : "QAR $coupon->discount_value" }}
                                            </td>
                                            <td>{{ $coupon->quantity }}</td>
                                            <td>{{ $coupon->remaining_coupons }}</td>
                                            <td>
                                                <select name="status" id="status" class="sat">
                                                    <option disabled>select status</option>
                                                    <option value="1"
                                                        {{ $coupon->status == 'enable' ? 'selected' : '' }}>Enable
                                                    </option>
                                                    <option value="2"
                                                        {{ $coupon->status == 'disable' ? 'selected' : '' }}>Disable
                                                    </option>
                                                </select>
                                                <input type="hidden" value="{{ $coupon->id }}">
                                            </td>
                                            <td>
                                                <a href='{{ URL::to("/vendor/coupons/$coupon->id/edit") }}'
                                                    title="Edit This Coupon" class="btn btn-primary btn-sm float-right">
                                                    <span class="btn-inner-icon">
                                                        <i class="fa fa-edit text-white"></i>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customScripts')
    <script>
        $(document).ready(function() {

            // CHANGE COUPON-STATUS -- ENABLE/DISABLE
            $(".sat").change(function(e) {
                e.preventDefault();
                var status = $(this).val();
                var couponId = $(this).next().val();

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $.ajax({
                    type: "POST",
                    url: "/vendor/coupon/update-status",
                    data: {
                        coupon_id: couponId,
                        status: status
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            console.log(response);
                            return;
                        }
                        console.log(response);
                        return;
                    },
                });
            });

        });
    </script>

    @if (Session::has('response'))
        {{ $response = Session::get('response')['action'] }}
        {{ $message = Session::get('response')['message'] }}

        <script>
            $(document).ready(function() {
                let response = "<?php echo $response; ?>";
                let message = "<?php echo $message; ?>";
                sweetAlert(response, message);
                $('#clickyes').click(function(e) {
                    e.preventDefault();
                    alert("element");
                    var element = $('#invoice').html();
                    alert(element);

                });
            });
        </script>
    @endif
@endsection
