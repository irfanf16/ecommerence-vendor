@extends('vendor.layouts.master',['navItem'=>'products'])
@section('title', 'Attributes')
@section('content')
    {{-- MAIN Attributes --}}

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header form-bdr-top">
                        <h2><strong>Attributes - {{ count($active_attributes) }}</strong></h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover dataTable js-basic-example">
                                <thead>
                                    <tr>
                                        <th width="5%">Sr.</th>
                                        <th>Title</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $count = 1;
                                    @endphp
                                    @foreach ($active_attributes as $attribute)

                                        <tr>
                                            <td width="5%">{{ $count }}</td>
                                            <td>{{ $attribute->title }}</td>

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
