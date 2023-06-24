@extends('vendor.layouts.master', ['navItem' => 'products'])
@section('title', 'All Products ')

@section('content')
    <div class="container-fluid">
        <div class="col-md-6 mx-auto">
            <form action="{{ url('user-placed') }}" method="POST">
                @csrf
                <input type="email" name="email" class="form-control" placeholder="User Email">
                <br>
                <button class="btn btn-youtube form-control">Send Order Placed Email to User</button>
            </form>
            <br>
            <br>
            <form action="{{ url('vendor-placed') }}" method="POST">
                @csrf
                <input type="email" name="email" class="form-control" placeholder="Vendor Email">
                <br>
                <button class="btn btn-google-plus btn-sm form-control">Send Order Email to Vendor</button>
            </form>
        </div>
    </div>

@endsection
