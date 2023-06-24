<div class="tab-pane fade show active" id="seller-info" role="tabpanel" aria-labelledby="seller-info">

    <h4 class="mt-4 mb-4">Basic Profile Information
        @if ($profile_details)
            <span class="badge badge-pill badge-success">Completed</span>
        @else
            <span class="badge badge-pill badge-danger">Incomplete</span>
        @endif
    </h4>
    <div class="col-md-12">
        <div class="col-md-10 p-0">
            {{-- Contact Email address --}}
            <form action="{{ URL::to('/verify-email') }}" method="POST">
                @csrf
                <div class="form-group mt-5">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="email" maxlength="255" class="d-inline float-right">
                                <b>Email address:</b>
                                <sup class="text-danger">*</sup>
                            </label>
                        </div>
                        <div class="col-md-6 mr-2 p-0">
                            <input type="email" class="form-control" name="email" id="email" required
                                value="{{ $profile_details->email }}" readonly>
                        </div>
                        @if ($profile_details->is_email_verified == 1)
                            <button class="btn btn-success btn-sm" disabled>
                                <i class=" text-white fa fa-check" title="Verified"></i>
                                Verified
                            </button>
                        @else
                            <button class="btn btn-danger btn-sm">
                                <i class="text-white fas fa-exclamation-circle" title="Verify Email ">
                                </i>
                                Verify
                            </button>
                        @endif
                    </div>
                </div>
            </form>

            {{-- Mobile Phone Number --}}
            <form action="{{ URL::to('/verify-phone') }}" method="POST">
                @csrf
                <div class="form-group mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="mobile" class="d-inline float-right">
                                <b>Mobile Number:</b>
                                <sup class="text-danger">*</sup>
                            </label>
                        </div>
                        <div class="col-md-6 p-0">
                            <input type="text" class="form-control none-style" name="mobile" id="mobile" required
                                value="{{ $profile_details->mobile }}" readonly>
                        </div>
                        {{-- @if ($profile_details->is_mobile_verified == 1)
                                                    <button class="btn btn-success btn-sm" disabled>
                                                        <i class=" text-white fas fa-check" title="Verified">
                                                        </i>
                                                        Verified
                                                    </button>
                                                @else
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="text-white fas fa-exclamation-circle"
                                                            title="Verify Mobile Number">
                                                        </i>
                                                        Verify
                                                    </button>
                                                @endif --}}
                    </div>
                </div>
            </form>
            {{-- Full Name: --}}
            <form action="{{ url('/vendor/basic-info') }}" method="POST" enctype="multipart/form-data"
                id="seller-info">
                @csrf

                <div class="form-group mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name" class="d-inline float-right"><b>Full Name:</b><sup
                                    class="text-danger">*</sup></label>
                        </div>
                        <div class="col-md-6 p-0">
                            <input type="text" maxlength="30" class="form-control counter" name="name" id="name"
                                required value="{{ $profile_details->name }}">
                            <span class="float-right counter-text counter-val">0 /
                                30</span>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="redirect" class="redirect_input" value="">

                <a class="nav-link mb-sm-3 btn btn-primary float-right ml-3 bank-tab text-white"
                    trigger-click="#business-tab">Next</a>

                @if (!$profile_status)
                    <button class="btn btn-success float-right mr-5 mt-5">Save
                        As Draft</button>
                @endif
            </form>
        </div>
    </div>
</div>
