<div class="tab-pane fade" id="bank-info" role="tabpanel" aria-labelledby="bank-info">
    <form id="bankForm" action="{{ url('/vendor/bank-info') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h4 class="mt-4 mb-4">Bank Account Information
            @if ($profile_details->bank_account)
                <span class="badge badge-pill badge-success">Completed</span>
            @else
                <span class="badge badge-pill badge-danger">Incomplete</span>
            @endif
        </h4>

        {{-- bank name --}}
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="bank_name" class="d-inline"><b>Bank Name:<sup
                                class="text-danger">*</sup></b></label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control counter" maxlength="100" name="bank_name" id="bank_name"
                        required value="{{ $profile_details->bank_account->bank_name ?? null }}">
                    <span class="float-right counter-text counter-val">0 / 100</span>
                </div>
            </div>
        </div>
        {{-- Branch Code --}}
        <div class=" form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="branch_code" class="d-inline"><b>Branch Code:<sup
                                class="text-danger">*</sup></b></label>
                </div>
                <div class="col-md-6">
                    <input type="number" class="form-control counter" maxlength="10" min="0" name="branch_code"
                        id="branch_code" required value="{{ $profile_details->bank_account->branch_code ?? null }}">
                    <span class="float-right counter-text counter-val">0 / 10</span>
                </div>
            </div>
        </div>

        {{-- Account Title --}}
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="account_title" class="d-inline"><b> Account Title:<sup
                                class="text-danger">*</sup></b></label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control counter" maxlength="100" name="account_title"
                        id="account_title" value="{{ $profile_details->bank_account->account_title ?? null }}"
                        required>
                    <span class="float-right counter-text counter-val">0 / 100</span>
                </div>
            </div>
        </div>

        {{-- Account Number --}}
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="account_no" class="d-inline"><b> Account Number:<sup
                                class="text-danger">*</sup></b></label>
                </div>
                <div class="col-md-6">
                    <input type="number" class="form-control counter" maxlength="30" name="account_no" id="account_no"
                        required value="{{ $profile_details->bank_account->account_no ?? null }}">
                    <span class="float-right counter-text counter-val">0 / 30</span>

                </div>
            </div>
        </div>

        {{-- IBAN --}}
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="iban" class="d-inline"><b>IBAN:<sup class="text-danger">*</sup></b></label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control counter" maxlength="50" name="iban"
                        value="{{ $profile_details->bank_account->iban ?? null }}" required>
                    <span class="float-right counter-text counter-val">0 / 50</span>

                </div>
            </div>
        </div>

        {{-- Upload bank letter docs --}}
        <div class="form-group mt-4">
            <div class="row">
                <div class="col-md-3">
                    <label class="d-inline"><strong> Upload
                            Bank Letter:<sup class="text-danger">*</sup></strong></label>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-8">
                            <label for="bank_letter_doc" class="btn btn-primary btn-sm">Upload</label>
                            <input type="file" class="note-style" name="bank_letter_doc" id="bank_letter_doc"
                                title=" Upload Bank Letter" accept="application/pdf" onchange="bankLetter(this)" hidden
                                {{ !$profile_details->bank_account ? 'required' : '' }}>
                            <p id="bankLetter" class="mb-0">
                                <small>(Allows Only PDF file | Max Size : 2 MB)</small>
                            </p>
                            @if (!$profile_details->bank_account)
                                <p class="text-danger" id="bankDoc">
                                    Please upload bank letter document.
                                </p>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div class="float-right">
                                @if ($profile_details->bank_account)
                                    @if ($profile_details->bank_account->bank_letter_doc)
                                        <a href="{{ URL::to('vendor/doc/bank/preview/' . $profile_details->bank_account->bank_letter_doc) }}"
                                            target="_blank" rel="noopener noreferrer">
                                            <img src="https://img.icons8.com/fluent/28/000000/cloud-checked.png" />
                                            Preview
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <input type="hidden" name="redirect" class="redirect_input" value="">


        <a class="nav-link mb-sm-3 btn btn-primary float-right ml-3 bank-tab text-white"
            trigger-click="#store-tab">Next</a>

        @if (!$profile_status)
            <button class="btn btn-success float-right" id="bank-btn-save">
                Save As Draft
            </button>
        @endif
    </form>
</div>
