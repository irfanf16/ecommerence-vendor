<div class="tab-pane fade text-center" id="save" role="tabpanel" aria-labelledby="save">
    <div class="col-md-12 float-right mt-5">
        @if ($profile_status == 1)
            <h1 class="text-">Profile is Under Review !</h1>
            <img class="py-3" src="{{ URL::to('/vendor/images/default/review.svg') }}" />
            <br><br>
            <h4 class="col-lg-6 mx-auto pb-5">You have successfully completed your profile
                information.
                Please wait until profile verification process is completed.
            </h4>
        @else
            <h2>Review Your Profile Information</h2>

            <!-- Basic Information -->
            <div class="row">
                <div class="col-lg-12">
                    <h5 class="mt-3 text-left">Basic Profile Information
                        @if ($profile_details)
                            <span class="badge badge-pill badge-success">Completed</span>
                        @else
                            <span class="badge badge-pill badge-danger">Incomplete</span>
                        @endif
                    </h5>

                    <table class="table table-bordered">
                        <tr>
                            <th>Name:</th>
                            <td>{{ $profile_details->name }}</td>
                            <th>Email:</th>
                            <td>{{ $profile_details->email }}</td>
                            <th>Mobile Number:</th>
                            <td>{{ $profile_details->mobile }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>

            <!-- Business Information -->
            <div class="row">
                <div class="col-lg-12">
                    <h5 class="mt-3 text-left">Business Information
                        @if ($profile_details->business_info)
                            <span class="badge badge-pill badge-success">Completed</span>
                        @else
                            <span class="badge badge-pill badge-danger">Incomplete</span>
                        @endif
                    </h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Company
                                Name</th>
                            <td>{{ $profile_details->business_info->company_name ?? null }}
                            </td>

                            <th>Select ID Type</th>
                            <td>ID</td>

                            <th>Person ID Number</th>
                            <td>{{ $profile_details->business_info->person_id_no ?? null }}
                            </td>

                        </tr>
                        <tr>

                            <th>Person Incharge Name</th>
                            <td>{{ $profile_details->business_info->person_incharge_name ?? null }}
                            </td>

                            <th>Person Incharge
                                Mobile</th>
                            <td>{{ $profile_details->business_info->person_incharge_mobile ?? null }}
                            </td>

                            <th>Person Incharge
                                Email:</th>
                            <td>{{ $profile_details->business_info->person_incharge_email ?? null }}
                            </td>
                        </tr>
                        {{-- <tr>
                          <th>Address</th>
                          @if ($profile_details->business_info)
                              <td colspan="6">
                                  {{ 'Appartment #' . $profile_details->business_info->company_appartment_no . ', Floor #' . $profile_details->business_info->company_floor_no . ', Building #' . $profile_details->business_info->company_building_no . ',  Street #' . $profile_details->business_info->company_street_no . ', Zone #' . $profile_details->business_info->company_zone_no . ', ' . $profile_details->business_info->city->name . ' , QATAR' }}
                  </td>

                  @else
                  <td colspan="6"></td>
                  @endif
                  </tr> --}}
                        <tr>
                            <th>Country</th>
                            <td>QATAR</td>

                            <th>City</th>
                            <td>{{ $profile_details->business_info->city->name ?? null }}
                            </td>

                            <th>Zone Number</th>
                            <td>{{ $profile_details->business_info->company_zone_no ?? null }}
                            </td>

                        </tr>
                        <tr>
                            <th>Street Number</th>
                            <td>{{ $profile_details->business_info->company_street_no ?? null }}
                            </td>

                            <th>Building Number</th>
                            <td>{{ $profile_details->business_info->company_building_no ?? null }}
                            </td>

                            <th>Floor Number</th>
                            <td>{{ $profile_details->business_info->company_floor_no ?? null }}
                            </td>

                        </tr>
                        <tr>
                            <th>Apartment Number</th>
                            <td>{{ $profile_details->business_info->company_appartment_no ?? null }}
                            </td>

                            <th>Address (Optional)</th>
                            <td colspan="4">
                                {{ $profile_details->business_info->company_address ?? null }}
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
            <br>

            <!-- Bank Information -->
            <div class="row">
                <div class="col-lg-12">
                    <h5 class="mt-3 text-left">Bank Account Information
                        @if ($profile_details->bank_account)
                            <span class="badge badge-pill badge-success">Completed</span>
                        @else
                            <span class="badge badge-pill badge-danger">Incomplete</span>
                        @endif
                    </h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Account Title</th>
                            <td>{{ $profile_details->bank_account->account_title ?? null }}
                            </td>

                            <th>Account Number:</th>
                            <td>{{ $profile_details->bank_account->account_no ?? null }}
                            </td>

                            <th>Bank Name</th>
                            <td>{{ $profile_details->bank_account->bank_name ?? null }}</td>
                        </tr>
                        <tr>
                            <th>Branch Code</th>
                            <td>{{ $profile_details->bank_account->branch_code ?? null }}
                            </td>

                            <th>IBAN</th>
                            <td colspan="3">
                                {{ $profile_details->bank_account->iban ?? null }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>

            <!--Store Information -->
            <div class="row">
                <div class="col-lg-12">
                    <h5 class="mt-3 text-left">Store Information
                        @if ($profile_details->store)
                            <span class="badge badge-pill badge-success">Completed</span>
                        @else
                            <span class="badge badge-pill badge-danger">Incomplete</span>
                        @endif
                    </h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Store Name</th>
                            <td>{{ $profile_details->store->store_name ?? null }}</td>

                            <th>Category</th>
                            <td>{{ $profile_details->store->category->title ?? null }}</td>

                            <th>Holiday Mode</th>
                            @if ($profile_details->store)
                                <td>{{ $profile_details->store->holiday_mode ? 'On' : 'Off' }}
                                </td>
                            @else
                                <td></td>
                            @endif
                        </tr>
                        <tr>
                            <th>Tagline</th>
                            <td colspan="6">{{ $profile_details->store->tag_line ?? null }}
                            </td>
                        </tr>
                        <tr>
                            <th>Short Desc</th>
                            <td colspan="6">
                                {{ $profile_details->store->short_description ?? null }}
                            </td>
                        </tr>
                        <tr>
                            <th>Detailed Desc</th>
                            <td colspan="6">
                                {{ $profile_details->store->short_description ?? null }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>

            <!-- Warehouse Information -->
            <div class="row">
                <div class="col-lg-12">
                    <h5 class="mt-3 text-left">Warehouse Address
                        @if ($profile_details->store)
                            @if ($profile_details->store->warehouse_address)
                                <span class="badge badge-pill badge-success">Completed</span>
                            @else
                                <span class="badge badge-pill badge-danger">Incomplete</span>
                            @endif
                        @else
                            <span class="badge badge-pill badge-danger">Incomplete</span>
                        @endif
                    </h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Warehouse
                                Name</th>
                            <td>{{ $profile_details->store->warehouse_address->warehouse_name ?? null }}
                            </td>

                            <th>Contact Email</th>
                            <td>{{ $profile_details->store->warehouse_address->warehouse_email ?? null }}
                            </td>

                            <th>Mobile
                                Number</th>
                            <td>{{ $profile_details->store->warehouse_address->warehouse_phone_no ?? null }}
                            </td>
                        </tr>
                        <tr>
                            {{-- <th>Address</th>
                          @if ($profile_details->store)
                              <td colspan="6">
                                  {{ 'Appartment #' . $profile_details->store->warehouse_address->warehouse_appartment_no . ', Floor #' . $profile_details->store->warehouse_address->warehouse_floor_no . ', Building #' . $profile_details->store->warehouse_address->warehouse_building_no . ',  Street #' . $profile_details->store->warehouse_address->warehouse_street_no . ', Zone #' . $profile_details->store->warehouse_address->warehouse_zone_no . ', ' . $profile_details->store->warehouse_address->city->name . ' , QATAR' }}
                      </td>

                      @else
                      <td colspan="6"></td>
                      @endif --}}
                            <th>Country</th>
                            <td>QATAR</td>

                            <th>City</th>
                            <td>{{ $profile_details->store->warehouse_address->city->name ?? null }}
                            </td>
                            <th>Zone Number</th>
                            <td>{{ $profile_details->store->warehouse_address->warehouse_zone_no ?? null }}
                            </td>

                        </tr>
                        <tr>
                            <th>Street Number</th>
                            <td>{{ $profile_details->store->warehouse_address->warehouse_street_no ?? null }}
                            </td>

                            <th>Building Number</th>
                            <td>{{ $profile_details->store->warehouse_address->warehouse_building_no ?? null }}
                            </td>

                            <th>Floor Number</th>
                            <td>{{ $profile_details->store->warehouse_address->warehouse_floor_no ?? null }}
                            </td>

                        </tr>
                        <tr>
                            <th>Apartment Number</th>
                            <td>{{ $profile_details->store->warehouse_address->warehouse_appartment_no ?? null }}
                            </td>
                            <th>Address (Optional)</th>
                            <td colspan="4">
                                {{ $profile_details->store->warehouse_address->warehouse_address ?? null }}
                            </td>

                        </tr>
                    </table>
                </div>
            </div>
            <br>

            <!--Return Warehouse Address -->
            <div class="row">
                <div class="col-lg-12">
                    <h5 class="mt-3 text-left">Return Warehouse Address
                        @if ($profile_details->store)
                            @if ($profile_details->store->warehouse_address)
                                <span class="badge badge-pill badge-success">Completed</span>
                            @else
                                <span class="badge badge-pill badge-danger">Incomplete</span>
                            @endif
                        @else
                            <span class="badge badge-pill badge-danger">Incomplete</span>
                        @endif
                    </h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Warehouse
                                Name</th>
                            <td>{{ $profile_details->store->return_address->warehouse_name ?? null }}
                            </td>

                            <th>Contact Email</th>
                            <td>{{ $profile_details->store->return_address->warehouse_email ?? null }}
                            </td>

                            <th>Mobile
                                Number</th>
                            <td>{{ $profile_details->store->return_address->warehouse_phone_no ?? null }}
                            </td>
                        </tr>
                        <tr>
                            {{-- <th>Address</th>
                          @if ($profile_details->store)
                              <td colspan="6">
                                  {{ 'Appartment #' . $profile_details->store->return_address->warehouse_appartment_no . ', Floor #' . $profile_details->store->return_address->warehouse_floor_no . ', Building #' . $profile_details->store->return_address->warehouse_building_no . ',  Street #' . $profile_details->store->return_address->warehouse_street_no . ', Zone #' . $profile_details->store->return_address->warehouse_zone_no . ', ' . $profile_details->store->return_address->city->name . ' , QATAR' }}
                      </td>

                      @else
                      <td colspan="6"></td>
                      @endif --}}

                            <th>Country</th>
                            <td>QATAR</td>

                            <th>City</th>
                            <td>{{ $profile_details->store->return_address->city->name ?? null }}
                            </td>
                            <th>Zone Number</th>
                            <td>{{ $profile_details->store->return_address->warehouse_zone_no ?? null }}
                            </td>

                        </tr>
                        <tr>
                            <th>Street Number</th>
                            <td>{{ $profile_details->store->return_address->warehouse_street_no ?? null }}
                            </td>

                            <th>Building Number</th>
                            <td>{{ $profile_details->store->return_address->warehouse_building_no ?? null }}
                            </td>
                            <th>Floor Number</th>
                            <td>{{ $profile_details->store->return_address->warehouse_floor_no ?? null }}
                            </td>

                            </td>
                        </tr>
                        <tr>
                            <th>Apartment Number</th>
                            <td>{{ $profile_details->store->return_address->warehouse_appartment_no ?? null }}
                            </td>

                            <th>Address (Optional)</th>
                            <td colspan="4">
                                {{ $profile_details->store->return_address->warehouse_address ?? null }}

                        </tr>
                    </table>
                    <br>
                    <hr>

                    {{-- Uploaded Files --}}
                    <h2 class="my-5">Uploaded Files</h2>

                    {{-- Business Incharge Docs --}}
                    <div class="row bg-files mb-5">
                        <h5 class="col-12 text-left p-0">
                            Business Incharge Documents
                            @if ($profile_details->business_info)
                                @if ($profile_details->business_info->person_id_front_image && $profile_details->business_info->person_id_back_image)
                                    <span class="badge badge-pill badge-success">Completed</span>
                                @else
                                    <span class="badge badge-pill badge-danger">Incomplete</span>
                                @endif
                            @else
                                <span class="badge badge-pill badge-danger">Incomplete</span>
                            @endif
                        </h5>
                        {{-- ID - Front Side --}}
                        <div class="col-md-4">
                            <div class="row">
                                <h6 class="col-12 text-left cust-font">ID - Front Side</h6>
                                @if ($profile_details->business_info)
                                    <img src="{{ config('app.url') . 'storage/vendor/documents/id-front/lg/' . $profile_details->business_info->person_id_front_image }}"
                                        class="mw-100" style="height: 120px;" />

                                @else
                                    <img src="{{ URL::to('vendor/images/default/default_photo.svg') }}"
                                        class="mw-100" />
                                @endif
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        {{-- ID - Back Side --}}
                        <div class="col-md-4">
                            <div class="row">
                                <h6 class="col-12 text-left cust-font">ID - Back Side</h6>
                                @if ($profile_details->business_info)
                                    <img src="{{ config('app.url') . 'storage/vendor/documents/id-back/lg/' . $profile_details->business_info->person_id_back_image }}"
                                        class="mw-100" style="height: 120px;" />
                                @else
                                    <img src="{{ URL::to('vendor/images/default/default_photo.svg') }}"
                                        class="mw-100" />

                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Business Documents --}}
                    <div class="row bg-files mb-5">
                        <h5 class="col-12 text-left p-0">
                            Business Documents
                            @if ($profile_details->business_info)
                                @if ($profile_details->business_info->business_docs)
                                    <span class="badge badge-pill badge-success">Completed</span>
                                @else
                                    <span class="badge badge-pill badge-danger">Incomplete</span>
                                @endif
                            @else
                                <span class="badge badge-pill badge-danger">Incomplete</span>
                            @endif
                        </h5>
                        @foreach ($documents as $document)
                            <div class="col-md-12">
                                <div class="row">
                                    @foreach ($document->active_inputs as $active_input)
                                        <h6 class="col-6 text-left p-0">
                                            {{ $active_input->input_name }}
                                        </h6>
                                        @if ($profile_details->business_info)
                                            @if ($profile_details->business_info->business_docs)
                                                <a href='{{ URL::to("vendor/doc/preview/$active_input->id") }}'
                                                    target="_blank" rel="noopener noreferrer">
                                                    <img
                                                        src="https://img.icons8.com/fluent/28/000000/cloud-checked.png" />
                                                    Preview
                                                </a>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Store Documents --}}
                    <div class="row bg-files mb-5">
                        <h5 class="col-12 text-left p-0">
                            Store Documents
                            @if ($profile_details->store)
                                @if ($profile_details->store->logo_image && $profile_details->store->cover_image)
                                    <span class="badge badge-pill badge-success">Completed</span>
                                @else
                                    <span class="badge badge-pill badge-danger">Incomplete</span>
                                @endif
                            @else
                                <span class="badge badge-pill badge-danger">Incomplete</span>
                            @endif
                        </h5>
                        {{-- logo image --}}
                        <div class="col-md-4">
                            <div class="row">
                                <h6 class="col-12 text-left cust-font">Store Logo</h6>
                                @if ($profile_details->store)
                                    <img src="{{ config('app.url') . 'storage/store/logo/lg/' . $profile_details->store->logo_image }}"
                                        class="" style="height: 120px;" />
                                @else
                                    <img src="{{ URL::to('vendor/images/default/default_photo.svg') }}"
                                        class="mw-100" />
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <h6 class="col-12 text-left cust-font">Store Cover</h6>
                                @if ($profile_details->store)
                                    <img src="{{ config('app.url') . 'storage/store/cover/lg/' . $profile_details->store->cover_image }}"
                                        class="mw-100" style="height: 120px;" />
                                @else
                                    <img src="{{ URL::to('vendor/images/default/default_photo.svg') }}"
                                        class="mw-100" />
                                @endif
                            </div>
                        </div>
                    </div>

                    <br>
                    <form action="{{ url('/vendor/save-review') }}" method="post">
                        @csrf
                        <div class="custom-control custom-checkbox mb-3 mt-n2 float-left">
                            <input type="checkbox" name="disclaimer" class="custom-control-input" id="customCheck1"
                                required>
                            <label class="custom-control-label text-bold" for="customCheck1"><b>I
                                    acknowledge that provided information is accurate and true
                                    as per my
                                    knowledge.</b>
                                <br>
                                <p class="text-danger">* You won't be able to change any
                                    information once you click
                                    submit button below.</p>
                            </label>
                        </div>
                        <br>
                        <div class="col-md-12 mt-5">
                            {{-- $profile_details->business_info && $profile_details->bank_info && $documents && $profile_details->store && $profile_details->store->warehouse_address && $profile_details->store->return_address --}}
                            @if (1 == 1)
                                <button class="btn btn-tertiary btn-lg float-right"
                                    {{ $profile_status ? 'disabled' : '' }}>SUBMIT</button>
                            @else
                                <button class="btn btn-tertiary btn-lg float-right" disabled>SUBMIT</button>
                            @endif
                        </div>
                    </form>

                </div>
            </div>
        @endif
    </div>
</div>
