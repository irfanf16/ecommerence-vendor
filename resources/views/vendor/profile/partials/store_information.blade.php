<div class="tab-pane fade" id="store-info" role="tabpanel" aria-labelledby="store-info">
    <form action="{{ url('/vendor/store-info') }}" method="POST" enctype="multipart/form-data" id="store-info">
        @csrf

        <h4 class="mt-4 mb-4">Store Information
            @if ($profile_details->store)
                <span class="badge badge-pill badge-success">Completed</span>
            @else
                <span class="badge badge-pill badge-danger">Incomplete</span>
            @endif
        </h4>

        {{-- Saller ID --}}
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="seller_id" class="d-inline"><b>Seller ID:</b></label>
                </div>
                <div class="col-md-6">
                    <label for="seller_id">NA</label>
                </div>
            </div>
        </div>

        {{-- Store Name: --}}
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="store_name" class="d-inline">
                        <b> Store Name:<sup class="text-danger">*</sup></b>
                    </label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control counter" maxlength="100" name="store_name" id="store_name"
                        required value="{{ $profile_details->store->store_name ?? null }}">
                    <span class="float-right counter-text counter-val">0 / 100</span>
                </div>
            </div>
        </div>

        {{-- Tagline: --}}
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="tag_line" class="d-inline"><b> Tagline:</b></label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control counter" maxlength="255" name="tag_line" id="tag_line"
                        value="{{ $profile_details->store->tag_line ?? null }}">
                    <span class="float-right counter-text counter-val">0 / 255</span>
                </div>
            </div>
        </div>

        {{-- Category --}}
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="category">
                        <strong>Category:</strong>
                    </label>
                </div>
                <div class="col-md-6">
                    <select class="form-control" name="category_id" id="category_id">
                        <option value="">Select Category</option>
                        @if ($profile_details->store)
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $profile_details->store->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        @else
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->title }}
                                </option>
                            @endforeach

                        @endif
                    </select>
                </div>
            </div>
        </div>

        {{-- Short Description: --}}
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="short_description" class="d-inline">
                        <b>Short Description:<sup class="text-danger">*</sup></b>
                    </label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control counter" maxlength="255" name="short_description"
                        id="short_description" value="{{ $profile_details->store->short_description ?? '' }}"
                        required>
                    <span class="float-right counter-text counter-val">0 / 255</span>
                </div>
            </div>
        </div>
        {{-- detailed Description: --}}
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="detailed_description" class="d-inline"><b>Detailed
                            Description:</b></label>
                </div>
                <div class="col-md-6">
                    <textarea class="form-control counter" maxlength="500" name="detailed_description"
                        id="detailed_description"
                        rows="6">{{ $profile_details->store->detailed_description ?? null }}</textarea>
                    <span class="float-right counter-text counter-val">0 / 500</span>

                </div>
            </div>
        </div>
        {{-- Store Logo --}}
        <div class="form-group mt-5">
            <div class="row">
                <div class="col-md-3">
                    <label class="d-inline">
                        <strong> Upload Store Logo:
                            <sup class="text-danger">*</sup>
                        </strong>
                    </label>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-9">
                            <label for="logo_image" class="btn btn-primary btn-sm">Upload</label>
                            <input type="file" class="note-style" name="logo_image" id="logo_image"
                                accept="image/png,image/jpg,image/jpeg," hidden>
                            <input type="hidden" name="logo_image_data" id="logo_image_data">
                            <p id="storeLogo">
                                <small>( Only PNG, JPEG, JPG File Allowed | Max Size : 2 MB )
                                </small>
                            </p>
                        </div>
                        <div class="col-md-3">
                            @if ($profile_details->store)
                                @if ($profile_details->store->logo_image)
                                    <img id="logo_preview"
                                        src="{{ config('app.url') . 'storage/store/logo/lg/' . $profile_details->store->logo_image }}"
                                        class="img-fluid ml-2 float-left rounded" width="150px" height="50px" />
                                    <img src="" id="logo_preview_cropped" style="height: 200px;" alt="">
                                @else
                                    <img id="logo_preview"
                                        src="{{ URL::to('vendor/images/default/default_photo.svg') }}"
                                        class="img-fluid ml-2 float-left border border-dark-grey rounded" width="150px"
                                        height="230px" />
                                    <img src="" id="logo_preview_cropped" style="height: 200px;" alt="">

                                @endif
                            @else
                                <img id="logo_preview" src="{{ URL::to('vendor/images/default/default_photo.svg') }}"
                                    class="img-fluid ml-2 float-left border border-dark-grey rounded" width="150px"
                                    height="230px" />
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Store Cover --}}
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label class="d-inline"><strong> Upload Store
                            Cover:<sup class="text-danger">*</sup></strong></label>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="cover_image" class="btn btn-primary btn-sm">Upload</label>
                            <input type="file" class="note-style" name="cover_image" id="cover_image"
                                accept="image/png,image/jpg,image/jpeg," hidden>
                            <input type="hidden" name="cover_image_data" id="cover_image_data">
                            <p id="storeCover"><small>( Only PNG, JPEG, JPG File | Max Size : 2
                                    MB )</small></p>
                        </div>
                        <div class="col-md-6">
                            @if ($profile_details->store)
                                @if ($profile_details->store->cover_image)
                                    <img id="cover_preview"
                                        src="{{ config('app.url') . 'storage/store/cover/lg/' . $profile_details->store->cover_image }}"
                                        class="ml-2 float-left " width="250px" height="130px" />
                                    <img src="" id="cover_preview_cropped" style="height: 200px;" alt="">


                                @else
                                    <img id="cover_preview"
                                        src="{{ URL::to('vendor/images/default/default_photo.svg') }}"
                                        class=" ml-2 float-left" width="250px" height="130px" />
                                    <img src="" id="cover_preview_cropped" style="height: 200px;" alt="">

                                @endif
                            @else
                                <img id="cover_preview"
                                    src="{{ URL::to('vendor/images/default/default_photo.svg') }}"
                                    class=" ml-2 float-left" width="250px" height="130px" />
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Holiday Mode --}}
        <div class="row mb-3">
            <label for="" class="col-sm-3 col-form-label"><b>Holiday Mode <i class="fa fa-question-circle"
                        title="If enabled then store will be go offine and your products will be snooze for specific time period "></i></b></label>
            @if ($profile_details->store)
                <label class="toggle-switch ml-3">
                    <input name="holiday_mode" id="holiday_mode" type="checkbox"
                        {{ $profile_details->store->holiday_mode == 1 ? 'checked' : '' }}>
                    <span class="toggle-switch-slider rounded-circle"></span>
                </label>

            @else
                <label class="toggle-switch ml-3">
                    <input name="holiday_mode" id="holiday_mode" type="checkbox">
                    <span class="toggle-switch-slider rounded-circle"></span>
                </label>

            @endif
            <p class="pl-3 text-danger"><small>( If enabled then store will be go
                    offine)</small>
            </p>

        </div>

        <div class="holiday-date-block " style="display:none;">

            {{-- HOLIDAY START DATE --}}
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label for="banner_image" class="d-inline"><b> Holiday Start
                                Date:</b></label>
                    </div>
                    <div class="col-md-6">
                        @if ($profile_details->store)

                            <input type="date" class="form-control holiday_mode_date" name="holiday_start_date"
                                id="holiday_start_date" value="{{ $profile_details->store->holiday_start_date }}"
                                {{ $profile_details->store->holiday_mode == 0 ? 'disabled' : '' }}>

                        @else
                            <input type="date" class="form-control holiday_mode_date" name="holiday_start_date"
                                id="holiday_start_date" value="" disabled>

                        @endif
                    </div>
                </div>
            </div>
            {{-- Holiday end date: --}}
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label for="end date" class="d-inline"><b> Holiday End
                                Date:</b></label>
                    </div>
                    <div class="col-md-6">
                        @if ($profile_details->store)
                            <input type="date" class="form-control holiday_mode_date" name="holiday_end_date"
                                id="holiday_end_date" value="{{ $profile_details->store->holiday_end_date }}"
                                {{ $profile_details->store->holiday_mode == 0 ? 'disabled' : '' }}>
                        @else
                            <input type="date" class="form-control holiday_mode_date" name="holiday_end_date"
                                id="holiday_end_date" value="" disabled>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        {{-- <a class="nav-link mb-sm-3 btn btn-primary float-right ml-3 warehouse-tab"
           id="warehouse-tab" data-toggle="tab" href="#warehouse" role="tab"
           aria-controls="contact" aria-selected="false">Next</a> --}}


        <a class="nav-link mb-sm-3 btn btn-primary float-right ml-3 bank-tab text-white"
            trigger-click="#warehouse-tab">Next</a>
        {{-- {{ dd($profile_status) }} --}}
        {{-- @if (!$profile_status) --}}
        <button class="btn btn-success float-right" id="store-save-btn">
            Save As Draft
        </button>
        {{-- @endif --}}
    </form>
</div>
