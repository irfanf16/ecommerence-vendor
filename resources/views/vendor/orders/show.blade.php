@extends('vendor.layouts.master',['navItem'=>'orders'])
@section('title', 'Orders')
@section('content')
    <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <div class="container-fluid" id="invoice">
        <div class="order-detail-main">
            <div class="order-heading">
                <h2 class="d-inline">Order Detail for Order {{ $order->order_detail->order_no }}</h2>
                {{-- <h2 class="d-inline float-right pr-4">
                    <a href="#" onclick="generatePDF()" class="text-white" id="export-link">
                        <i class="fa fa-download" aria-hidden="true"></i>
                        Export
                    </a>
                </h2> --}}
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="order-widget">

                            <div class="row">
                                <div class="col-md-4">
                                    <h2>Customer Information</h2>
                                    <div class="order-widget-inner">
                                        <ul>
                                            <li>
                                                <span class="heading">Date</span>
                                                <p class="order-content">
                                                    {{ \Carbon\Carbon::parse($order->order_detail->created_at)->format('d-m-Y') }}
                                                </p>
                                            </li>
                                            <li>
                                                <span class="heading">Customer</span>
                                                <p class="order-content">{{ $order->order_detail->user->name }}</p>
                                            </li>
                                            <li>
                                                <span class="heading">Contact Number</span>
                                                <p class="order-content">{{ $order->order_detail->user->mobile }}</p>
                                            </li>
                                            <li>
                                                <span class="heading">Payment Method</span>
                                                <p class="order-content">{{ $order->order_detail->payment_method }}</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="address-widget">
                                        <h2>Billing Address</h2>
                                        <div class="shiping-address">
                                            <ul>
                                                <li>{{ $order->order_detail->billing_address->user_address }}</li>
                                                <li>{{ $order->order_detail->billing_address->city_detail->name }}</li>
                                                <li>{{ $order->order_detail->billing_address->country_detail->name }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="address-widget">
                                        <h2>Shipping Address</h2>
                                        <div class="shiping-address">
                                            <ul>
                                                <li>{{ $order->order_detail->shipping_address->user_address }}</li>
                                                <li>{{ $order->order_detail->shipping_address->city_detail->name }}</li>
                                                <li>{{ $order->order_detail->shipping_address->country_detail->name }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="order-widget">
                            <h2>Billing Information</h2>
                            <div class="order-widget-inner order-list-count remove-bg">
                                <ul>
                                    <li>
                                        <span class="heading">Subtotal</span>
                                        <p class="order-content">{{ $order->package_bill }}</p>
                                    </li>
                                    <li>
                                        <span class="heading">Shipping Fee</span>
                                        <p class="order-content">{{ $order->fulfillment_charges }}</p>
                                    </li>
                                    <li>
                                        <span class="heading">Seller Discount Total</span>
                                        <p class="order-content">{{ $order->order_detail->discount }}</p>
                                    </li>
                                    <li>
                                        <span class="heading">Grand Total</span>
                                        <p class="order-content">
                                            {{ $order->package_bill + $order->fulfillment_charges - $order->order_detail->discount }}
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-6">
                    <div class="card">
                        <div class="order-widget">
                            <h2>Billing Information</h2>
                            <div class="order-widget-inner order-list-count">
                                <ul>
                                    <li>
                                        <span class="heading">Subtotal</span>
                                        <p class="order-content">{{ $order->package_bill }}</p>
                                    </li>
                                    <li>
                                        <span class="heading">Shipping Fee</span>
                                        <p class="order-content">{{ $order->fulfillment_charges }}</p>
                                    </li>
                                    <li>
                                        <span class="heading">Seller Discount Total</span>
                                        <p class="order-content">{{ $order->order_detail->discount }}</p>
                                    </li>
                                    <li>
                                        <span class="heading">Grand Total</span>
                                        <p class="order-content">
                                            {{ $order->package_bill + $order->fulfillment_charges - $order->order_detail->discount }}
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="order-widget">
                            <h2>Transaction Information</h2>
                            <div class="order-widget-inner order-list-count">
                                <ul>
                                    <li>
                                        <span class="heading">Shipping Fee</span>
                                        <p class="order-content">{{ $order->fulfillment_charges }}</p>
                                    </li>
                                    <li>
                                        <span class="heading">Item Price Credit </span>
                                        <p class="order-content">799.00</p>
                                    </li>
                                    <li>
                                        <span class="heading">Payment Fee</span>
                                        <p class="order-content">9.03</p>
                                    </li>
                                    <li>
                                        <span class="heading">Commission</span>
                                        <p class="order-content">-116.47</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="order-product-listing">
                        <div class="table-responsive">
                            <table class="order-table">
                                <thead>
                                    <tr>
                                        <th>Seller SKU</th>
                                        <th>Image</th>
                                        <th class="product-title">Product</th>
                                        <th class="variant-detail">Variant Details</th>
                                        <th>Unit Price</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th class="text-center">Action</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    {{-- {{dd($order)}} --}}
                                    @foreach ($order->package_items as $item)

                                        <tr>
                                            <td>{{ $item->variant_detail->seller_sku }}</td>
                                            <td>
                                                <div class="product-image">
                                                    <img src="{{ config('app.url') }}storage/product/images/sm/{{ $item->product_detail->primary_image }}"
                                                        alt="Product-Image" class="w-100 rounded img-bdr-primary">
                                                </div>
                                            </td>
                                            <td>{{ $item->product_detail->name }}</td>
                                            <td class="variant-detail-list">
                                                @foreach ($item->variant_detail->variant_attributes as $variant)
                                                    <div class="variant-detail-list">
                                                        <ul>
                                                            <li>
                                                                <span>{{ $variant->attribute_detail->title }}</span>
                                                                <span
                                                                    style='background-color:  {{ $variant->attribute_detail->title == 'Color' ? $variant->key_detail->name : '' }}'
                                                                    class='{{ $variant->attribute_detail->title == 'Color' ? 'color-height' : '' }}'>
                                                                    {{ $variant->attribute_detail->title != 'Color' ? $variant->key_detail->name : '' }}
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                @endforeach
                                            </td>
                                            {{-- <td class="variant-detail-list">
                                                @foreach ($item->product_detail->first_variant->variant_attributes as $variant)
                                                    <div class="variant-detail-list">
                                                        <ul>
                                                            <li>
                                                                <span>{{ $variant->attribute_detail->title }}</span>
                                                                <span
                                                                    style='background-color:  {{ $variant->attribute_detail->title == 'Color' ? $variant->key_detail->name : '' }}'
                                                                    class='{{ $variant->attribute_detail->title == 'Color' ? 'color-height' : '' }}'>
                                                                    {{ $variant->attribute_detail->title != 'Color' ? $variant->key_detail->name : '' }}
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                @endforeach
                                            </td> --}}
                                            <td>
                                                {{ $item->price / $item->quantity }}
                                            </td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-primary btn-icon-only custom-order-veiw">
                                                    <span class=""><i class=" fa fa-eye"></i></span>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="history-table">
                        <div class="history-heading">
                            <h2>Order Status History</h2>
                        </div>
                        <div class="order-product-listing">
                            <div class="table-responsive">
                                <table class="order-table">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        {{-- {{dd($order->package_histories)}} --}}
                                        @foreach ($order->package_histories as $package_history)

                                            <tr>
                                                <td>{{ $order->order_detail->order_no }}</td>
                                                <td>
                                                    <div class="status-bg"
                                                        style="background-color: {{ $package_history->package_status_detail->background_color }}; cursor: none;">
                                                        {{ $package_history->package_status_detail->status }}
                                                    </div>
                                                </td>
                                                <td>{{ date('d-M-y', strtotime($package_history->created_at)) }}
                                                </td>
                                                <td>{{ date('H:i', strtotime($package_history->created_at)) }}
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

    </div>
    <script>
        // {{-- GENERATING ORDER INVOICE --}}
        function generatePDF() {
            $('#export-link').attr("hidden", true);
            // $('#export-link').hide();
            const element = document.getElementById('invoice');
            // alert(element);
            html2pdf()
                .from(element)
                .save();
            // $('#export-link').attr("hidden", false);
        }
    </script>
@endsection
