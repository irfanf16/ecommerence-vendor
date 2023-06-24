@extends('vendor.layouts.master', ['navItem' => 'products'])
@section('title', 'Product Questions ')

@section('content')

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header order-header">
                        <h2 class="d-inline"><strong>Product Questions</strong></h2>
                    </div>
                    {{-- warning message row --}}

                    <div class="row clearfix order-card-main">
                        {{-- Total Products --}}
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card border-0">
                                <div class="body pb-1" style="background: #efefef">
                                    <div>
                                        <h5>{{ $total_questions }}</h5>
                                        <span>Total questions</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Active Products --}}
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card border-0">
                                <div class="body pb-1" style="background: #efefef">
                                    <div>
                                        <h5>{{ $pending_questions }}</h5>
                                        <span>Pending questions</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- InActive Products --}}
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card border-0">
                                <div class="body pb-1" style="background: #efefef">
                                    <div>
                                        <h5>{{ $answer_questions }}</h5>
                                        <span>Replied questions</span>
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
                                <div class="header">
                                    <a href='{{ URL::to('/vendor/products') }}' title="Add new variant for this product" class="btn btn-primary float-right">Back</a>
                                </div>
                                <div class="body pt-0">
                                    <div class="table-responsive">
                                        <table id="example-datatable"
                                               class="table table-hover dataTable js-basic-example">
                                            <thead>
                                            <tr>
                                                <th width="5%">Product Image</th>
                                                <th width="5%">Product</th>
                                                <th width="10%">Customer Question</th>
                                                <th width="10%">Vendor Answered</th>
                                                <th width="10%">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($questions as $rev)
                                                <tr>

                                                    <td width="10%">
                                                        <img
                                                            src="{{$imagesUrl}}/storage/product/images/sm/{{$rev->product_detail->primary_image ?? 'default.png'}}"
                                                            alt="" class=" rounded w-100">
                                                    </td>
                                                    <td><strong>Product</strong> {{$rev->product_detail->name ?? 'N/A'}}</td>
                                                    <td><strong>{{ $rev->customer_question}}</strong></td>
                                                    <td>
                                                        @if ($rev->vendor_reply)
                                                            <strong>{{ $rev->vendor_reply }}</strong>
                                                        @else
                                                            <span class="badge badge-lg badge-danger text-capitalize">Not Reacted yet</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if (!$rev->vendor_reply)
                                                            <button data-id="{{$rev->id}}" title="Edit This Product"
                                                                    class="btn btn-primary btn-sm m-1 questionReply">Reply
                                                            </button>
                                                        @endif
                                                    </td>
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
            </div>
        </div>
    </div>

    <div class="modal fade" id="questionsReplyModel" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="changeStatus" action="{{URL::to('vendor/question/reply')}} " method="POST">
                @csrf

                <div class="modal-content">
                    <div class="modal-header custom-modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Your Reply</h5>

                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="question_id" id="question_id">
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


                var page_id = 1;
                @if(Session::has('review_page_id'))
                    page_id = '{{Session::get('review_page_id')}}'
                @endif
                console.log('questions list is')
                getquestionsList(page_id);
                let response = "<?php echo $response; ?>";
                let message = "<?php echo $message; ?>";
                sweetAlert(response, message);
            });
        </script>
    @endif
    <script>
        $(document).ready(function () {
            $(document).on('click','.questionReply',function () {

                var id=$(this).attr('data-id')
                document.getElementById('question_id').value=id
                $('#questionsReplyModel').modal('show')
            })
        });
    </script>
@endsection


