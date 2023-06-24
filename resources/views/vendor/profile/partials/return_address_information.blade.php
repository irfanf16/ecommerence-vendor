<div class="tab-pane fade" id="return-warehouse" role="tabpanel" aria-labelledby="return-warehouse">

    <form action="{{ url('/vendor/return-warehouse') }}" method="POST" class="form-floating"
        id="return_warehouse_address">
        @csrf
        {{-- ALERT --}}

        @if (!$profile_details->store)
            <div class="custom-notification danger card bg-lighter mt-3">
                <div class="notification-content">
                    <h2>Incomplete Store Information</h2>
                    <p class="text-capitalize">Please Complete Your Store Information First</p>
                </div>
            </div>
        @endif

        <h4 class="mt-4 mb-4">Return Warehouse Address

            @if ($profile_details->store)
                @if ($profile_details->store->return_address)
                    <span class="badge badge-pill badge-success">Completed</span>
                @else
                    <span class="badge badge-pill badge-danger">Incomplete</span>
                @endif
            @else
                <span class="badge badge-pill badge-danger">Incomplete</span>
            @endif
        </h4>

        <div class="row">
            <div class="form-group pl-4">
                <div class="custom-control custom-checkbox mb-3 mt-n2 float-left">
                    <input type="checkbox" name="warehouse_check" class="custom-control-input" id="warehouse_check">
                    <label class="custom-control-label text-bold" for="warehouse_check"><b>Same As
                            Warehouse Address</b>
                        <br>

                    </label>
                </div>
            </div>
        </div>
        <div id="return_warehouse">
            {{-- warehouse Name: --}}
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label for="warehouse_name" class="d-inline"><b>Warehouse
                                Name:</b><sup class="text-danger">*</sup></label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control counter" maxlength="255" name="warehouse_name"
                            id="warehouse_name" required
                            value="{{ $profile_details->store->return_address->warehouse_name ?? '' }}">
                        <span class="float-right counter-text counter-val">0 / 255</span>
                    </div>
                </div>
            </div>

            {{-- Contact Email address --}}
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label for="warehouse_email" class="d-inline"><b>Contact Email:<sup
                                    class="text-danger">*</sup></b></label>
                    </div>
                    <div class="col-md-6">
                        <input type="email" class="form-control counter" maxlength="255" name="warehouse_email"
                            value="{{ $profile_details->store->return_address->warehouse_email ?? '' }}" required>
                        <span class="float-right counter-text counter-val">0 / 255</span>
                    </div>
                </div>
            </div>

            {{-- Contact Mobile Phone Number --}}
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label for="warehouse_phone_no" class="d-inline"><b>Contact
                                Mobile/Phone
                                Number:<sup class="text-danger">*</sup></b></label>
                    </div>
                    <div class="col-md-6">
                        <input type="number" class="form-control counter" maxlength="13" name="warehouse_phone_no"
                            value="{{ $profile_details->store->return_address->warehouse_phone_no ?? '' }}" required>
                        <span class="float-right counter-text counter-val">0 / 13</span>
                    </div>
                </div>
            </div>

            {{-- Address: --}}
            <div class="form-group ">
                <div class="row">
                    <div class="col-md-3">
                        <label for="warehouse_address" class="d-inline"><strong>
                                Address:</strong></label>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            {{-- address --}}

                            {{-- country --}}

                            <div class="col-md-6">
                                <label for="">Select Country:<sup class="text-danger">*</sup></label>
                                <select class="form-control mb-3" name="country_id" id="country_id" required>
                                    <option disabled>Select Country:</option>
                                    <option value="1" selected>Qatar</option>
                                </select>
                            </div>
                            {{-- city --}}
                            <div class="col-md-6">
                                <label for="">Select City/Municipality:
                                    <sup class="text-danger">*</sup>
                                </label>
                                <select class="form-control mb-3" name="city_id" id="return_warehouse_city_id" required>
                                    <option disabled>Select City</option>
                                    @if ($profile_details->store)
                                        @if ($profile_details->store->return_address)
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}"
                                                    {{ $profile_details->store->return_address->city_id == $city->id ? 'selected' : '' }}>
                                                    {{ $city->name }}
                                                </option>
                                            @endforeach

                                        @else
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}">
                                                    {{ $city->name }}
                                                </option>
                                            @endforeach

                                        @endif
                                    @else
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">
                                                {{ $city->name }}
                                            </option>
                                        @endforeach

                                    @endif
                                </select>
                            </div>
                            {{-- company zone number --}}
                            <div class="col-md-6">
                                <label for="">Zone Number:<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control mb-3 counter" maxlength="20"
                                    name="warehouse_zone_no" id="warehouse_zone_no"
                                    value="{{ $profile_details->store->return_address->warehouse_zone_no ?? '' }}"
                                    required>
                                <span class="float-right counter-text counter-val">0 / 20</span>

                            </div>
                            {{-- company street number --}}
                            <div class="col-md-6">
                                <label for="">Street Number:<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control mb-3 counter" maxlength="20"
                                    name="warehouse_street_no" id="warehouse_street_no"
                                    value="{{ $profile_details->store->return_address->warehouse_street_no ?? '' }}"
                                    required>
                                <span class="float-right counter-text counter-val">0 / 20</span>
                            </div>

                            {{-- company building number --}}
                            <div class="col-md-6">
                                <label for="">Building Number:<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control mb-3 counter" maxlength="20"
                                    name="warehouse_building_no" id="warehouse_building_no"
                                    value="{{ $profile_details->store->return_address->warehouse_building_no ?? '' }}"
                                    required>
                                <span class="float-right counter-text counter-val">0 / 20</span>
                            </div>
                            {{-- company floor number --}}
                            <div class="col-md-6">
                                <label for="">Floor Number:<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control mb-3 counter" maxlength="20"
                                    name="warehouse_floor_no" id="warehouse_floor_no"
                                    value="{{ $profile_details->store->return_address->warehouse_floor_no ?? '' }}">
                                <span class="float-right counter-text counter-val">0 / 20</span>
                            </div>
                            {{-- company appartment number --}}
                            <div class="col-md-6">
                                <label for="warehouse_appartment_no">Appartment Number:<sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control mb-3 counter" maxlength="20"
                                    name="warehouse_appartment_no" id="warehouse_appartment_no"
                                    value="{{ $profile_details->store->return_address->warehouse_appartment_no ?? '' }}">
                                <span class="float-right counter-text counter-val">0 / 20</span>
                            </div>
                            {{-- address --}}
                            <div class="col-md-12">
                                <label for="">Address (Optional):</label>
                                <input type="text" class="form-control mb-3 counter" name="warehouse_address"
                                    id="warehouse_address" maxlength="255"
                                    value="{{ $profile_details->store->return_address->warehouse_address ?? '' }}">
                                <span class="float-right counter-text counter-val">0 / 255</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <a class="nav-link mb-sm-3 btn btn-primary save-tab float-right ml-5" id="save-tab"
                                data-toggle="tab" href="#save" role="tab" aria-controls="contact"
                                aria-selected="false">Next</a> --}}


        <a class="nav-link mb-sm-3 btn btn-primary float-right ml-3 bank-tab text-white"
            trigger-click="#save-tab">Next</a>

        @if (!$profile_status || !$profile_details->store)
            <button class="btn btn-success mb-4 float-right">
                Save As Draft
            </button>
        @endif
    </form>
</div>
