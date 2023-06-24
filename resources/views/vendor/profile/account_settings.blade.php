@extends('vendor.layouts.master',['navItem'=>'settings'])
@section('title', 'Edit Account Settings')

@section('content')
    <div class="container-fluid">

        {{-- Error Messages - Alerts --}}
        @if (Session::has('errors'))
            @php $errors = Session::get('errors'); @endphp
            @foreach ($errors as $error)
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Sorry! </strong>{{ $error }}
                </div>
            @endforeach
        @endif

        {{-- warning message row --}}
        @if (!$has_store)
            <div class="custom-notification danger card mx-4">
                <a href="{{ URL::to('/vendor/profile/edit') }}" title="Go To Profile Edit Page">
                    <div class="notification-content">
                        <h2>Store Information Missing!</h2>
                        <p>To add a product please fill your store information first!</p>
                    </div>
                </a>
            </div>
        @endif

        {{-- breadcrumb row --}}
        <div class="row px-5 pb-3">
            <h6>
                <a href="{{ URL::to('/vendor/dashboard') }}">Home</a> -
                <a href="{{ URL::to('/vendor/products') }}">Account Settings</a>
            </h6>
        </div>

        <div class="row px-5">
            <div class="col-md-12">
                <div class="row">

                    <form method="POST" action="{{ URL::to('vendor/products') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12 p-0">
                            <div class="card">
                                <div class="card-header p-2 very-light-gray-bg shadow-sm">
                                    <h6><b>Basic Information</b> </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        {{-- Store Id --}}
                                        <input type="hidden" name="store_id" value="{{ $has_store }}">

                                        {{-- Product Name --}}
                                        <div class="col-md-12 mb-4">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label class="control-label-lg" for="name">Product Name<sup
                                                            class="text-danger">*</sup></label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" name="name" id="name" class="form-control counter"
                                                        placeholder="" maxlength="255" required>
                                                    <span class="float-right counter-text counter-val">0 / 255</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-4">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="category">Category<sup
                                                            class="text-danger">*</sup></label>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="row">
                                                        {{-- Category --}}
                                                        <div class="col-md-4">
                                                            <select class="form-control show-tick ms " name="category_id"
                                                                id="category" required>
                                                                <option selected>Select Category</option>
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}">
                                                                        {{ $category->title }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        {{-- Subcategory --}}
                                                        <div class="col-md-4 d-none">
                                                            <select class="form-control show-tick ms " name="subcategory_id"
                                                                id="subcategory" required>
                                                                <option selected>Select Subcategory</option>
                                                            </select>
                                                        </div>
                                                        {{-- Childcategory --}}
                                                        <div class="col-md-4 d-none">
                                                            <select class="form-control show-tick ms "
                                                                name="childcategory_id" id="childcategory">
                                                                <option selected>Select Childcategory</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Video Url --}}
                                        {{-- <div class="col-md-12 mb-4">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label class="control-label-lg" for="videoUrl">Video URL</label>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="url" name="video_url" id="video_url" class="form-control"
                                                    placeholder="">
                                            </div>
                                        </div>
                                    </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button id="sumbitBtn" type="submit" class="btn btn-primary float-right">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('customScripts')
    <script>
        $(document).ready(function() {

            // IF NOT-STORE
            let store = "<?php echo $has_store; ?>";
            if (!store) {
                $("#sumbitBtn").attr('disabled', true);
            }

            // TEXT EDITOR
            $('.description').summernote({
                placeholder: 'write details here ....',
                tabsize: 2,
                height: 350,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['codeview', 'help']]
                ]
            });

        });


        // INPUT-CHARACTERS LENGTH COUNTER
        $(".counter").keyup(function(e) {
            var length = $(this).val().length;
            var maxLength = $(this).attr('maxlength');
            $(this).next().text(length + " / " + maxLength);

            if (length > maxLength) {
                $("#sumbitBtn").attr('disabled', true);
            } else {
                $("#sumbitBtn").attr('disabled', false);
            }
        });


        // WARRANTY-TYPE VALIDATION
        $("#warranty_type").change(function(e) {
            e.preventDefault();
            if ($(this).val() == 1) {
                $("#warranty_period_id").attr('disabled', true);
            } else {
                $("#warranty_period_id").attr('disabled', false);
            }
        });


        // GET SPECIFIC SUBCATEGORIES-BRANDS
        $('#category').change(function(e) {
            if (!$("#childcategory").parent().hasClass('d-none')) {
                $("#childcategory").parent().addClass('d-none');
            }
            $("#subcategory").parent().removeClass('d-none');

            $("#subcategory").empty();
            $("#childcategory").empty();
            let categoryId = $(this).val();
            getSubCatsBrands(categoryId);
        });

        // GET SPECIFIC CHILDCATEGORIES-ATTRIBUTES
        $('#subcategory').change(function(e) {
            if (!$("#childcategory").parent().hasClass('d-none')) {
                $("#childcategory").parent().addClass('d-none');
            }
            let subcategoryId = $(this).val();
            $('#product-attribute-list').empty();
            getChildCatsAttr(subcategoryId);

        });



        // FUNTION TO GENERATE RANDOM STRING
        function unique_string(length) {
            var randomChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var result = '';
            for (var i = 0; i < length; i++) {
                result += randomChars.charAt(Math.floor(Math.random() * randomChars.length));
            }
            return result;
        }

        // APPEND SKU ATTRIBUTES COLUMNS IN TABLE DYNAMICALLY
        $('body').on('change', '#product-attribute-list', function() {

            $('.dynamic-col').remove();
            var selections = $(this).val(); // ARRAY OF SELECTED ATTRIBUTES
            console.log('selections');
            console.log(selections);

            var table = $('body').find('.render-table');
            var header = table.find('.render-header');
            var table_col = header.find('tr').first().find('th').first();
            var body = table.find('.render-body');

            // var col-placehodler = body.
            selections.forEach(function(attr) {
                var selected_element = $(`#${attr}`);
                var options = selected_element.html();
                console.log('attr');
                console.log(attr);

                var label = selected_element.attr('callerName');
                console.log(label);
                table_col.after(`
                <th class="dynamic-col">${label}</th>
            `);
                body.find('tr').each(function() {
                    var box = $(this).find('td').first();
                    box.after(`
                    <td class="dynamic-col">
                        <div class="form-group">
                            <select id="${unique_string(8)}" class="form-control" name="${attr}[]">
                                ${options}
                            </select>
                        </div>
                    </td>
                `);
                });
            });
        });

        $('.add-new-row-table').click(function() {
            var table = $('body').find('.render-table');
            var body = table.find('.render-body');
            var firstrow = body.find('tr').first().html();
            body.append(`
            <tr>
                ${firstrow}
            </tr>
        `);
        });
        $('body').on('click', '.delete-row-table', function() {
            // alert('delete');
            // $(this).css('background-color', 'red');
            var count = $('.render-body').find('tr').length;
            console.log(count);
            if (count > 1) {

                $(this).parents('tr').remove();
            }
        });
        $('.add-new-image').click(function() {
            var body = $('#multiple-image');
            body.append(`
                <div class="input-group mb-2">
                    <input type="file" class="form-control p-1" id="inputGroupFile01" name="images[]" accept="image/png,image/jpg,image/jpeg,"
                        onchange="backSide(this)" />
                    <div class="delete-image"><i class="fas fa-trash-alt"></i></div>
                </div>
        `);
        });
        $('#multiple-image').on('click', '.delete-image', function() {
            $(this).parent().remove();
        });
    </script>

@endsection
