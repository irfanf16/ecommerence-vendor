@extends('vendor.layouts.master',['navItem'=>'categories'])
@section('title', 'Categories')
@section('content')
    {{-- MAIN CATEGOTIES --}}

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header form-bdr-top">
                        <h2><strong>Categories - {{ count($active_categories) }}</strong></h2>
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
                                    @foreach ($active_categories as $category)

                                        <tr>
                                            <td width="5%">{{ $count }}</td>
                                            @if ($category->logo_image)
                                                <td width='5%'><img
                                                        src="{{ config('app.url') . 'admin/images/categories/logo/sm/' . $category->logo_image }}"
                                                        class="rounded-circle" alt="category"></td>

                                            @else
                                                <td width='5%'><img
                                                        src="{{ URL::to('vendor/images/default/category.svg') }}"
                                                        class="rounded-circle" alt="category"></td>
                                            @endif
                                            <td>{{ $category->title }}</td>

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
