@extends('vendor.layouts.master', ['navItem' => 'reviews'])
@section('title', 'Reviews ')

@section('content')

{{--    <div class="container-fluid">--}}

{{--        --}}{{-- Data Table Row --}}
{{--        <div class="row clearfix">--}}
{{--            --}}{{-- Cards Row --}}
{{--            <div class="col-md-12">--}}
{{--                <div class="card border">--}}
{{--                    <div class="body">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-4">--}}
{{--                                <div class="card border-0 bg-light-grey mb-0" style="background: #efefef">--}}
{{--                                    <div class="body">--}}
{{--                                        <h2><b>{{ $total_reviews }}</b></h2>--}}
{{--                                        <span>Total Reviews</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4 ">--}}
{{--                                <div class="card border-0 bg-light-grey mb-0" style="background: #efefef">--}}
{{--                                    <div class="body">--}}
{{--                                        <h2><b>{{ $pending_reviews }}</b></h2>--}}
{{--                                        <span>Pending Reviews</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4 ">--}}
{{--                                <div class="card border-0 bg-light-grey mb-0" style="background: #efefef">--}}
{{--                                    <div class="body">--}}
{{--                                        <h2><b>{{ $answer_reviews }}</b></h2>--}}
{{--                                        <span>Answered Reviews</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-lg-12">--}}
{{--                <div class="card border">--}}
{{--                    <div class="header">--}}
{{--                        <a href=''--}}
{{--                           title="Add new variant for this product" class="btn btn-primary">Back</a>--}}
{{--                    </div>--}}
{{--                    <div class="body pt-0">--}}
{{--                        <div class="table-responsive">--}}
{{--                            <table id="example-datatable" class="table table-hover dataTable js-basic-example">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th width="5%">Sr.</th>--}}
{{--                                    <th width="10%">Review</th>--}}
{{--                                    <th width="10%">Rating</th>--}}
{{--                                    <th width="10%">Vendor Reaction</th>--}}
{{--                                    <th width="10%">Action</th>--}}
{{--                                    --}}{{--                                        <th width="18%">Actions</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @php $count = 1; @endphp--}}
{{--                                @foreach ($reviews as $rev)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{ $count }}</td>--}}
{{--                                        <td><strong>{{ $rev->customer_review }}</strong></td>--}}
{{--                                        <td><strong>{{ $rev->customer_rating }}</strong></td>--}}
{{--                                        <td>--}}
{{--                                            @if ($rev->vendor_reply)--}}
{{--                                                <strong>{{ $rev->vendor_reply }}</strong>--}}
{{--                                            @else--}}
{{--                                                <span--}}
{{--                                                    class="badge badge-lg badge-danger text-capitalize">Not Reacted yet--}}
{{--                                                    </span>--}}
{{--                                            @endif--}}
{{--                                        </td>--}}

{{--                                        <td>--}}
{{--                                            <a href="/vendor/products/1529/edit? =true" title="Edit This Product" class="btn btn-primary btn-sm m-1"><span class="btn-inner-icon "><i class="fa fa-edit text-white"></i></span></a>--}}
{{--                                        </td>--}}
{{--                                        @php $count++; @endphp--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header order-header">
                        <h2 class="d-inline"><strong>Reviews</strong></h2>
                    </div>
                    {{-- warning message row --}}

                    <div class="row clearfix order-card-main">
                        {{-- Total Products --}}
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card border-0">
                                <div class="body pb-1" style="background: #efefef">
                                    <div>
                                        <h5>{{ $total_reviews }}</h5>
                                        <span>Total Reviews</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Active Products --}}
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card border-0">
                                <div class="body pb-1" style="background: #efefef">
                                    <div>
                                        <h5>{{ $pending_reviews }}</h5>
                                        <span>Pending Reviews</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- InActive Products --}}
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card border-0">
                                <div class="body pb-1" style="background: #efefef">
                                    <div>
                                        <h5>{{ $answer_reviews }}</h5>
                                        <span>Replied Reviews</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Featured Products --}}
                    </div>

                    {{-- Data Table Row --}}
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="card border">

                                <div class="card-body pt-0">
                                    <div id="DataTables" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <div class="row mb-5 mt-5 page-block">
                                            <div class="col-sm-12 col-md-6 mt-4">
                                                <label>Reviews</label>
                                                <select id="reviews" class="form-control filters_review">
                                                    <option value="3">All</option>
                                                    <option @if(Session::get('reviews')==2) selected @endif value="0">
                                                        Pending Reviews Reply
                                                    </option>
                                                    <option @if(Session::get('reviews')==1) selected @endif value="1">
                                                        Replied Reviews
                                                    </option>
                                                </select>
                                            </div>
{{--                                            <div class="col-sm-12 col-md-6 mt-4">--}}
{{--                                                <label>Reported</label>--}}
{{--                                                <select id="status" name="is_reported" class="form-control filters_review">--}}
{{--                                                    <option value="">All</option>--}}
{{--                                                    <option @if(Session::get('is_reported')==1) selected @endif value="1">--}}
{{--                                                        Reported--}}
{{--                                                    </option>--}}
{{--                                                    <option @if(Session::get('is_reported')==2) selected @endif value="0">--}}
{{--                                                        Non Reported--}}
{{--                                                    </option>--}}
{{--                                                </select>--}}
{{--                                            </div>--}}

                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="dataTables_length"><label>Show
                                                        <select id="review_datatable_length" class="form-control form-control-sm">
                                                            <option value="10">10</option>
                                                            <option
                                                                {{ Session::get('review_datatable_length') == 1 ? "selected" : "" }}  value="10">
                                                                10
                                                            </option>
                                                            <option
                                                                {{ Session::get('review_datatable_length') == 25 ? "selected" : "" }} value="25">
                                                                25
                                                            </option>
                                                            <option
                                                                {{ Session::get('review_datatable_length') == 50 ? "selected" : "" }} value="50">
                                                                50
                                                            </option>
                                                            <option
                                                                {{ Session::get('review_datatable_length') == 100 ? "selected" : "" }} value="100">
                                                                100
                                                            </option>
                                                        </select> entries</label></div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div id="example-datatable_filter" class="dataTables_filter"><label>
                                                        Search:<input id="reviewSearch" value="" type="search"
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
                                                            <th width="10%">Product Image</th>
                                                            <th width="20%">Product</th>
                                                            <th width="5%">Review</th>
                                                            <th width="5%">Review Image</th>
                                                            <th width="5%">Rating</th>
                                                            <th width="5%">Vendor Response</th>
                                                            <th width="10%">Actions</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="reviewsList">

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

<div class="modal fade" id="reviewsReplyModel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="changeStatus" action="{{URL::to('vendor/review/reply')}} " method="POST">
            @csrf

            <div class="modal-content">
                <div class="modal-header custom-modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Your Reply</h5>

                </div>
                <div class="modal-body">
                    <input type="hidden" name="review_id" id="review_id">
                    <textarea class="form-control" name="vendor_reply"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Confirm</button>
                </div>
            </div>
        </form>
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
            });
        </script>
        @endif
        <script>
            $(document).ready(function () {


                var page_id = 1;
                @if(Session::has('review_page_id'))
                    page_id = '{{Session::get('review_page_id')}}'
                @endif
                console.log('reviews list is')
                getReviewsList(page_id);

              $(document).on('click','.reviewReply',function () {

                  var id=$(this).attr('data-id')
                  console.log('review id is ' + id )
                    document.getElementById('review_id').value=id
                  $('#reviewsReplyModel').modal('show')
              })
            });
        </script>
    @endsection


