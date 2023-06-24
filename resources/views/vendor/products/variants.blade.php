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
                                        <h5>{{$products_count }}</h5>
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
                                        <h5>{{$active_products }}</h5>
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
                                        <h5>{{$inactive_products }}</h5>
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
                                        <h5>{{$featured_products }}</h5>
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
                                <div class="card-header text-center">
                                    <h3 class="mb-0">SKU'S</h3>
                                </div>
                                <div class="card-header border-0">
                                    <h6>
                                        @if ($store_info)
                                            <a href="{{ URL::to('/vendor/products/variants') }}" title="Go to Variants Page"
                                               class="btn btn-primary  float-right rounded-0 rounded-right " style="">
                                                SKU's</a>
                                            <a href="{{ URL::to('/vendor/products') }}" title="Go to Variants Page"
                                               class="btn btn-default  float-right rounded-0 rounded-left"
                                               style="border: 1px solid lightgray">
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
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="dataTables_length"><label>Show
                                                        <select id="variants_datatable_length"
                                                                class="form-control form-control-sm">
                                                            <option selected value="10">10</option>
                                                            <option value="25">25</option>
                                                            <option value="50">50</option>
                                                            <option value="100">100</option>
                                                        </select> entries</label></div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div id="example-datatable_filter" class="dataTables_filter"><label>
                                                        Search:<input id="variantsSearch" value="" type="search"
                                                                      class="form-control form-control-sm"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table id="DataTables_Table_0"
                                                       class="table table-bordered table-striped table-hover dataTable  order-table"
                                                       role="grid"
                                                       aria-describedby="DataTables_Table_0_info">
                                                    <thead>
                                                    <tr role="row">
                                                        {{--                                            <th width="5%">SKU.</th>--}}
                                                        <th width="10%">Image</th>
                                                        <th>Product</th>
                                                        <th>Product SKU</th>
                                                        <th>Price</th>
                                                        <th>Special</th>
                                                        <th>Quantity</th>
                                                        <th width="5%">Availability</th>
                                                        <th width="10%">Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="variantsList">

                                                    </tbody>
                                                </table>
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
            var page_id = 1
            getVariantsList(page_id);
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
