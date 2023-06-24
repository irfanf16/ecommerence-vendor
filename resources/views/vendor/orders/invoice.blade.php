<div class="container-fluid" id="invoice">
    <div class="order-detail-main">
        <div class="order-heading">
            <h2>Order Detail for Order {{ $order->order_detail->order_no }}</h2>
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
                                            <p class="order-content">{{ $order->order_detail->user->mobile }}
                                            </p>
                                        </li>
                                        <li>
                                            <span class="heading">Payment Method</span>
                                            <p class="order-content">{{ $order->order_detail->payment_method }}
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="address-widget">
                                    <h2>Billing Address</h2>
                                    <div class="shiping-address">
                                        <ul>
                                            <li>{{ $order->order_detail->user->name }}</li>
                                            <li>{{ $order->order_detail->billing_address->user_address }}</li>
                                            <li>{{ $order->order_detail->billing_address->city_id }}</li>
                                            <li>{{ $order->order_detail->billing_address->country_id }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="address-widget">
                                    <h2>Shipping Address</h2>
                                    <div class="shiping-address">
                                        <ul>
                                            <li>{{ $order->order_detail->user->name }}</li>
                                            <li>{{ $order->order_detail->shipping_address->user_address }}</li>
                                            <li>{{ $order->order_detail->shipping_address->city_id }}</li>
                                            <li>{{ $order->order_detail->shipping_address->country_id }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
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
                                    <span class="heading">shipping fee</span>
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
                                        <th>Created At</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    {{-- {{dd($order->package_histories)}} --}}
                                    @foreach ($order->package_histories as $package_history)

                                        <tr>
                                            <td>{{ $order_detail->order_detail->order_no }}</td>
                                            <td>
                                                <div class="status-bg"
                                                    style="background-color: {{ $package_history->package_status_detail->background_color }}">
                                                    {{ $package_history->package_status_detail->status }}
                                                </div>
                                            </td>
                                            <td>{{ date('d-M-y : H:i', strtotime($package_history->created_at)) }}
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
