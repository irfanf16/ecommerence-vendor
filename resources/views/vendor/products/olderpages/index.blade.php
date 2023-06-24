@extends('vendor.layouts.master', ['navItem' => 'products'])
@section('title', 'Product variants ')

@section('content')

    <div class="container-fluid">

        {{-- Data Table Row --}}
        <div class="row clearfix">
            {{-- Cards Row --}}
            <div class="col-md-12">
                <div class="card border">
                    <div class="body">
                        <div class="row">
                            <div class="col-md-6">
                                <h2 class="text-capitalize">{{ $product->name }}</h2>
                                <h6>{{ $product->name }}</h6>
                            </div>
                            <div class="col-md-3">
                                <div class="card border-0 bg-light-grey mb-0">
                                    <div class="body">
                                        <h5>Total Stock</h5>
                                        <h2><b>{{ $total_stock }}</b></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="card border-0 bg-light-grey mb-0">
                                    <div class="body">
                                        <h5>Remaining Stock</h5>
                                        <h2><b>{{ $remaining_stock }}</b></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card border">
                    <div class="header">
                        <h2><strong>Variants - {{ $variants_count }}</strong></h2>
                        <a href='{{ URL::to("/vendor/products/$product->id/variants/create") }}'
                            title="Add new variant for this product" class="btn btn-primary">Add Variant</a>
                    </div>
                    <div class="body pt-0">
                        <div class="table-responsive">
                            <table id="example-datatable" class="table table-hover dataTable js-basic-example">
                                <thead>
                                    <tr>
                                        <th width="5%">Sr.</th>
                                        <th width="30%">Variant Details</th>
                                        <th>Retail Price</th>
                                        <th>Sale Price</th>
                                        <th>Total Stock</th>
                                        <th>Remaining Stock</th>
                                        <th width="10%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach ($variants as $variant)
                                        <tr>
                                            <td>{{ $count++ }}</td>
                                            <td>
                                                <b>Attribute: </b> {{ $variant->attribute->title }} <br>
                                                <b>Variant: </b> {{ $variant->variant->title }}
                                            </td>
                                            <td>{{ $variant->retail_price }}</td>
                                            <td>{{ $variant->sale_price }}</td>
                                            <td>{{ $variant->total_stock }}</td>
                                            <td>{{ $variant->remaining_stock }}</td>
                                            <td>
                                                <a href='{{ URL::to("/vendor/products/$product->id/variants/$variant->id/edit") }}'
                                                    title="Edit This Product" class="btn btn-primary btn-sm">
                                                    <span class="btn-inner--icon">
                                                        <i class="fa fa-edit"></i>
                                                    </span>
                                                </a>
                                                <form action="" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete This Product">
                                                        <span class="btn-inner-icon">
                                                            <i class="fa fa-trash-o"></i>
                                                        </span>
                                                    </button>
                                                </form>
                                            </td>
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
    </div>
@endsection

@if (Session::has('response'))
    @section('customScripts')
        {{ $response = Session::get('response')['action'] }}
        {{ $message = Session::get('response')['message'] }}

        <script>
            $(document).ready(function() {
                let response = "<?php echo $response; ?>";
                let message = "<?php echo $message; ?>";
                sweetAlert(response, message);
            });
        </script>
    @endsection
@endif
