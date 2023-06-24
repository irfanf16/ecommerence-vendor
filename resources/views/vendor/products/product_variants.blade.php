<!-- Modal -->


                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Variants of
                        {{ $product->name }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table style="width: 100%;">
                        <thead>
                        <th>Variant Image</th>
                        <th>Product Sku</th>
                        <th>Price</th>
                        <th>Special</th>
                        <th>Quantity</th>
                        <th>Availability</th>
                        <th>Action</th>
                        </thead>
                        <tbody>
                        @php
                            $variant_count = count($product->variants);
                            // dd($variant_count);
                        @endphp
                        @foreach ($product->variants as $variant)
                            <tr>
                                <td>
                                    @if ($variant->image)
                                        <img
                                            src="{{ config('app.url') }}storage/product/variant/image/lg/{{ $variant->image }}"
                                            style="height: 40px;" alt="">
                                    @endif
                                </td>
                                <td>{{ $variant->seller_sku }}</td>
                                <td>{{ $variant->price }}</td>
                                <td>{{ $variant->special_price }}</td>
                                <td>{{ $variant->quantity }}</td>
                                <td>

                                    @if (1 == 1)
                                        <span
                                            class="text-success text-uppercase font-weight-bold">
                                                                            Yes
                                                                        </span>
                                    @else
                                        <span
                                            class="badge badge-lg badge-primary text-capitalize font-weight-bold">No
                                                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @can('products.manage_products', 'update')
                                        <a href="{{ URL::to("vendor/products/$variant->id/edit") }}?variant=true"
                                           title="Edit This Variant"
                                           class="btn btn-primary btn-sm">
                                                                            <span class="btn-inner-icon">
                                                                                <i class="fa fa-edit text-white"></i>
                                                                            </span>
                                        </a>
                                    @endcan
                                    @if ($variant_count > 1)
                                        @can('products.manage_products', 'delete')
                                            <form
                                                action='{{ URL::to("vendor/products/variant/$variant->id") }}'
                                                method="POST"
                                                class="d-inline variant-delete-btn ">
                                                @csrf
                                                {{--                                                                                @method('DELETE')--}}
                                                <button type="button"
                                                        class="btn btn-danger btn-sm archive-btn"
                                                        title="Delete This Product Variant">
                                                                                    <span class="btn-inner-icon">
                                                                                        <i class="fa fa-trash text-white"></i>
                                                                                    </span>
                                                </button>
                                            </form>
                                        @endcan
                                    @endif

                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <a href="{{ url('/') }}/vendor/products/{{ $product->variants[0]->id }}/add-variant"
                       type="button" class="btn btn-primary">
                        Add Variant
                    </a>
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Close
                    </button>
                    {{-- <button type="button" class="btn btn-primary">Save
                        changes</button> --}}
                </div>


