@extends('vendor.layouts.master', ['navItem' => 'settings'])
@section('title', ' Your Profile')
@section('content')

    <div class="container-fluid ">
        <form action="{{ url('customSMS') }}" method="POST">
            @csrf
            {{-- Phone Number --}}
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label for="phone" class="d-inline"><b>Phone:<sup class="text-danger">*</sup></b></label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control counter" maxlength="25" name="phone" id="phone" required>
                    </div>
                </div>
            </div>
            {{-- Message --}}
            <div class=" form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label for="message" class="d-inline"><b>Type Message:<sup
                                    class="text-danger">*</sup></b></label>
                    </div>
                    <div class="col-md-6">
                        <textarea name="message" class="form-control" id="message" cols="30" rows="10"></textarea>
                    </div>
                </div>
            </div>
            <button class="btn btn-success">Send</button>
        </form>
    </div>
@endsection
