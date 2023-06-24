<div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents">
    <form action="{{ url('/vendor/documents') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- ALERT --}}
        @if (!$profile_details->business_info)
            <div class="custom-notification danger card mt-3 bg-lighter">
                <div class="notification-content">
                    <h2>Incomplete Business Information</h2>
                    <p class="text-capitalize">Please Complete Your Business Information First</p>
                </div>
            </div>
        @endif

        <fieldset class="{{ !$profile_details->business_info ? '' : '' }}">
            <h4 class="mt-4 mb-4">Business Documents
                @if ($profile_details->business_info)
                    @if ($profile_details->business_info->business_docs)
                        <span class="badge badge-pill badge-success">Completed</span>
                    @else
                        <span class="badge badge-pill badge-danger">Incomplete</span>
                    @endif
                @else
                    <span class="badge badge-pill badge-danger">Incomplete</span>
                @endif
            </h4>

            @foreach ($documents as $document)
                <div>
                    <h5 class="mb-3"><strong>{{ $document->document_title }}</strong>
                    </h5>
                    @foreach ($document->active_inputs as $active_input)
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="company_cr_name"
                                        class="d-inline text-capitalize"><strong>{{ $active_input->input_name }}:<sup
                                                class="text-danger">*</sup></strong></label>
                                </div>
                                <div class="col-md-6">
                                    {{-- PASSED TO DETECT MISSING FILES SO THAT WE CAN ASSING NULL VALUES AGAINST THEM --}}
                                    <input type="hidden" name="doc_list[{{ $active_input->id }}]">

                                    <input type="{{ $active_input->input_type }}" class="form-control business-doc"
                                        name="document[{{ $active_input->id }}]" id="{{ $active_input->id }}"
                                        {{ !$profile_details->business_info ? 'disabled' : '' }}
                                        accept="image/png,image/jpg,image/jpeg,application/pdf"
                                        {{ in_array($active_input->id, $business_document_available) ? '' : 'required' }}>
                                    <p class="businessDocAlert">
                                        <small class="text-muted ">Only PNG, JPEG, JPG and PDF
                                            File Allowed | Max File Size : 2 MB</small>
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    @if ($profile_details->business_info)
                                        @if ($profile_details->business_info->business_docs)
                                            <a href='{{ URL::to("vendor/doc/preview/$active_input->id") }}'
                                                target="_blank" rel="noopener noreferrer">
                                                <img src="https://img.icons8.com/fluent/28/000000/cloud-checked.png" />
                                                Preview
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr>
            @endforeach

            <input type="hidden" name="redirect" class="redirect_input" value="">


            <a class="nav-link mb-sm-3 btn btn-primary float-right ml-3 bank-tab text-white"
                trigger-click="#bank-tab">Next</a>


            @if (!$profile_status || !$profile_details->business_info)
                <button class="btn btn-success mb-4 float-right" id="businessDocBtn">
                    Save As Draft
                </button>
            @endif
    </form>
</div>
