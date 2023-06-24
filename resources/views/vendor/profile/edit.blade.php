@extends('vendor.layouts.master', ['navItem' => 'settings'])
@section('title', ' Your Profile')

@section('head')
    {{-- cropper css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.css"
        integrity="sha512-+VDbDxc9zesADd49pfvz7CgsOl2xREI/7gnzcdyA9XjuTxLXrdpuz21VVIqc5HPfZji2CypSbxx1lgD7BgBK5g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <div class="container-fluid">

        {{-- Its for mobile number field to remove the arrow from the number input field --}}
        <style>
            .number-with-country select {
                position: absolute;
                left: 0;
                top: 0;
                z-index: 9;
                width: 105px;
                border: none;
                background: #fbfbfb;
                bottom: 0;
                border-radius: 10px 0px 0px 10px;
            }

            .number-with-country select:focus-visible {
                border: none;
                outline: none;
            }

            .number-with-country .input-group input {
                padding-left: 115px !important;
            }

            .number-with-country .input-group input:focus {
                border: none !important;
            }

            /* Chrome, Safari, Edge, Opera */
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            /* Firefox */
            input[type=number] {
                -moz-appearance: textfield;
            }

            .previous-tab,
            .next-tab {
                display: inline-block;
                border: 1px solid #444348;
                border-radius: 3px;
                margin: 5px;
                color: #444348;
                font-size: 14px;
                padding: 10px 15px;
                cursor: pointer;
            }

            .nav-pills {
                position: relative;
                overflow-x: auto;
                overflow-y: hidden;
                height: 48px;
                width: 100%;
                background-color: #fff;
                margin: 0 auto;
                white-space: nowrap;
                display: block;
            }

            .nav-pills li.nav-item {
                display: inline-block;
            }

            .counter-text {
                color: #c3c3c3;
                font-size: 10px;
                font-weight: 600;
            }

            .min-hit-500 {
                min-height: 500px;
            }

            .cust-font {
                font-size: 15px;
                padding: 0px;
                font-weight: 800;
            }

            .bg-files {
                background-color: #d9d9d933;
                padding: 20px;
            }

            .step-complete {
                height: 40px;
                width: 40px;
                border-radius: 50%;
                background-color: green;
                color: white;
                margin: 0 auto;
                display: grid;
                align-items: center;
                text-align: center;
                margin-bottom: 5px;
            }

            .step-incomplete {
                height: 40px;
                width: 40px;
                border-radius: 50%;
                background-color: gray;
                color: white;
                margin: 0 auto;
                display: grid;
                align-items: center;
                text-align: center;
                margin-bottom: 5px;
            }

        </style>

        <!-- END -->


        {{-- Error Messages - Custom Validation Errors Code --}}
        {{-- @if (count($errors) > 0)
    @php $errors = Session::get('errors'); @endphp
    <div class="card bg-danger" id="alertBox">
        <div class="card-header bg-danger text-white">
            <strong>Errors - Please Resolve These FIrst</strong>
            <a href="#" id="alertCloseBtn" class="float-right text-white alert-close-btn">X</a>
        </div>
        <div class="card-body p-0">
            <ul>
                @foreach ($errors as $error)
                    <li class="text-white">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif --}}
        {{-- @if ($errors->count() > 0)
        <p>The following errors have occurred:</p>

        <ul>
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    @endif --}}


        {{-- --------------- Alert => Vendor Profile Status  ---------------- --}}
        {{-- ---------------------------------------------------------------- --}}
        @if ($profile_status == 0)
            <div class="custom-notification danger card">
                <div class="notification-content">
                    <h2>Incomplete Profile Information !</h2>
                    <p>Please complete your profile first </p>
                </div>
            </div>
        @elseif($profile_status == 1)
            <div class="custom-notification warning card">
                <div class="notification-content">
                    <h2>Profile Information Under Review !</h2>
                    <p>Please wait until profile verification process is completed</p>
                </div>
            </div>
        @elseif($profile_status == 3)
            <div class="custom-notification danger card">
                <div class="notification-content">
                    <h2>Update Profile Information!</h2>
                    <p>Please update your profile information.</p>
                </div>
            </div>
        @endif

        {{-- PRINT ERROR MESSAGES --}}
        @if ($message = Session::get('errors'))
            @php
                $count = count($message);
            @endphp
            <div class="alert alert-danger alert-block" id="ErrorAlertMessage">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="text-white">Attention please !</h4>
                @for ($i = 0; $i < $count; $i++)
                    <strong>{{ $message[$i] }}</strong><br>
                @endfor
            </div>
        @endif

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block" id="SuccessAlertMessage">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        {{-- THS BUTTON IS FOR ALTERNATIVE TAB --}}
        {{-- <a class="btn btn-outline-primary " href="{{ url('vendor/apna_tab') }}">Dummy tabs</a> --}}
        {{-- {{ dd($profile_details) }} --}}

        <div class="card min-hit-500">

            <div class="card-header  pb-0">
                <ul class="nav nav-pills  font-15 font-weight-700 " style="height: 90px;" id="myTab" role="tablist">
                    <li class="nav-item">
                        <div class=" {{ $profile_details ? 'step-complete' : 'step-incomplete' }}" style=" ">
                            1
                        </div>
                        <a class="nav-link mb-sm-3 seller-info active" id="seller-tab" data-toggle="tab" href="#seller-info"
                            role="tab" aria-controls="seller-info" aria-selected="true">Basic
                            Information</a>
                    </li>
                    <li class="nav-item">
                        <div class="{{ $profile_details->business_info ? 'step-complete' : 'step-incomplete' }}">
                            2
                        </div>
                        <a class="nav-link mb-sm-3 business-info" id="business-tab" data-toggle="tab" href="#business-info"
                            role="tab" aria-controls="business-info" aria-selected="false">Business Information</a>
                    </li>
                    <li class="nav-item">
                        @if ($profile_details->business_info)
                            @if ($profile_details->business_info->business_docs)
                                @php $b_docs = true; @endphp
                            @else
                                @php $b_docs = false; @endphp
                            @endif
                        @else
                            @php $b_docs = false; @endphp
                        @endif
                        <div class="{{ $b_docs ? 'step-complete' : 'step-incomplete' }}">
                            3
                        </div>
                        <a class="nav-link mb-sm-3 document-info" id="document-tab" data-toggle="tab" href="#documents"
                            role="tab" aria-controls="documents" aria-selected="false">
                            Documents</a>
                    </li>
                    <li class="nav-item">
                        <div class="{{ $profile_details->bank_account ? 'step-complete' : 'step-incomplete' }}">
                            4
                        </div>
                        <a class="nav-link mb-sm-3 bank-info" id="bank-tab" data-toggle="tab" href="#bank-info" role="tab"
                            aria-controls="bank-info" aria-selected="false">Bank
                            Account</a>
                    </li>
                    <li class="nav-item">
                        <div class="{{ $profile_details->store ? 'step-complete' : 'step-incomplete' }}">
                            5
                        </div>
                        <a class="nav-link mb-sm-3 store-info" id="store-tab" data-toggle="tab" href="#store-info"
                            role="tab" aria-controls="store-info" aria-selected="false">Store Information</a>
                    </li>
                    <li class="nav-item">
                        <div
                            class="{{ isset($profile_details->store->warehouse_address) ? 'step-complete' : 'step-incomplete' }}">
                            6
                        </div>
                        <a class="nav-link mb-sm-3 warehouse-info" id="warehouse-tab" data-toggle="tab" href="#warehouse"
                            role="tab" aria-controls="warehouse" aria-selected="false">Warehouse Address</a>
                    </li>

                    <li class="nav-item">
                        <div
                            class="{{ isset($profile_details->store->return_address) ? 'step-complete' : 'step-incomplete' }}">
                            7
                        </div>
                        <a class="nav-link mb-sm-3 return-info" id="return-tab" data-toggle="tab" href="#return-warehouse"
                            role="tab" aria-controls="return-warehouse" aria-selected="false">Return Address</a>
                    </li>
                    <li class="nav-item">
                        <div class="{{ $profile_details ? 'step-complete' : 'step-incomplete' }}">
                            8
                        </div>
                        <a class="nav-link mb-sm-3 save-info" id="save-tab" data-toggle="tab" href="#save" role="tab"
                            aria-controls="save" aria-selected="false">Review and Submit</a>
                    </li>

                </ul>
            </div>


            <div class="card-body pt-0">
                <div class="col-md-12">
                    <div class="tab-content descendants" id="myTabContent">

                        {{-- ----------------  Basic Information Section --------------- --}}
                        {{-- ----------------------------------------------------------- --}}
                        @include('vendor.profile.partials.basic_information')


                        {{-- ---------------  Business Information Section ------------- --}}
                        {{-- ----------------------------------------------------------- --}}
                        @include('vendor.profile.partials.business_information')



                        {{-- ----------------  Business Documents Section -------------- --}}
                        {{-- ----------------------------------------------------------- --}}
                        @include('vendor.profile.partials.business_documents')



                        {{-- ------------  Bank-Account Information Section ------------ --}}
                        {{-- ------------------------------------------------------------- --}}
                        @include('vendor.profile.partials.bank_account_information')



                        {{-- ----------------  Store Information Section --------------- --}}
                        {{-- ------------------------------------------------------------- --}}
                        @include('vendor.profile.partials.store_information')



                        {{-- ---------  Warehouse-Address Information Section ---------- --}}
                        {{-- ------------------------------------------------------------- --}}
                        @include('vendor.profile.partials.warehouse_address_information')



                        {{-- ----------  Return-Address Information Section ------------ --}}
                        {{-- ------------------------------------------------------------- --}}
                        @include('vendor.profile.partials.return_address_information')


                        {{-- ----------  Review And Submit Information Section ----------- --}}
                        {{-- ------------------------------------------------------------- --}}
                        @include('vendor.profile.partials.review_submit_information')


                    </div>
                </div>
            </div>


        </div>

    </div>
@endsection
@section('customScripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"
        integrity="sha512-ooSWpxJsiXe6t4+PPjCgYmVfr1NS5QXJACcR/FPpsdm6kqG1FmQ2SVyg2RXeVuCRBLr0lWHnWJP6Zs1Efvxzww=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cropper/1.0.1/jquery-cropper.min.js"
        integrity="sha512-V8cSoC5qfk40d43a+VhrTEPf8G9dfWlEJgvLSiq2T2BmgGRmZzB8dGe7XAABQrWj3sEfrR5xjYICTY4eJr76QQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ url('vendor/js/formautofill.js') }}"></script>


    <script>
        $("#alertCloseBtn").click(function(e) {
            e.preventDefault();
            $("#alertBox").hide();
        });

        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();


            // trigger click

            $('[trigger-click]').click(function() {
                var clickable = $(this).attr('trigger-click');
                $(clickable).trigger('click');
            });


        });





        // Disable Warehouse Address
        // $("#warehouse-btn").attr('disabled', true);

        // Preview Person ID Images Before it is Uploaded Using jQuery
        // Front Side Of Person Id
        function frontImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#front_preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#person_id_front_image").change(function() {
            frontImage(this);
        });


        // Back Side Of Person Id
        function backImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#back_preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#person_id_back_image").change(function() {
            backImage(this);
        });


        // Preview LOGO  and Cover Images Before it is Uploaded Using jQuery
        // Logo Image
        function logoImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#logo_preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#logo_image").change(function() {
            logoImage(this);
        });


        // Cover Image
        function coverImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#cover_preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#cover_image").change(function() {
            coverImage(this);
        });


        //Triggers of Holiday mode
        $("#holiday_mode").change(function() {

            if (this.checked) {
                // $(".holiday_mode_date").removeAttr('readonly');
                $(".holiday-date-block").show();
                $("#holiday_start_date").prop("disabled", false);
                $("#holiday_end_date").prop("disabled", false);

            } else {
                $(".holiday-date-block").hide();

                // $(".holiday_mode_date").attr("readonly", "true");
                $("#holiday_start_date").prop("disabled", true);
                $("#holiday_end_date").prop("disabled", true);

            }


        });


        //Success alert message for a specific time
        $(function() {
            var duration = 3000; // 3 seconds
            setTimeout(function() {
                $('#SuccessAlertMessage').hide();
            }, duration);
        });


        // disable earlier dates of start and end date of holiday mode
        $(function() {
            var dtToday = new Date();

            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if (month < 10)
                month = '0' + month.toString();
            if (day < 10)
                day = '0' + day.toString();

            var maxDate = year + '-' + month + '-' + day;
            // alert(maxDate);
            $('#holiday_start_date').attr('min', maxDate);
            $('#holiday_end_date').attr('min', maxDate);

        });


        // if Auto-Fill vendor select Same Warehouse Address as Return Warehouse Address
        $("#warehouse_check").bind("change", function() {
            if (this.checked) {
                var data = {
                    "warehouse_name": $('#warehouse_name').val(),
                    "warehouse_email": $('#warehouse_email').val(),
                    "warehouse_phone_no": $('#warehouse_phone_no').val(),
                    "return_warehouse_city_id": $('#warehouse_city_id').val(),
                    "warehouse_zone_no": $('#warehouse_zone_no').val(),
                    "warehouse_street_no": $('#warehouse_street_no').val(),
                    "warehouse_building_no": $('#warehouse_building_no').val(),
                    "warehouse_floor_no": $('#warehouse_floor_no').val(),
                    "warehouse_appartment_no": $('#warehouse_appartment_no').val(),
                    "warehouse_address": $('#warehouse_address').val(),
                }
                console.log(data['return_warehouse_city_id']);
                $("#return_warehouse_city_id").val(data['return_warehouse_city_id']).attr("selected",
                    "selected");
                $("#return_warehouse_address").autofill(data);
                $('#return_warehouse :input').attr('readonly', true);

            } else {
                $('#return_warehouse :input').removeAttr('readonly');
            }

        });


        //To store last position of openend tab
        $(document).ready(function() {
            $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });
            var activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                $('#myTab a[href="' + activeTab + '"]').tab('show');
            }
        });
    </script>
    <script>
        // -------------file validation jquery--------------------
        // file validations for Business information tab
        function frontSide(sender) {
            if (sender.value.endsWith(".jpg") || sender.value.endsWith(".png") || sender.value.endsWith(
                    ".jpeg")) {
                $("#business-btn-save").attr("disabled", false);
                if ($('#person_id_front_image')[0].files[0].size > 2000000) {
                    sender.value = "";
                    $("#business-btn-save").attr("disabled", true);
                    $("#frontSide").html('Image size must be 2Mb').addClass('text-danger');
                } else {
                    $("#frontSide").html('');
                    $("#business-btn-save").attr("disabled", false);
                }
            } else {
                sender.value = "";
                $("#frontSide").html('Only PNG, JPEG, JPG File Allowed').addClass('text-danger');
                $("#business-btn-save").attr("disabled", true);
            }
        }

        function backSide(sender) {
            if (sender.value.endsWith(".jpg") || sender.value.endsWith(".png") || sender.value.endsWith(
                    ".jpeg")) {
                $("#business-btn-save").attr("disabled", false);
                if ($('#person_id_front_image')[0].files[0].size > 2000000) {
                    sender.value = "";
                    $("#business-btn-save").attr("disabled", true);
                    $("#backSide").html('Image size must be 2Mb').addClass('text-danger');
                } else {
                    $("#backSide").html('');
                    $("#business-btn-save").attr("disabled", false);
                }

            } else {
                sender.value = "";
                $("#backSide").html('Only PNG, JPEG, JPG File Allowed').addClass('text-danger');
                $("#business-btn-save").attr("disabled", true);
            }
        }


        // File validations for Bank account tab
        function bankLetter(sender) {
            if (sender.value.endsWith(".pdf")) {
                $("#bank-btn-save").attr("disabled", false);
                if ($('#bank_letter_doc')[0].files[0].size > 2000000) {
                    $("#bank-btn-save").attr("disabled", true);
                    sender.value = "";
                    $("#bank-btn-save").attr("disabled", true);
                    $("#bankLetter").html('File size must be equal of less tahn 2 MB').addClass('text-danger');
                } else {
                    $("#bankLetter").html('');
                    $("#bank-btn-save").attr("disabled", false);
                    $("#bankDoc").addClass("d-none");
                }
            } else {
                sender.value = "";
                $("#bankLetter").html('Please upload Only PDF File').addClass('text-danger');
                $("#bank-btn-save").attr("disabled", true);

            }
        }

        // Business Document Validations
        $(".business-doc").change(function(e) {
            e.preventDefault();

            var allowedExtensions = ['jpeg', 'jpg', 'png', 'pdf'];
            var fileName = $(this).val().split('.').pop().toLowerCase();
            var fileSize = $(this)[0].files[0].size;

            // VALIDATE FILE-TYPE
            if ($.inArray(fileName, allowedExtensions) == -1) {
                $(this).next().html("<small class='text-danger'>Only formats are allowed are " +
                    allowedExtensions
                    .join(', ') + "</small>");
                $(this).val(null);
            }

            // VALIDATE FILE-SIZE
            else if (fileSize > 2000000) {
                $(this).next().html(
                    "<small class='text-danger'>File size must be equal or less than 2 MB.</small>");
                $(this).val(null);
            } else {
                $(this).next().html("");
            }
        });


        // file validations for Store information tab
        // function storeLogo(sender) {
        //     // if (sender.value.endsWith(".jpg") || sender.value.endsWith(".png") || sender.value.endsWith(
        //     //         ".jpeg")) {
        //     //     $("#store-save-btn").attr("disabled", false);
        //     //     if ($('#logo_image')[0].files[0].size > 2000000) {
        //     //         $("#storeLogo").attr("disabled", true);
        //     //         sender.value = "";
        //     //         $("#store-save-btn").attr("disabled", true);
        //     //         $("#storeLogo").html('File size must be 2Mb').addClass('text-danger');
        //     //     } else {
        //     //         $("#store-save-btn").attr("disabled", false);
        //     //         $("#storeLogo").html('');
        //     //     }
        //     // } else {
        //     //     sender.value = "";
        //     //     $("#storeLogo").html('Only PNG, JPEG, JPG File Allowed').addClass('text-danger');
        //     //     $("#store-save-btn").attr("disabled", true);

        //     // }
        // }

        var cropper_store_logo_image = false;

        $('#logo_image').change(function(event) {
            var fileExtension = ['jpeg', 'jpg', 'png'];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                // alert("Only formats are allowed : " + fileExtension.join(', '));
                swal("Ops!", "Only formats are allowed : " + fileExtension.join(', '), "error");
                $(this).val(null);

            } else {

                console.log('hit Store Logo')
                // destroy_cropper_primary();
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.getElementById('logo_preview');
                    output.src = reader.result;
                    if (cropper_store_logo_image) {
                        cropper.replace(reader.result);
                    } else {

                        cropper_primary_obj = $('#logo_preview').cropper({
                            aspectRatio: 1 / 1,
                            crop: function(event) {
                                cropper = $('#logo_preview').data('cropper');
                                var croppedData = cropper.getCroppedCanvas().toDataURL(
                                    'image/jpeg');
                                $('#logo_preview_cropped').attr('src', croppedData);
                                // console.log(croppedData);
                                $('[name=logo_image_data]').val(croppedData);
                                cropper_store_logo_image = true;
                            },
                            move: function() {

                                // console.log(croppedData);
                            }
                        });
                    }


                };
                reader.readAsDataURL(event.target.files[0]);
            }
        });


        // function storeCover(sender) {
        //     if (sender.value.endsWith(".jpg") || sender.value.endsWith(".png") || sender.value.endsWith(
        //             ".jpeg")) {
        //         $("#store-save-btn").attr("disabled", false);
        //         // file size
        //         if ($('#cover_image')[0].files[0].size > 2000000) {
        //             $("#store-save-btn").attr("disabled", true);
        //             sender.value = "";
        //             $("#storeCover").attr("disabled", true);
        //             $("#storeCover").html('File size must be 2Mb').addClass('text-danger');
        //         } else {
        //             $("#storeCover").html('');
        //             $("#store-save-btn").attr("disabled", false);
        //         }

        //     } else {
        //         sender.value = "";
        //         $("#store-save-btn").attr("disabled", true);
        //         $("#storeCover").html('Only PNG, JPEG, JPG File Allowed').addClass('text-danger');
        //     }
        // }

        var cropper_store_cover_image = false;

        $('#cover_image').change(function(event) {
            var fileExtension = ['jpeg', 'jpg', 'png'];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                // alert("Only formats are allowed : " + fileExtension.join(', '));
                swal("Ops!", "Only formats are allowed : " + fileExtension.join(', '), "error");
                $(this).val(null);

            } else {

                console.log('hit Store Logo')
                // destroy_cropper_primary();
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.getElementById('cover_preview');
                    output.src = reader.result;
                    if (cropper_store_cover_image) {
                        cover_cropper.replace(reader.result);
                    } else {

                        cropper_cover_obj = $('#cover_preview').cropper({
                            aspectRatio: 3 / 4,
                            crop: function(event) {
                                cover_cropper = $('#cover_preview').data('cropper');
                                var croppedDataCover = cover_cropper.getCroppedCanvas().toDataURL(
                                    'image/jpeg');
                                $('#cover_preview_cropped').attr('src', croppedDataCover);
                                // console.log(croppedData);
                                $('[name=cover_image_data]').val(croppedDataCover);
                                cropper_store_cover_image = true;
                            },
                            move: function() {

                                // console.log(croppedData);
                            }
                        });
                    }


                };
                reader.readAsDataURL(event.target.files[0]);
            }
        });


        // INITIALIZE ALL INPUTS WITH EDIT-LENGTH
        $('.counter').each(function() {
            var length = $(this).val().length;
            var maxLength = $(this).attr('maxlength');

            $(this).next().text(length + " / " + maxLength);
        });

        // CHARACTERS COUNTER
        $(".counter").keyup(function(e) {
            var length = $(this).val().length;
            var value = $(this).val();
            var maxlength = $(this).attr("maxlength");
            var form = $(this).closest('form').attr('id');


            if (length >= maxlength) {
                $(this).next().addClass("text-danger");
            } else {
                $(this).next().removeClass("text-danger");
            }


            if (length > maxlength) {
                $(this).val(value.substr(0, maxlength));
                $(`#${form}`).find("button").attr('disabled', true);
            } else {
                $(`#${form}`).find("button").attr('disabled', false);
                $(this).next().text(length + "/" + maxlength);
            }
        });

        // MOBILE VERIFY
        $("mobile_verify").click(function() {

            alert('fds');
            var mobile = $('#mobile').val();
            console.log(mobile);
            var url = "/verify-phone";
            $.ajax({
                url: url,
                type: "post",

                data: {
                    _token: '{{ csrf_token() }}',
                    'mobile': mobile,
                },
                success: function(data) {
                    console.log(data, "successfully send");
                }
            }).done(function() {
                // this part will run when we send and return successfully
                console.log("Success.");
            }).fail(function() {
                // this part will run when an error occurres
                console.log("An error has occurred.");
            }).always(function() {
                // this part will always run no matter what
                console.log("Complete.");
            });
        });
    </script>


    {{-- disable the warehouse address and return warehouse address tabs On incomplete store inforamation --}}
    @if (!$profile_details->store)
        <script>
            $('#return_warehouse :input').attr('disabled', true);
            $('#warehouseAddress :input').attr('disabled', true);
        </script>
    @else
        <script>
            $('#return_warehouse :input').attr('disabled', false);
            $('#warehouseAddress :input').attr('disabled', false);
        </script>

    @endif


    {{-- Add Required attribute in person_id_front_image and person_id_back_image of business info if not upload file or new user --}}
    @if ($profile_details->business_info)
        @if ($profile_details->business_info->person_id_front_image && $profile_details->business_info->person_id_back_image)
            <script>
                $("#person_id_front_image").prop("required", false);
                $("#person_id_back_image").prop("required", false);
            </script>
        @endif
    @else
        <script>
            $("#person_id_front_image").prop("required", true);
            $("#person_id_back_image").prop("required", true);
        </script>
    @endif


    {{-- Add Required attribute in logo_image and cover_image of store info if not upload file or new user --}}
    @if ($profile_details->business_info)
        @if ($profile_details->business_info->person_id_front_image && $profile_details->business_info->person_id_back_image)
            <script>
                $("#logo_image").prop("required", false);
                $("#cover_image").prop("required", false);
            </script>
        @endif
    @else
        <script>
            $("#logo_image").prop("required", true);
            $("#cover_image").prop("required", true);
        </script>
    @endif


    {{-- Add Required attribute in  of bank info if not upload file or new user --}}
    @if ($profile_details->bank_account)
        @if ($profile_details->bank_account->bank_letter_doc)
            <script>
                $("#bank-btn-save").attr("required", false);
            </script>
        @endif
    @else
        <script>
            $("#bank-btn-save").attr("required", true);
        </script>
    @endif



@endsection
