@extends('vendor.layouts.master', ['navItem' => 'products'])
@section('title', 'All Products ')

@section('content')
    <style>
        .modal-header .close {
            padding: 0px !important;
            margin: 0px !important;
        }

        button {
            outline: none !important;
        }

        .close > span:not(.sr-only) {
            background-color: transparent;
            line-height: 20px;
            height: 1.25rem;
            width: 1.25rem;
            border-radius: 50%;
            font-size: 1.8rem;
            color: black;
            display: block;
            transition: all 0.2s ease-in-out;
        }

        .close > span:hover {
            background-color: transparent !important;
        }

    </style>
    <div class="container-fluid">

        {{-- warning message row --}}
        @if (!$store_info)
            <div class="custom-notification danger card">
                <a href="{{ URL::to('/vendor/profile/edit') }}" title="Go To Profile Edit Page">
                    <div class="notification-content">
                        <h2>Store Information Missing!</h2>
                        <p>To add a product please fill your store information first!</p>
                    </div>
                </a>
            </div>
        @endif

        <div class="row clearfix">
            {{-- Total Products --}}
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Total</h5>
                                <h2>{{ $products_count }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ url('vendor/images/icons/product/newproduct.svg') }}"
                                     class="rounded w-100 stats-icons" alt="Total Products ">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Active Products --}}
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Active</h5>
                                <h2>{{ $active_products }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ url('vendor/images/icons/product/active-product.svg') }}"
                                     class="rounded w-100 stats-icons" alt="Active Products ">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- InActive Products --}}
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Inactive</h5>
                                <h2>{{ $inactive_products }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ url('vendor/images/icons/product/inactive-product.svg') }}"
                                     class="rounded w-100 stats-icons" alt="Inactive Products ">
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            {{-- Featured Products --}}
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Featured</h5>
                                <h2>{{ $featured_products }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ url('vendor/images/icons/product/featured-product.svg') }}"
                                     class="rounded w-100 stats-icons" alt="Featured Products ">
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
                    <div class="card-header text-center">
                        <h3 class="mb-0">Products</h3>
                    </div>

                    <div class="card-header border-0">
                        <h6>

                            @if ($store_info)
                                @can('products.manage_products', 'create')
                                    <a href="{{ URL::to('/vendor/products/create') }}"
                                       title="Go to Add New Product Page"
                                       class="btn btn-primary ">Add Product</a>
                                @endcan
                                <a href="{{ URL::to('/vendor/products/variants') }}" title="Go to Variants Page"
                                   class="btn btn-default  float-right rounded-0 rounded-right "
                                   style="border: 1px solid lightgray">
                                    SKU's</a>
                                <a href="{{ URL::to('/vendor/products') }}" title="Go to Variants Page"
                                   class="btn btn-primary  float-right rounded-0 rounded-left" style=" color: white;">
                                    Products</a>

                                {{-- <a href="{{ URL::to('/vendor/product/upload-csv') }}"
                                    title="Go to Product CSV File Upload Page" class="btn btn-success float-right mx-2">Add
                                    CSV
                                    File</a> --}}
                            @else
                                <a data-toggle="modal" data-target="#createStoreModal"
                                   title="Go to Add New Product Page"
                                   class="btn btn-primary float-left text-white">Add Product</a>
                                {{-- <a href="{{ URL::to('/vendor/product/upload-csv') }}"
                                    title="Go to Product CSV File Upload Page" class="btn btn-success float-right mx-2">Add
                                    CSV
                                    File</a> --}}
                            @endif

                        </h6>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table id="example-datatable" class="table table-hover dataTable js-basic-example">
                                <thead>
                                <tr>
                                    {{-- <th width="5%">SKU.</th> --}}
                                    <th width="10%">Image</th>
                                    <th>Product</th>
                                    <th>Show Variants</th>
                                    <th width="10%">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $count = 1; @endphp
                                @foreach ($products as $product)
                                    <tr>
                                        <td style="width:10%">
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
                                            {{-- <b>Category: </b>{{ $product->category->title }} <br>
                                            <b>Subcategory: </b>{{ $product->subcategory->title }} <br>
                                            <b>Childcategory: </b>{{ $product->childcategory->title }} <br>
                                            <b>Brand: </b>{{ $product->brand->name }} --}}
                                        </td>

                                        <td>
                                            <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#variantmodal{{ $product->id }}">
                                                Variants
                                            </button>
                                        </td>

                                        <td>
                                            {{-- link for edit blade form --}}
                                            {{-- href="{{ URL::to("vendor/products/$product->id/edit") }}" --}}
                                            @php
                                                $a_variant = $product->variants[0];
                                                $a_variant = $a_variant->id;
                                                // dd($a_variant);
                                            @endphp
                                            @can('products.manage_products', 'update')
                                                <a href="{{ url('/') }}/vendor/products/{{ $a_variant }}/edit?product=true"
                                                   title="Edit This Product" class="btn btn-primary btn-sm">
                                                        <span class="btn-inner-icon">
                                                            <i class="fa fa-edit text-white"></i>
                                                        </span>
                                                </a>
                                            @endcan
                                            {{-- {{ dd($a_variant) }} --}}
                                            {{-- <a href="#" title="Delete This Product" class="btn btn-danger btn-sm">
                                                    <span class="btn-inner-icon">
                                                        <i class="fa fa-trash text-white"></i>
                                                    </span>
                                                </a> --}}
                                            @can('products.manage_products', 'delete')
                                                <form action='{{ URL::to("vendor/products/$product->id") }}'
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm archive-btn"
                                                            title="Delete This Product "><span class="btn-inner-icon"><i
                                                                class="fa fa-trash text-white"></i></span></button>
                                                </form>
                                            @endcan
                                        </td>
                                        @php $count++; @endphp
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>


                            {{-- modals --}}

                            <!-- Modal -->
                            @foreach ($products as $product)
                                <div class="modal fade" id="variantmodal{{ $product->id }}" tabindex="-1"
                                     role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" style="max-width: 60%;" role="document">
                                        <div class="modal-content">
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

    {{-- CREATE-NEW-STORE-ALERT MODEL --}}
    <div class="modal fade" id="createStoreModal" tabindex="-1" role="dialog" aria-labelledby="createStoreModalTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h5 class="modal-title text-danger" id="createStoreModalTitle">Store Information Missing !!!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p>To add a product please fill your store information first. Click below button to go to edit
                        profile
                        screen.</p>
                    <a href="{{ URL::to('/vendor/profile/edit') }}" class="btn btn-primary text-white">Complete store
                        information here</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customScripts')
    @if (Session::has('response'))
        {{ $response = Session::get('response')['action'] }}
        {{ $message = Session::get('response')['message'] }}

        <script>
            $(document).ready(function () {
                let response = "<?php echo $response; ?>";
                let message = "<?php echo $message; ?>";
                sweetAlert(response, message);
                $('#clickyes').click(function (e) {
                    e.preventDefault();
                    alert("element");
                    var element = $('#invoice').html();
                    alert(element);

                });
            });
        </script>
    @endif




    <script>
        $(document).ready(function () {

            // confirm Delete
            $('body').on('click', '.archive-btn', function () {
                var form = $(this).parents('form');
                swal({
                    title: "Are you sure?",
                    text: "This Product will be moved to Archive",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("Product has been archived!", {
                                icon: "success",
                            });
                            form.submit();
                            // var count_variants = from.parants('table').find('.variant-delete-btn').length();
                            // if(count_variants >/ 1)


                        } else {
                            swal("Product is Safe!");
                        }
                    });
            });


            // Restrict last variant delete
            // var count_variants = $('.variant-delete-btn').length;
            // console.log()


        });
    </script>

@endsection
