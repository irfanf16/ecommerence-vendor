@extends('vendor.layouts.master',['navItem'=>'childcategories'])
@section('title', 'Child Categories')

@section('content')
    {{-- MAIN CATEGOTIES --}}

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header form-bdr-top">
                        <h2><strong>Child Categories</strong> </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover dataTable js-basic-example">
                                <thead>
                                    <tr>
                                        <th width="5%">Sr.</th>
                                        <th>Image</th>
                                        <th>Title</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 1;

                                    @endphp
                                    @foreach ($active_childcategories as $childcategory)

                                        <tr>
                                            <td width="5%">{{ $count }}</td>
                                            @if ($childcategory->image)
                                                <td width='5%'><img
                                                        src="{{ config('app.url') . 'admin/images/childcategories/sm/' . $childcategory->image }}"
                                                        class="rounded-circle" alt="childcategory"></td>

                                            @else
                                                <td width='5%'><img
                                                        src="{{ URL::to('vendor/images/default/childcategory.svg') }}"
                                                        class="rounded-circle" alt="childcategory"></td>
                                            @endif
                                            <td>{{ $childcategory->title }}</td>
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
