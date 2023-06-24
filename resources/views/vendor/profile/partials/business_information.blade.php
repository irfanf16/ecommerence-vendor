<div class="tab-pane fade" id="business-info" role="tabpanel" aria-labelledby="profile-tab">
    <form action="{{ url('/vendor/business-info') }}" method="POST" enctype="multipart/form-data" id="business-info">
        @csrf

        <h4 class="mt-4 mb-4">Business Information
            @if ($profile_details->business_info)
                <span class="badge badge-pill badge-success">Completed</span>
            @else
                <span class="badge badge-pill badge-danger">Incomplete</span>
            @endif
        </h4>

        {{-- Legal Company Name: --}}
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="company_name" class="d-inline"><b> Legal Company
                            Name:<sup class="text-danger">*</sup></b></label>
                </div>
                <div class="col-md-6">

                    <input type="text" class="form-control counter" maxlength="255" name="company_name" required
                        value="{{ $profile_details->business_info->company_name ?? null }}">
                    <span class="float-right counter-text counter-val">0 / 255</span>
                </div>
            </div>
        </div>

        {{-- Address: --}}
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="company_address" class="d-inline"><strong> Address:<sup
                                class="text-danger">*</sup></strong></label>
                </div>
                <div class="col-md-6">
                    <div class="row">

                        {{-- country --}}
                        <div class="col-md-6">
                            <label for="">Select Country:<sup class="text-danger">*</sup></label>
                            <select class="form-control mb-3" name="country_id" id="country_id" required>
                                <option disabled>Select Country</option>
                                <option value="1" selected>Qatar</option>
                            </select>
                        </div>
                        {{-- {{dd($profile_details->business_info->city_id)}} --}}
                        {{-- city --}}
                        <div class="col-md-6">
                            <label for="city_id">Select City/Municipality:
                                <sup class="text-danger">*</sup>
                            </label>
                            <select class="form-control mb-3" name="city_id" id="city_id" required>
                                <option disabled>Select City</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" @if ($profile_details->business_info)
                                        {{ $profile_details->business_info->city_id == $city->id ? 'selected' : '' }}
                                @endif
                                >
                                {{ $city->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- company zone number --}}
                        <div class="col-md-6">
                            <label for="">Zone Number:<sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control counter mb-3" maxlength="20" name="company_zone_no"
                                id="company_zone_no"
                                value="{{ $profile_details->business_info->company_zone_no ?? null }}" required>
                            <span class="float-right counter-text counter-val">0 / 20</span>
                        </div>
                        {{-- company street number --}}
                        <div class="col-md-6">
                            <label for="">Street Number:<sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control counter mb-3" maxlength="20" name="company_street_no"
                                id="company_street_no"
                                value="{{ $profile_details->business_info->company_street_no ?? null }}" required>
                            <span class="float-right counter-text counter-val">0 / 20</span>
                        </div>
                        {{-- company building number --}}
                        <div class="col-md-6">
                            <label for="">Building Number:<sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control counter mb-3" maxlength="20"
                                name="company_building_no" id="company_building_no"
                                value="{{ $profile_details->business_info->company_building_no ?? null }}" required>
                            <span class="float-right counter-text counter-val">0 / 20</span>
                        </div>
                        {{-- company floor number --}}
                        <div class="col-md-6">
                            <label for="">Floor Number:</label>
                            <input type="text" class="form-control counter mb-3" maxlength="20" name="company_floor_no"
                                id="company_floor_no"
                                value="{{ $profile_details->business_info->company_floor_no ?? null }}">
                            <span class="float-right counter-text counter-val">0 / 20</span>
                        </div>
                        {{-- company appartment number --}}
                        <div class="col-md-6">
                            <label for="">Apartment Number:</label>
                            <input type="text" class="form-control counter mb-3" maxlength="20"
                                name="company_appartment_no" id="company_appartment_no"
                                value="{{ $profile_details->business_info->company_appartment_no ?? null }}">
                            <span class="float-right counter-text counter-val">0 / 20</span>
                        </div>
                        {{-- address --}}
                        <div class="col-md-12">
                            <label for="">Address (Optional):</label>
                            <input type="text" maxlength="255" class="form-control mb-3 counter" name="company_address"
                                id="company_address" maxlength="255"
                                value="{{ $profile_details->business_info->company_address ?? null }}">
                            <span class="float-right counter-text counter-val">0 / 255</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <h4>Person In-Charge </h4>
        {{-- Person In-Charge: --}}
        <div class="form-group mt-4">
            <div class="row">
                <div class="col-md-3">
                    <label for="person_incharge_name" class="d-inline"><strong> Full
                            Name:<sup class="text-danger">*</sup></strong></label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control counter" maxlength="255" name="person_incharge_name" required
                        value="{{ $profile_details->business_info->person_incharge_name ?? null }}">
                    <span class="float-right counter-text counter-val">0 / 255</span>
                </div>
            </div>
        </div>

        {{-- Person in Charge Mobile Number: --}}
        {{-- mobile --}}
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="person_incharge_mobile" class="d-inline"><strong>
                            Mobile
                            Number:<sup class="text-danger">*</sup></strong></label>
                </div>
                <div class="col-md-6">
                    <input type="number" class="form-control counter" name="person_incharge_mobile" maxlength="13"
                        required value="{{ $profile_details->business_info->person_incharge_mobile ?? null }}">
                    <span class="float-right counter-text counter-val">0 / 13</span>
                </div>
            </div>
        </div>

        {{-- Person in Charge Email: --}}
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="person_incharge_email" class="d-inline"><strong>
                            Email:<sup class="text-danger">*</sup></strong></label>
                </div>
                <div class="col-md-6">
                    <input type="email" class="form-control counter" maxlength="30" name="person_incharge_email"
                        required value="{{ $profile_details->business_info->person_incharge_email ?? null }}">
                    <span class="float-right counter-text counter-val">0 / 30</span>
                </div>
            </div>
        </div>

        {{-- person ID Type dropdown --}}
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="person_id_type">
                        <strong>ID Type:<sup class="text-danger">*</sup></strong>
                    </label>
                </div>
                <div class="col-md-6">
                    <select class="form-control" name="person_id_type" id="person_id_type" required>
                        <option disabled>Select ID Type</option>

                        @if ($profile_details->business_info)

                            <option value="1"
                                {{ $profile_details->business_info->person_id_type == 1 ? 'selected' : '' }}>
                                ID
                            </option>

                        @else
                            <option value="1">
                                ID
                            </option>
                        @endif
                    </select>
                </div>
            </div>
        </div>
        {{-- person Id number: --}}
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="person_id_no" class="d-inline"><strong> ID Number:<sup
                                class="text-danger">*</sup></strong></label>
                </div>
                <div class="col-md-6">
                    <input type="number" class="form-control counter" maxlength="15" name="person_id_no" required
                        value="{{ $profile_details->business_info->person_id_no ?? null }}">
                    <span class="float-right counter-text counter-val">Max</span>
                </div>
            </div>
        </div>
        {{-- Upload ID - Front Side --}}
        <div class="form-group mt-5">
            <div class="row">
                <div class="col-md-3">
                    <label for="" class="d-inline"><strong>ID - Front
                            Side:<sup class="text-danger">*</sup></strong></label>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-8">
                            <label for="person_id_front_image" class="btn btn-primary btn-sm">Upload</label>
                            <input type="file" class="note-style" name="person_id_front_image"
                                id="person_id_front_image" accept="image/png,image/jpg,image/jpeg"
                                onchange="frontSide(this)" hidden>
                            <p id="frontSide">
                                <small>Only PNG, JPEG, JPG File | Max Size :2 MB</small>
                            </p>
                        </div>
                        <div class="col-md-4">
                            @if ($profile_details->business_info)
                                <img id="front_preview"
                                    src="{{ config('app.url') . 'storage/vendor/documents/id-front/lg/' . $profile_details->business_info->person_id_front_image }}"
                                    class="ml-2 float-right " width="250px" height="130px" />

                            @else
                                <img id="front_preview"
                                    src="{{ URL::to('vendor/images/default/default_photo.svg') }}"
                                    class="ml-2 float-right " width="250px" height="130px" />

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Upload ID - back Side --}}
        <div class="form-group mt-3">
            <div class="row">
                <div class="col-md-3">
                    <label for="" class="d-inline"><strong>ID - Back
                            Side:<sup class="text-danger">*</sup></strong></label>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-8">
                            <label for="person_id_back_image" class="btn btn-primary btn-sm">Upload</label>
                            <input type="file" class="note-style" name="person_id_back_image"
                                id="person_id_back_image" accept="image/png,image/jpg,image/jpeg,"
                                onchange="backSide(this)" hidden>
                            <p id="backSide">
                                <small>( Only PNG, JPEG, JPG File | Max Size :2 MB )</small>
                            </p>
                        </div>
                        <div class="col-md-4">
                            @if ($profile_details->business_info)
                                <img id="back_preview"
                                    src="{{ config('app.url') . 'storage/vendor/documents/id-back/lg/' . $profile_details->business_info->person_id_back_image }}"
                                    class="ml-2 float-right" width="250px" height="130px" />
                            @else
                                <img id="back_preview" src="{{ URL::to('vendor/images/default/default_photo.svg') }}"
                                    class="ml-2 float-right" width="250px" height="130px" />
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="redirect" class="redirect_input" value="">

        <a class="nav-link mb-sm-3 btn btn-primary float-right ml-3 bank-tab text-white"
            trigger-click="#document-tab">Next</a>



        @if (!$profile_status)
            <button class="btn btn-success float-right" id="business-btn-save">
                Save As Draft
            </button>
        @endif
    </form>
</div>
