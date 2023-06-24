@extends('vendor.layouts.master',['navItem'=>'locations'])
@section('content')
    {{-- MAIN CATEGOTIES --}}

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2 class="d-inline"><strong>Locations</strong></h2>
                        <a href="{{ url('dashboard') }}" class="btn btn-primary d-inline">back</a>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-basic-example">
                                <thead>
                                    <tr>
                                        <th width="5%">Sr.</th>
                                        <th>City Name</th>
                                        <th>Image</th>
                                        <th>Quantity ordered</th>
                                        <th>Order Date</th>
                                        <th>Order Stutus</th>
                                        <th>Payment Stutus</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th width="5%">Sr.</th>
                                        <th>City Name</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    {{-- @foreach ($categories as $category) --}}

                                    <tr>
                                        <td width="5%">Sr.</td>
                                        <td>Multan</td>
                                        <td>Image</td>
                                        <td class="text-center"><span
                                                class="badge badge-pill badge-info text-uppercase ">pending</span></td>
                                        <td class="text-center"><span
                                                class="badge badge-pill badge-primary text-uppercase ">paid</span></td>
                                        <td>
                                            <a href="" class="btn badge-success btn-sm"><i class="ti-view-list"></i></a>
                                            <a href="" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                            <a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                    {{-- @endforeach --}}



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
