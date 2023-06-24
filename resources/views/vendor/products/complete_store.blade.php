@extends('vendor.layouts.master', ['navItem' => 'products'])
@section('title', 'All Products ')

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-6 mx-auto">
                <div class="card border">
                    <div class="card-header border-0    ">
                        <h2 class="text-center text-danger">Store Information Missing !!!</h2>
                    </div>

                    <div class="card-body pt-0">
                        <p class="text-center mb-0">To add a product please fill your store information first.</p>
                        <p class="text-center mb-4">Click below button to go to edit
                            profile
                            screen.</p>
                        <a href="{{ URL::to('/vendor/profile/edit') }}"
                            class="btn btn-primary w-75 text-white d-block mx-auto">Complete store
                            information here</a>
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
                $('#clickyes').click(function(e) {
                    e.preventDefault();
                    alert("element");
                    var element = $('#invoice').html();
                    alert(element);

                });
            });
        </script>

    @endsection
@endif
