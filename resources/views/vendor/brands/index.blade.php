@extends('vendor.layouts.master',['navItem'=>'products'])
@section('title', 'Brands')
@section('content')
    {{-- MAIN Brands --}}

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header form-bdr-top">
                        <h2><strong>Brands - {{ count($active_brands) }}</strong></h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover dataTable js-basic-example">
                                <thead>
                                    <tr>
                                        <th width="5%">Sr.</th>
                                        <th>Name</th>
                                        <th>Logo Image</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $count = 1;
                                    @endphp
                                    @foreach ($active_brands as $brand)

                                        <tr>
                                            <td width="5%">{{ $count }}</td>
                                            @if ($brand->logo_image === '')
                                                <td width='5%'><img src="{{ URL::to('vendor/images/default/brand.svg') }}"
                                                        class="rounded-circle" alt="brand"></td>
                                            @else
                                                <td width='5%'><img
                                                        src="{{ config('app.url') . 'admin/images/brands/logo/sm/' . $brand->logo_image }}"
                                                        class="rounded-circle" alt="brand"></td>
                                            @endif
                                            <td>{{ $brand->name }}</td>

                                        </tr>
                                        @php
                                            $count++;
                                        @endphp
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
