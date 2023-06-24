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

        .close>span:not(.sr-only) {
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

        .close>span:hover {
            background-color: transparent !important;
        }
    </style>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header order-header">
                        <h2 class="d-inline"><strong>Products</strong></h2>
                    </div>
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


                    <div class="row clearfix order-card-main">
                        {{-- Total Products --}}
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card border-0">
                                <div class="body pb-1" style="background: #efefef">
                                    <div>
                                        <h5>{{ $products_count }}</h5>
                                        <span>Total</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Active Products --}}
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card border-0">
                                <div class="body pb-1" style="background: #efefef">
                                    <div>
                                        <h5>{{ $active_products }}</h5>
                                        <span>Active</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- InActive Products --}}
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card border-0">
                                <div class="body pb-1" style="background: #efefef">
                                    <div>
                                        <h5>{{ $inactive_products }}</h5>
                                        <span>Inactive</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Featured Products --}}
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card border-0">
                                <div class="body pb-1" style="background: #efefef">
                                    <div>
                                        <h5>{{ $featured_products }}</h5>
                                        <span>Featured</span>
                                    </div>
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
                                        @if ($store_info)
                                            @can('products.manage_products', 'create')
                                                <a href="{{ URL::to('/vendor/products/create') }}"
                                                    title="Go to Add New Product Page" class="btn btn-primary ">Add Product</a>
                                            @endcan
                                            <a href="{{ URL::to('/vendor/products/variants') }}" title="Go to Variants Page"
                                                class="btn btn-default  float-right rounded-0 rounded-right "
                                                style="border: 1px solid lightgray">
                                                SKU's</a>
                                            <a href="{{ URL::to('/vendor/products') }}" title="Go to Variants Page"
                                                class="btn btn-primary  float-right rounded-0 rounded-left"
                                                style=" color: white;">
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
                                    <div id="DataTables" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <div class="row mb-5 mt-5 page-block">
                                            <div class="col-sm-12 col-md-3">
                                                <label>Categories</label>
                                                <select id="category_id" name="category_id"
                                                        class="form-control filters_products">
                                                    <option value="">All</option>
                                                    @foreach($categories as $category)
                                                        <option @if(Session::get('category_id')==$category->id) selected
                                                                @endif value="{{$category->id}}">{{$category->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-12 col-md-3">
                                                <label>Sub Categories</label>
                                                <select id="subcategory_id" name="subcategory_id"
                                                        class="form-control filters_products">
                                                    <option value="">All</option>
                                                    @foreach($sub_categories as $category)
                                                        <option
                                                            @if(Session::get('subcategory_id')==$category->id) selected
                                                            @endif value="{{$category->id}}">{{$category->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-12 col-md-3">
                                                <label>Child Categories</label>
                                                <select id="childcategory_id" name="childcategory_id"
                                                        class="form-control filters_products">
                                                    <option value="">All</option>
                                                    @foreach($child_categories as $category)
                                                        <option
                                                            @if(Session::get('childcategory_id')==$category->id) selected
                                                            @endif value="{{$category->id}}">{{$category->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-12 col-md-3 mt-2">
                                                <label>Brands</label>
                                                <select id="brand_id" name="brand_id"
                                                        class="form-control filters_products">
                                                    <option value="">All</option>
                                                    @foreach($brands as $brand)
                                                        <option @if(Session::get('brand_id')==$brand->id) selected
                                                                @endif value="{{$brand->id}}">{{$brand->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-12 col-md-3 mt-4">
                                                <label>Status</label>
                                                <select id="status" name="status" class="form-control filters_products">
                                                    <option value="">All</option>
                                                    <option @if(Session::get('status')==1) selected @endif value="1">
                                                        Active
                                                    </option>
                                                    <option @if(Session::get('status')==2) selected @endif value="0">
                                                        In-Active
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-sm-12 col-md-3 mt-4">
                                                <label>Featured</label>
                                                <select id="featured" class="form-control filters_products">
                                                    <option value="">All</option>
                                                    <option @if(Session::get('featured')==1) selected @endif value="1">
                                                        Featured
                                                    </option>
                                                    <option @if(Session::get('featured')==2) selected @endif value="0">
                                                        Non-Featured
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-sm-12 col-md-3 mt-4">
                                                <label>Form:</label>
                                                <input id="from_date" value="{{Session::get('from_date')}}" type="date"
                                                       class="form-control filters_products">
                                            </div>
                                            <div class="col-sm-12 col-md-3 mt-4">
                                                <label>To:</label>
                                                <input id="to_date" value="{{Session::get('from_to')}}" type="date"
                                                       class="form-control filters_products">
                                            </div>
                                            <div class="col-sm-12 col-md-3 mt-4">
                                                <label>Arabic Translation</label>
                                                <select id="translation" class="form-control filters_products">
                                                    <option value="">All</option>
                                                    <option @if(Session::get('translation')==1) selected @endif value="1">
                                                        Translated
                                                    </option>
                                                    <option @if(Session::get('translation')==2) selected @endif value="0">
                                                        Pending
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="dataTables_length"><label>Show
                                                        <select id="products_datatable_length"
                                                            class="form-control form-control-sm">
                                                            <option
                                                                {{ Session::get('product_datatable_length') == 10 ? "selected" : "" }}  value="10">
                                                                10
                                                            </option>
                                                            <option
                                                                {{ Session::get('product_datatable_length') == 25 ? "selected" : "" }} value="25">
                                                                25
                                                            </option>
                                                            <option
                                                                {{ Session::get('product_datatable_length') == 50 ? "selected" : "" }} value="50">
                                                                50
                                                            </option>
                                                            <option
                                                                {{ Session::get('product_datatable_length') == 100 ? "selected" : "" }} value="100">
                                                                100
                                                            </option>
                                                        </select> entries</label></div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div id="example-datatable_filter" class="dataTables_filter"><label>
                                                        Search:<input id="productSearch" value="" type="search"
                                                            class="form-control form-control-sm"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="" style="position: relative;">
                                                    <div class="pre-loader" style="display: none">
                                                        <div class="loader-for-datatable" style=""></div>
                                                    </div>
                                                    <table id="DataTables_Table_0"
                                                           class="table table-bordered table-striped table-hover dataTable  order-table"
                                                           role="grid"
                                                           aria-describedby="DataTables_Table_0_info">
                                                        <thead>
                                                        <tr role="row">
                                                            {{--                                            <th width="5%">SKU.</th>--}}
                                                            <th width="10%">Image</th>
                                                            <th width="20%">Product</th>
                                                            <th width="20%">Translation</th>
                                                            <th width="5%">Featured</th>
                                                            <th width="5%">Active</th>
                                                            <th width="5%">Created_at</th>
                                                            <th width="10%">Show Variants</th>
                                                            <th width="10%">Actions</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="productsList">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row" id="paginationList">

                                        </div>
                                    </div>
                                </div>
                            </div>
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

    {{-- product variants model --}}
    {{--    product variants model --}}
    <div id="productVariantModels"></div>

@endsection

@section('customScripts')
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




    <script>
        $(document).ready(function() {
            var page_id = 1
        $(document).ready(function () {
            var page_id = 1;
            @if(Session::has('product_page_id'))
                page_id = '{{Session::get('product_page_id')}}'
            @endif
            getProductsList(page_id);
            $(document).on('change', '.filters_products', function () {
                getProductsList(1);
            })
            // confirm Delete
            $('body').on('click', '.archive-btn', function() {
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
    });
    </script>

@endsection
