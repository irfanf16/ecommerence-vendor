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
                        <h2 class="d-inline"><strong>Notifications</strong></h2>
                    </div>

{{--                    <div class="row clearfix order-card-main">--}}
{{--                        --}}{{-- Total Products --}}
{{--                        <div class="col-lg-3 col-md-6 col-sm-12">--}}
{{--                            <div class="card border-0">--}}
{{--                                <div class="body pb-1" style="background: #efefef">--}}
{{--                                    <div>--}}
{{--                                        <h5>{{$products_count }}</h5>--}}
{{--                                        <span>Total</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        --}}{{-- Active Products --}}
{{--                        <div class="col-lg-3 col-md-6 col-sm-12">--}}
{{--                            <div class="card border-0">--}}
{{--                                <div class="body pb-1" style="background: #efefef">--}}
{{--                                    <div>--}}
{{--                                        <h5>{{$active_products }}</h5>--}}
{{--                                        <span>Active</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        --}}{{-- InActive Products --}}
{{--                        <div class="col-lg-3 col-md-6 col-sm-12">--}}
{{--                            <div class="card border-0">--}}
{{--                                <div class="body pb-1" style="background: #efefef">--}}
{{--                                    <div>--}}
{{--                                        <h5>{{$inactive_products }}</h5>--}}
{{--                                        <span>Inactive</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        --}}{{-- Featured Products --}}
{{--                        <div class="col-lg-3 col-md-6 col-sm-12">--}}
{{--                            <div class="card border-0">--}}
{{--                                <div class="body pb-1" style="background: #efefef">--}}
{{--                                    <div>--}}
{{--                                        <h5>{{$featured_products }}</h5>--}}
{{--                                        <span>Featured</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    {{-- Data Table Row --}}
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="card border">
                                <div class="card-body pt-0">
                                    <div id="DataTables" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="dataTables_length"><label>Show
                                                        <select id="notifications_datatable_length"
                                                                class="form-control form-control-sm">
                                                            <option selected value="10">10</option>
                                                            <option value="25">25</option>
                                                            <option value="50">50</option>
                                                            <option value="100">100</option>
                                                        </select> entries</label></div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div id="example-datatable_filter" class="dataTables_filter"><label>
                                                        Search:<input id="notificationsSearch" value="" type="search"
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
                                                        <th class="notification-icons">Icon</th>
                                                        <th>Notifcation Message</th>
                                                        <th>Created Date</th>
                                                        <th>Updated Date</th>
                                                        <th class="notification-icons">View Detail</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="notificationsList">

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
    <script>
        $(document).ready(function () {
            var page_id = 1
            getNotificationList(page_id);

        });
    </script>

@endsection
