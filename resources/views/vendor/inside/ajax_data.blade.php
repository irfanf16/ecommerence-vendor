{{-- Data Table Row --}}
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card border">
            <div class="card-header text-center">
                <h3 class="mb-0">Most Viewed Product</h3>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table id="example-datatable" class="table table-hover dataTable js-basic-example">
                        <thead>
                        <tr>
                            {{-- <th width="5%">SKU.</th> --}}
                            <th width="10%">Image</th>
                            <th>Product</th>
                            <th>Product Sku</th>
                            <th>Price</th>
                            <th>Special</th>
                            <th>Quantity</th>
                            {{--                                    <th>Availability</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @php $count = 1; @endphp
                        @foreach ($products as $product)
                            <tr>
                                <td style=width:10%;">
                                    @if ($product->primary_image)
                                        <img
                                            src="{{ config('app.url') }}storage/product/images/sm/{{ $product->primary_image }}"
                                            alt="" class="w-100 rounded img-bdr-primary">
                                    @else
                                        <img src="{{ URL::to('/vendor/images/default/product.svg') }}" alt=""
                                             class="w-100 rounded img-bdr-primary">
                                    @endif
                                </td>
                                <td style="width:40%">
                                    {{ \Illuminate\Support\Str::limit($product->name, $limit = 70, $end = '...') }}
                                    <br>
                                </td>
                                <td>{{ $variant->seller_sku }}</td>
                                <td>{{ $variant->price }}</td>
                                <td>{{ $variant->special_price }}</td>
                                <td>{{ $variant->quantity }}</td>

                                @php $count++; @endphp
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
