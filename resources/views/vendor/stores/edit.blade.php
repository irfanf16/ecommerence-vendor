@extends('vendor.layouts.master',['navItem'=>'stores'])
@section('title', 'Edit Your Store')

@section('content')

    <div class="container-fluid ">

        {{-- =================================================================================
                                               Validation error alert
 ================================================================================================ --}}

        @if (count($errors) > 0)
            @php $errors = Session::get('errors'); @endphp
            <div class="card bg-danger" id="alertBox">
                <div class="card-header bg-danger text-white">
                    <strong>Errors - Please Resolve These FIrst</strong>
                    <a href="#" id="alertCloseBtn" class="float-right text-white alert-close-btn">X</a>
                </div>
                <div class="card-body p-0">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-white">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif


        <div class="card">
            {{-- header and back button --}}
            <div class="card-header form-bdr-top">
                <h5 class="d-inline">Store Details</h5>
                <a href="{{ URL::to('/dashboard') }}" class="btn btn-primary float-right d-inline" name="back">
                    <strong>back</strong>
                </a>
            </div>

            <div class="card-body">
                <form action="{{ route('stores.update', 4) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="row">

                        {{-- user name --}}
                        <div class="col-md-4 ">
                            <label for="username"><strong>User Name: <sup class="text-danger">*</sup></strong></label>
                            <input type="text" class="form-control mb-3" name="username" id="username" required>
                        </div>

                        {{-- store name --}}
                        <div class="col-md-4">
                            <label for="storename"><strong>Store Name:<sup class="text-danger">*</sup></strong></label>
                            <input type="text" class="form-control mb-3" name="storename" id="storename" required>
                        </div>

                        {{-- business email --}}
                        <div class="col-md-4">
                            <label for="email"><strong>Business Email:<sup class="text-danger">*</sup></strong></label>
                            <input type="email" class="form-control mb-3" name="email" id="email" required>
                        </div>

                        {{-- Store URL: --}}
                        <div class="col-md-4">
                            <label for="storeurl"><strong>Store URL:</strong></label>
                            <input type="url" class="form-control mb-3" name="storeurl" id="storeurl">
                        </div>

                        {{-- phone number --}}
                        <div class="col-md-4">
                            <label for="phone"><strong>Phone:</strong></label>
                            <input type="text" class="form-control mb-3" name="phone" id="phone">
                        </div>

                        {{-- mobile number --}}
                        <div class="col-md-4">
                            <label for="mobile"><strong>Mobile:<sup class="text-danger">*</sup></strong></label>
                            <input type="text" class="form-control mb-3" name="mobile" id="mobile" required>
                        </div>

                        {{-- store address --}}
                        <div class="col-md-4">
                            <label for="address"><strong>Store Address:<sup class="text-danger">*</sup></strong></label>
                            <input type="text" class="form-control mb-3" name="address" id="address" required>
                        </div>

                        {{-- country dropdown --}}
                        <div class="col-md-4">
                            <label for="country"><strong>Country:<sup class="text-danger">*</sup></strong></label>
                            <select class="form-control mb-3 show-tick ms select2" name="country" id="country" required>
                                <option></option>
                                <option value="qatar" selected>Qatar</option>
                            </select>
                        </div>

                        {{-- State dropdown --}}
                        <div class="col-md-4">
                            <label for="state"><strong>City:<sup class="text-danger">*</sup></strong></label>
                            <select class="form-control mb-3 show-tick ms select2" name="state" id="state" required>
                                <option></option>
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                            </select>
                        </div>

                        {{-- District dropdown --}}
                        <div class="col-md-4">
                            <label for="district"><strong>District:<sup
                                        class="text-danger">*</sup></strong></strong></label>
                            <select class="form-control mb-3 show-tick ms select2" name="district" id="district" required>
                                <option></option>
                                <option>Abu Hamour</option>
                                <option>Abu Dhalouf</option>
                                <option>Abu Samra</option>
                            </select>
                        </div>

                        {{-- pob --}}
                        <div class="col-md-4">
                            <label for="pob"><strong>POB:<sup class="text-danger">*</sup></strong></strong></label>
                            <input type="string" class="form-control mb-3" name="pob" id="pob" required>
                        </div>

                        {{-- Logo Image --}}
                        <div class="col-md-4">
                            <label for="logo_image"><strong>Logo Image:</strong></label>
                            <input type="file" class="form-control mb-3" name="logo_image" id="logo_image"
                                title="Select Store Logo ">
                        </div>

                        {{-- Cover Image --}}
                        <div class="col-md-4">
                            <label for="cover_image"><strong>Cover Image:</strong></label>
                            <input type="file" class="form-control" name="cover_image" id="cover_image"
                                title="Select Store Cover Image">
                        </div>

                        {{-- featured swich --}}
                        <div class="col-md-4">
                            <label class="d-block"><strong>Featured:</strong></label>
                            <label class="toggle-switch">
                                <input type="checkbox" name="featured" id="featured">
                                <span class="toggle-switch-slider"></span>
                            </label>
                        </div>

                        {{-- status swich --}}
                        <div class="col-md-4">
                            <label class="d-block"><strong>Active:</strong> </label>
                            <label class="toggle-switch">
                                <input type="checkbox" name="status" id="status">
                                <span class="toggle-switch-slider"></span>
                            </label>
                        </div>
                    </div>

                    {{-- button --}}
                    <button type="submit" class="btn btn-primary float-right">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('customScripts')

    //Jquery code for errors hide
    <script>
        $("#alertCloseBtn").click(function(e) {
            e.preventDefault();
            $("#alertBox").hide();
        });
    </script>

@endsection
