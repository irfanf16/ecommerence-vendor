@extends('vendor.layouts.master',['navItem'=>'commissions'])
@section('title', 'commissions')

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header order-header">
                        <h2 class="d-inline"><strong>Commissions Overview</strong></h2>
                    </div>

                    {{-- stats section --}}

                    {{-- tabs section --}}
                    <div class="custom-tabs-order">
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
                                        class="table table-bordered table-striped table-hover dataTable js-basic-example "
                                    >
                                        <thead>
                                        <tr>
                                            <th>Order No</th>
                                            <th>Order Date</th>
                                            <th>Seller SKU</th>
                                            <th>Unit Price</th>
                                            <th>Storak Commission %</th>
                                            <th>Fees</th>
                                            <th>Seller Commission</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($orders as $order)

                                            @foreach($order->package_items as $items)
                                                <tr>

                                                    <td>{{ $order->order_detail->order_no }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($order->order_detail->created_at)->format('d-m-Y') }}</td>
                                                    <td>{{ $items->variant_detail->seller_sku }}</td>
                                                    <td>{{ $items->variant_detail->price }}</td>
                                                    <td>{{ $items->storak_commission_percentage }}</td>
                                                    <td>{{ $items->storak_commission }}</td>
                                                    <td>{{ $items->seller_commission }}</td>
                                                    <td class="text-center">
                                                        {{-- view order --}}
                                                        <a href="{{ route('orders.show', $order->id) }}"
                                                           class="btn btn-primary btn-icon-only custom-order-veiw">
                                                            <span class=""><i class=" fa fa-eye"></i></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
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
    </div>

@endsection
