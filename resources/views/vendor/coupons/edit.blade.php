@extends('vendor.layouts.master',['navItem'=>'coupons'])
@section('title', 'Edit This Coupon')

@section('content')
    <style>
        .dynamic-table {
            width: 100%;
            overflow-y: hidden;
            max-width: 1000px;
            overflow-x: auto;
        }

        .dynamic-table th,
        .dynamic-table td {
            white-space: nowrap;
            min-width: 150px;
        }

        .dynamic-table .dataTables_wrapper {
            width: 100%;
            margin: 0 auto;
        }

        .table-hover tbody tr:hover {
            background-color: #fff !important;
        }

        .delete-action {
            text-align: center;
        }

        .delete-action i {
            font-size: 24px;
            color: red;
            margin-top: 2px;
        }

        .dataTables_scroll div.dataTables_scrollBody table tbody tr td {
            vertical-align: top !important;
        }

        .table-listing {
            margin-top: 20px;
        }

        .select2-container-multi {
            padding: 3px;
        }

        .card-header h6 {
            margin: 0;
        }

        .add-row {
            display: inline-block;
            width: 100%;
            text-align: left;
            margin-top: 10px;
        }

        .card .table-listing {
            margin-top: 0;
        }

        .custom-padding-brand {
            padding-left: 4px;
        }

        #multiple-image {
            margin-top: 20px;
        }

        .delete-image i {
            font-size: 24px;
            color: red;
            margin-top: 5px;
            margin-left: 10px;
        }

        .image-info {
            margin-top: 20px;
            margin-right: 20px;
            padding: 10px;
            background-color: #efefef73;
            border-radius: 10px;
        }

        .counter-text {
            color: #c3c3c3;
            font-size: 10px;
            font-weight: 600;
        }

    </style>



    <div class="container-fluid">

        {{-- Error Messages - Alerts --}}
        @if (Session::has('errors'))
            @php $errors = Session::get('errors'); @endphp
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <ul>
                    @foreach ($errors as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- @if (!$has_store)
            <div class="custom-notification warning card mx-4">
                <div class="notification-content">
                    <h2>Store Information Missing!</h2>
                    <p>To add a product please fill your store information</p>
                </div>
            </div>
        @endif --}}

        <div class="row px-5">
            <div class="col-md-12">
                <div class="row">

                    {{-- form start --}}
                    <form method="POST" action="{{ URL::to('vendor/coupons') }}">
                        @csrf

                        {{-- ======================= Information Card  ===================== --}}
                        {{-- =============================================================== --}}
                        <div class="col-md-12 p-0">
                            <div class="card">
                                <div class="card-header p-2 very-light-gray-bg shadow-sm">
                                    <h6><b>Edit Coupon Information</b> </h6>
                                </div>

                                <div class="card-body">
                                    <div class="row">

                                        {{-- store_id --}}
                                        <input type="hidden" name="store_id" id="store_id">

                                        {{-- title --}}
                                        <div class="col-md-12 mb-4">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label class="control-label-lg" for="title">Title<sup
                                                            class="text-danger">*</sup></label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" name="title" id="title" class="form-control counter"
                                                        placeholder="" maxlength="100" value="{{ $coupon->title }}"
                                                        required>
                                                    <span class="float-right counter-text counter-val">0 / 100</span>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- description --}}
                                        <div class="col-md-12 mb-4">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label class="control-label-lg" for="name">Description<sup
                                                            class="text-danger">*</sup></label>
                                                </div>
                                                <div class="col-md-10">
                                                    <textarea type="text" name="description" id="description" cols="30"
                                                        rows="3" class="form-control counter" placeholder="" maxlength="255"
                                                        required>{{ $coupon->description }}</textarea>
                                                    <span class="float-right counter-text counter-val">0 / 255</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ====================== Coupon Apply To Card =================== --}}
                        {{-- =============================================================== --}}
                        <div class="col-md-12 p-0">
                            <div class="card">
                                <div class="card-header p-2 very-light-gray-bg shadow-sm">
                                    <h6><b>Edit Coupon Type</b></h6>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <p class="text-danger mb-0"><b>Store:</b> It will be applied on all the product
                                            available in
                                            your store.
                                        </p>
                                        <p class="text-danger"><b>SKU:</b> It will be applied to the specific products
                                            from
                                            your store.
                                        </p>
                                    </div>
                                    {{-- apply_to --}}
                                    <div class="col-md-12 mb-4">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="apply_to">Apply To<sup class="text-danger">*</sup></label>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <select class="form-control show-tick ms " name="apply_to"
                                                            id="apply_to" required>
                                                            <option selected disabled>Select Type</option>
                                                            <option value="1"
                                                                {{ $coupon->apply_to == 'store' ? 'selected' : '' }}>Store
                                                            </option>
                                                            <option value="2"
                                                                {{ $coupon->apply_to == 'sku' ? 'selected' : '' }}>SKU
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ===================== Coupon Settings Card ==================== --}}
                        {{-- =============================================================== --}}
                        <div class="col-md-12 p-0">
                            <div class="card">
                                <div class="card-header p-2 very-light-gray-bg shadow-sm">
                                    <h6><b>Edit Coupon Settings</b></h6>
                                </div>

                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="row">
                                            {{-- coupon code --}}
                                            <div class="col-md-6 mb-4">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="code" class="float-right">Coupon Code<sup
                                                                class="text-danger">*</sup></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="code" id="code"
                                                            value="{{ $coupon->code }}" class="form-control counter"
                                                            placeholder="" maxlength="10" required>
                                                        <span class="float-right counter-text counter-val">0 / 10</span>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- quantity --}}
                                            <div class="col-md-6 mb-4">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="quantity" class="float-right">Quantity<sup
                                                                class="text-danger">*</sup></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="number" name="quantity" id="quantity"
                                                            class="form-control counter" placeholder="" min="0" required>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- discount_type --}}
                                            <div class="col-md-6 mb-4">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="discount_type" class="float-right">Discount Type<sup
                                                                class="text-danger float">*</sup></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select class="form-control show-tick ms " name="discount_type"
                                                            id="discount_type" required>
                                                            <option disabled>select discount type</option>
                                                            <option value="1">Percent</option>
                                                            <option value="2">Amount</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- discount_value --}}
                                            <div class="col-md-6 mb-4">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="discount_value" class="float-right">Discount
                                                            Value<sup class="text-danger float">*</sup></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="number" name="discount_value" id="discount_value"
                                                            class="form-control" min="0" required>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- minimum_order_value --}}
                                            <div class="col-md-6 mb-4">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="minimum_order_value" class="float-right">Min
                                                            Order
                                                            Value<sup class="text-danger float">*</sup></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="number" name="minimum_order_value"
                                                            id="minimum_order_value" class="form-control" min="0"
                                                            value="1" required>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- per_user_limit --}}
                                            <div class="col-md-6 mb-4">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="per_user_limit" class="float-right">Per User
                                                            Limit<sup class="text-danger float">*</sup></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="number" name="per_user_limit" id="per_user_limit"
                                                            value="1" class="form-control" min="0" required>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- start_at --}}
                                            <div class="col-md-6 mb-4">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="start_at" class="float-right">Start Date<sup
                                                                class="text-danger float">*</sup></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="date" name="start_at" id="start_at"
                                                            class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- expire_at --}}
                                            <div class="col-md-6 mb-4">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="expire_at" class="float-right">Expire Date<sup
                                                                class="text-danger float">*</sup></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="date" name="expire_at" id="expire_at"
                                                            class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- status --}}
                                            <div class="col-md-6 mb-4">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="status" class="float-right">Coupon Status<sup
                                                                class="text-danger float">*</sup></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select class="form-control show-tick ms " name="status"
                                                            id="apply_to" required>
                                                            <option disabled>select status</option>
                                                            <option value="1">Enable</option>
                                                            <option value="2">Disable</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <button id="sumbitBtn" type="submit" class="btn btn-primary float-right">Submit</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection

@section('customScripts')
    <script>
        $(document).ready(function() {

            // CHARACTERS COUNTER
            $(".counter").keyup(function(e) {
                var maxLength = $(this).attr('maxlength');
                var length = $(this).val().length;
                $(this).next().text(length + "/" + maxLength);
                if (length > maxLength) {
                    $("#sumbitBtn").attr('disabled', true);
                } else {
                    $("#sumbitBtn").attr('disabled', false);
                }
            });

        });


        // WARRANTY-TYPE VALIDATION
        $("#warranty_type").change(function(e) {
            e.preventDefault();
            if ($(this).val() == 1) {
                $("#warranty_period").attr('disabled', true);
            } else {
                $("#warranty_period").attr('disabled', false);
            }
        });
    </script>

@endsection
