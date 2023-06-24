@extends('vendor.layouts.master',['navItem'=>'products'])
@section('title', 'Upload CSV File For Products Bulk Upload')

@section('content')
    <style>
        .dynamic-table {
            width: 100%;
            overflow-y: hidden;
            max-width: 925px;
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
            @foreach ($errors as $error)
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Sorry! </strong>{{ $error }}
                </div>
            @endforeach
        @endif

        {{-- warning message row --}}
        @if (!$has_store)
            <div class="custom-notification danger card mx-4">
                <div class="notification-content">
                    <h2>Store Information Missing!</h2>
                    <p>To add a product please fill your store information first!</p>
                </div>
            </div>
        @endif

        {{-- breadcrumb row --}}
        <div class="row px-5 pb-3">
            <h6>
                <a href="{{ URL::to('/vendor/dashboard') }}">Home</a> -
                <a href="{{ URL::to('/vendor/products') }}">Products</a> -
                <a href="#">Upload CSV File</a>
            </h6>
        </div>

        <div class="row px-5">
            <div class="col-md-12 p-0">
                <form method="POST" action="{{ URL::to('vendor/product/upload-csv') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="card">
                        <div class="card-header p-2 very-light-gray-bg shadow-sm">
                            <h6><b>Upload CSV File</b> </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                {{-- Store Id --}}
                                <input type="hidden" name="store_id" value="{{ $has_store }}">

                                {{-- Product CSV File --}}
                                <div class="col-md-12 mb-4">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="control-label-lg" for="csv">Products CSV File<sup
                                                    class="text-danger">*</sup></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="csv" id="csv" class="form-control counter" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button id="sumbitBtn" type="submit" class="btn btn-primary float-right">Upload</button>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('customScripts')

@endsection
