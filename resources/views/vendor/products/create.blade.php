@extends('vendor.layouts.master',['navItem'=>'products'])
@section('title', 'Add New Product')

@section('content')
    <style>
        .dynamic-table {
            width: 100%;
            overflow-y: hidden;
            max-width: 925px;
            overflow-x: auto;
        }

        .dynamic-table th,
        .dynamic-table td {
            white-space: nowrap;
            min-width: 150px;
        }

        .dynamic-table .dataTables_wrapper {
            width: 100%;
            margin: 0 auto;
        }

        .table-hover tbody tr:hover {
            background-color: #fff !important;
        }

        .delete-action {
            text-align: center;
        }

        .delete-action i {
            font-size: 24px;
            color: red;
            margin-top: 2px;
        }

        .dataTables_scroll div.dataTables_scrollBody table tbody tr td {
            vertical-align: top !important;
        }

        .table-listing {
            margin-top: 20px;
        }

        .select2-container-multi {
            padding: 3px;
        }

        .card-header h6 {
            margin: 0;
        }

        .add-row {
            display: inline-block;
            width: 100%;
            text-align: left;
            margin-top: 10px;
        }

        .card .table-listing {
            margin-top: 0;
        }

        .custom-padding-brand {
            padding-left: 4px;
        }

        #multiple-image {
            margin-top: 20px;
        }

        .delete-image i {
            font-size: 24px;
            color: red;
            margin-top: 5px;
            margin-left: 10px;
        }

        .image-info {
            margin-top: 20px;
            margin-right: 20px;
            padding: 10px;
            background-color: #efefef73;
            border-radius: 10px;
        }

        .counter-text {
            color: #c3c3c3;
            font-size: 10px;
            font-weight: 600;
        }

    </style>
    {{-- cropper css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.css"
        integrity="sha512-+VDbDxc9zesADd49pfvz7CgsOl2xREI/7gnzcdyA9XjuTxLXrdpuz21VVIqc5HPfZji2CypSbxx1lgD7BgBK5g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <div class="container-fluid">

        {{-- Error Messages - Alerts --}}
        @if (Session::has('errors'))
            @php $errors = Session::get('errors'); @endphp
{{--        @dd($errors)--}}
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
                <a href="{{ URL::to('/vendor/products') }}">Products</a> -
                <a href="#">Create</a>
            </h6>
        </div>

        <div class="row px-5">
            <div class="col-md-12">
                <div class="row">

                    {{-- form start --}}
                    <form method="POST" action="{{ URL::to('vendor/products') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- =================== Basic Information Section =================== --}}
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



                        {{-- ================== Product Attribute Section =================== --}}
                        {{-- ================================================================ --}}
                        <div class="col-md-12 p-0">
                            <div class="card">
                                <div class="card-header p-2 very-light-gray-bg shadow-sm">
                                    <h6><b>Product Attributes</b></h6>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <p class="mt-2 text-muted">Boost your item's searchability by filling-up the Key
                                            Product
                                            Information marked with
                                            KEY. The more you fill-up, the easier for buyers to find your product.
                                        </p>
                                    </div>
                                    <div class="col-md-12 border border-darken-1 p-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                {{-- Brand --}}
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label for="brand" class="control-label float-right">Brand<sup
                                                                class="text-danger">*</sup></label>
                                                    </div>
                                                    <div class="col-md-4 custom-padding-brand">
                                                        <select class="form-control show-tick ms " name="brand_id"
                                                            id="brands" required>
                                                            <option selected>Please Select</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                {{-- Attributes will be Appended --}}
                                                <div class="row" id="attributes-div">
                                                </div>
                                                <div style="display :block; margin-top: 40px; " class="text-center">

                                                    <button class="btn btn-primary " type="button"
                                                        id="show-more-attributes"> Load More
                                                    </button>
                                                    <button class="btn btn-primary " type="button" style="display : none;"
                                                        id="show-less-attributes"> Show Less </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- =================== Product Descriptions Section =================== --}}
                        <div class="col-md-12 p-0">
                            <div class="card">
                                <div class="card-header p-2 very-light-gray-bg shadow-sm">
                                    <h6><b>Descriptions</b></h6>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="row">
                                            {{-- Short Description --}}
                                            <div class="col-md-12 mb-4">
                                                <label for="short_desc" class="control-label">Short Description:<sup
                                                        class="text-danger">*</sup></label>
                                                <textarea class="form-control counter shortdescription" style="width:100%;" name="short_description"
                                                    id="short_description" rows="3" maxlength="255" required></textarea>
                                                <span class="float-right counter-text counter-val">0 / 255</span>

                                            </div>
                                            {{-- detailed description --}}
                                            <div class="col-md-12 mb-4">
                                                <label for="detailed_desc" class="control-label">Detailed
                                                    Description:</label>
                                                <textarea class="form-control description" name="detailed_description" id="detailed_description"></textarea>
                                            </div>
                                            {{-- Package Contents --}}
                                            <div class="col-md-12 mb-4">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label for="package_contents" class="">Package
                                                            Contents
                                                            <strong><sup
                                                                    class="
                                                            text-danger font-15">*</sup></strong></label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control counter"
                                                            name="package_contents" id="package_contents" maxlength="255"
                                                            required>
                                                        <span class="float-right counter-text counter-val">0 / 255</span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- =================== Product Images =================== --}}
                        <div class="col-md-12 p-0">
                            <div class="card">
                                <div class="card-header p-2 very-light-gray-bg shadow-sm">
                                    <h6><b>Product Images</b></h6>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <h6>Add Primary Image</h6>
                                            <div class="input-group mb-2">
                                                <input type="file" class="form-control p-1 w-25" name="primary_image"
                                                    id="primary_image" accept="image/png,image/jpg,image/jpeg," />
                                                {{-- <input type="file" class="form-control p-1" name="primary_image"
                                                    id="primary_image" accept="image/png,image/jpg,image/jpeg,"
                                                    onchange="primaryImage(this)" /> --}}
                                                <input type="hidden" name="primary_image_data" value="">

                                            </div>
                                            <p><small>Only PNG, JPEG, JPG File Allowed</small></p>
                                            <p class="d-none text-danger" id="backSide">Please upload Only PNG,
                                                JPEG, JPG File</p>

                                            <div class="row">
                                                <div class="primary-image-preview-box"
                                                    style="height: 200px; display:block;">
                                                    <img class="primary-image-preview" id="primary-image-preview"
                                                        style="height: 100%;" src="" alt="">
                                                </div>
                                                <div class="primary-image-cropped-box"
                                                    style="height: 200px; display:block;">
                                                    <img class="primary-image-cropped" id="primary-image-cropped"
                                                        style="height: 100%;" src="" alt="">
                                                </div>
                                            </div>

                                            <div class="add-row">
                                                <a href="javascript:void(0);" class="btn btn-primary add-new-image">Add New
                                                    Image</a>
                                            </div>
                                            <div class="image-info">
                                                <h6>Product detail screen images</h6>
                                                <ul>
                                                    <li>Add at least 3 images of your product from different angles.</li>
                                                    <li>Maximum 8 pictures are allowed.</li>
                                                    <li>Image dimensions should be between 500 x 500 and 2000 x 2000.</li>
                                                    <li>Obscene image is strictly prohibited.</li>
                                                    <li>Only png, jpeg, jpg file allowed.</li>
                                                    <li>Max size allowed for and image is 2 MB.</li>
                                                </ul>
                                            </div>
                                            {{-- Append Images Fields Here --}}
                                            <div id="multiple-image"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- =================== Price & Stock Section =================== --}}
                        <div class="col-md-12 p-0">
                            <div class="card">
                                <div class="card-header p-2 very-light-gray-bg shadow-sm">
                                    <h6><b>Price & Stock</b></h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-6">
                                            <div class="mb-3">
                                                <p>Decide SKU Attributes</p>
                                                <select name="sku_attributes[]" class="form-control show-tick ms select2"
                                                    multiple data-placeholder="Select" id="product-attribute-list">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="add-row">
                                        <a href="javascript:void(0);" class="btn btn-primary add-new-row-table">Add New
                                            SKU</a>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="table-listing">
                                            <div class="row">
                                                <div class="col-md-12 p-0">
                                                    <div class="dynamic-table">
                                                        <table id="add_sku"
                                                            class="table table-hover fixed-table render-table"
                                                            cellspacing="0" width="100%">
                                                            <thead class="render-header">
                                                                <tr>
                                                                    <th class="w-20 ">Availability</th>
                                                                    <th class="w-20 ">Image</th>
                                                                    <th class="dynamic-head">Price</th>
                                                                    <th>Special Price</th>
                                                                    <th>Quantity</th>
                                                                    <th>Seller sku</th>
                                                                    <th>Action
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="render-body">
                                                                <tr>

                                                                    <td class="">
                                                                        <select
                                                                            class="
                                                                        form-control"
                                                                            name="availability[]" id="">
                                                                            <option value="1">Available</option>
                                                                            <option value="0">Not Available</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <button type="button"
                                                                            class="btn btn-primary sku-image-btn">
                                                                            Add Sku Image
                                                                        </button>
                                                                        <img src="" class="row-sku-image-preview"
                                                                            style="height: 40px;" alt="">
                                                                        <input type="file" class=" sku-images"
                                                                            accept="image/png,image/jpg,image/jpeg,"
                                                                            style="display: none;" name="sku_images[]">
                                                                        <input type="text" class=" sku-images-data"
                                                                            style="display: none;" name="sku_images_data[]">
                                                                    </td>
                                                                    <td class="dynamic-content">

                                                                        <input type="number" class="form-control"
                                                                            name="price[]" id="" min="0"
                                                                            placeholder="Please Enter" required>
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" class="form-control"
                                                                            name="special_price[]" id="" min="0"
                                                                            placeholder="Please Enter" required>
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" class="form-control"
                                                                            name="quantity[]" id="" min="0"
                                                                            placeholder="Please Enter" required>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control"
                                                                            name="seller_sku[]" id="" min="0"
                                                                            placeholder="Please Enter" required>
                                                                    </td>


                                                                    <td>
                                                                        <div class="delete-action delete-row-table">
                                                                            <i class="fas fa-trash-alt"></i>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- =================== Service & Delivery Section =================== --}}
                        <div class="col-md-12 p-0">
                            <div class="card">
                                <div class="card-header p-2 very-light-gray-bg shadow-sm">
                                    <h6><b> Service & Delivery</b></h6>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="row">
                                            {{-- Service --}}
                                            <div class="col-md-12">
                                                <h6 class="mb-4"><b>Service</b></h6>
                                                <div id="services">

                                                    {{-- Warranty Type --}}
                                                    <div class="col-md-12 mb-4">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label for="warranty_type"
                                                                    class="control-label float-right">Warranty
                                                                    Type:<sup class="text-danger">*</sup>
                                                                </label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <select class="form-control show-tick ms "
                                                                    name="warranty_type" id="warranty_type" required>
                                                                    <option selected disabled>Please Select</option>
                                                                    <option value="1">No Warranty</option>
                                                                    <option value="2">Brand Warranty</option>
                                                                    <option value="3">Seller Warranty</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Warranty period id --}}
                                                    <div class="col-md-12 mb-4">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label for="warranty_period_id"
                                                                    class="control-label float-right">Warranty
                                                                    Period
                                                                </label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <select class="form-control show-tick ms"
                                                                    name="warranty_period_id" id="warranty_period_id"
                                                                    placeholder="">
                                                                    <option selected disabled>Please Select</option>
                                                                    @foreach ($warranty as $per)
                                                                        <option value="{{ $per->id }}">
                                                                            {{ $per->period }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Warranty Policy --}}
                                                    <div class="col-md-12 mb-4">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label for="warranty_policy"
                                                                    class="control-label float-right">Warranty Policy
                                                                </label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <textarea type="text" class="form-control counter" name="warranty_policy" id="warranty_policy" rows="5"
                                                                    maxlength="1000"></textarea>
                                                                <span class="float-right counter-text">0 /
                                                                    1000</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Delivery --}}
                                            <div class="col-md-12 mt-4">
                                                <h6 class="mb-4"><b>Delivery</b></h6>
                                                {{-- Package Weight (kg) --}}
                                                <div class="col-md-12 mb-4">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="package_weight"
                                                                class="control-label float-right">Package
                                                                Weight (kg)<sup class="text-danger">*</sup>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="number" step="0.10"
                                                                name="package_weight" id="package_weight" min="0" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Package Dimensions (cm) --}}
                                                <div class="col-md-12 mb-4">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="package_dimensions_lenght"
                                                                class="control-label float-right">Package
                                                                Dimensions
                                                                (cm)<sup class="text-danger">*</sup>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input class="form-control" type="number"
                                                                name="package_length" id="package_length" step="0.10"
                                                                placeholder="Lenght (cm)" min="0" required>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input class="form-control" type="number" step="0.10"
                                                                name="package_width" id="package_width"
                                                                placeholder="Width (cm)" min="0" required>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input class="form-control" type="number" step="0.10"
                                                                name="package_height" id="package_height"
                                                                placeholder="Height (cm)" min="0" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="delivery" class="collapse">
                                                    {{-- Dangerous Goods --}}
                                                    <div class="col-md-12 mb-4">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label for="dangerous_good"
                                                                    class="control-label float-right">Dangerous
                                                                    Goods<sup class="text-danger">*</sup>
                                                                </label>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select class="form-control show-tick ms"
                                                                    name="dangerous_good" id="dangeroud_goog"
                                                                    placeholder="">
                                                                    <option disabled>Please Select</option>
                                                                    <option value="1">None of Them</option>
                                                                    <option value="1">Flammable</option>
                                                                    <option value="3">Dangerous</option>
                                                                    <option value="4">Poisonous</option>
                                                                    <option value="5">Hazardous</option>
                                                                    <option value="6">Radio Active</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="span9 btn-block">
                                                    <a href="#delivery"
                                                        class="btn btn-large btn-block gray-btn-bg shadow-sm"
                                                        data-toggle="collapse"> More</a>
                                                </div> --}}
                                            </div>

                                        </div>
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

    <style>
        .modal-cropper-image {
            display: block;
            max-width: 100%;
        }

    </style>
    {{-- image selection cropper modal --}}
    <div class="modal fade" id="image-processing-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {{-- <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> --}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="make-center" style="width: fit-content;   margin: 0 auto;">
                                <img src="" class="modal-cropper-image" alt="" style="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <img src="" alt="" class="modal-cropper-image-prev" style="height: 180px; margin:0 auto; ">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
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
    <script>
        var cropper_primary_image = false;
        var modal_cropper_status = false;
        var cropper_primary_obj;
        var cropper;
        var imageProcessingModel = $('#image-processing-modal');
        var last_selected_row = '';
        // imageProcessingModel.modal('show');

        $(document).ready(function() {


            // handle sku-image-btn click  --selection for sku image
            $('body').on('click', '.sku-image-btn', function() {
                var row = $(this).parents('tr');

                // console.log(row.html());
                var file_input = row.find('.sku-images');
                file_input.trigger('click');
                // imageProcessingModel.modal('show');
            });

            $('body').on('change', '.sku-images', function(event) {
                var row = $(this).parents('tr');
                last_selected_row = row;
                var fileExtension = ['jpeg', 'jpg', 'png'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    // alert("Only formats are allowed : " + fileExtension.join(', '));
                    swal("Ops!", "Only formats are allowed : " + fileExtension.join(', '), "error");
                    $(this).val(null);

                } else {


                    // destroy_cropper_primary();
                    var reader = new FileReader();
                    reader.onload = function() {

                        imageProcessingModel.find('.modal-cropper-image').attr('src', reader.result);
                        if (modal_cropper_status) {
                            modal_cropper.replace(reader.result);
                            imageProcessingModel.modal('show');

                        } else {

                            modal_cropper_primary_obj = imageProcessingModel.find(
                                    '.modal-cropper-image')
                                .cropper({
                                    aspectRatio: 1 / 1,
                                    viewMode: 1,
                                    crop: function(event) {
                                        modal_cropper = imageProcessingModel.find(
                                            '.modal-cropper-image').data('cropper');
                                        var croppedData = modal_cropper.getCroppedCanvas()
                                            .toDataURL(
                                                'image/jpeg');
                                        imageProcessingModel.find('.modal-cropper-image-prev')
                                            .attr('src', croppedData);
                                        // console.log(croppedData);
                                        last_selected_row.find('.sku-images-data').val(
                                            croppedData);
                                        last_selected_row.find('.row-sku-image-preview').attr(
                                            'src',
                                            croppedData);
                                        modal_cropper_status = true;
                                    },
                                    move: function() {

                                        // console.log(croppedData);
                                    }
                                });
                            imageProcessingModel.modal('show');
                        }


                    };
                    reader.readAsDataURL(event.target.files[0]);
                }
            });





            // primary image preview
            $('#primary_image').change(function(event) {

                var fileExtension = ['jpeg', 'jpg', 'png'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    // alert("Only formats are allowed : " + fileExtension.join(', '));
                    swal("Ops!", "Only formats are allowed : " + fileExtension.join(', '), "error");
                    $(this).val(null);

                } else {

                    console.log('hit primary image')
                    // destroy_cropper_primary();
                    var reader = new FileReader();
                    reader.onload = function() {
                        var output = document.getElementById('primary-image-preview');
                        output.src = reader.result;
                        if (cropper_primary_image) {
                            cropper.replace(reader.result);
                        } else {

                            cropper_primary_obj = $('#primary-image-preview').cropper({
                                aspectRatio: 1 / 1,
                                crop: function(event) {
                                    cropper = $('#primary-image-preview').data('cropper');
                                    var croppedData = cropper.getCroppedCanvas().toDataURL(
                                        'image/jpeg');
                                    $('#primary-image-cropped').attr('src', croppedData);
                                    // console.log(croppedData);
                                    $('[name=primary_image_data]').val(croppedData);
                                    cropper_primary_image = true;
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


            $('body').on('change', '.detail-image-validate', function() {
                var fileExtension = ['jpeg', 'jpg', 'png'];

                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    // alert("Only formats are allowed : " + fileExtension.join(', '));
                    swal("Ops!", "Only formats are allowed : " + fileExtension.join(', '), "error");
                    $(this).val(null);
                }
            });


            function destroy_cropper_primary() {
                if (cropper_primary_image) {
                    // cropper_primary_obj.destroy();
                    cropper.destroy();
                }
            }

            function replace_url(url) {

            }

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
                width: 980,


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

            // TEXT EDITOR
            $('.shortdescription').summernote({
                placeholder: 'write details here ....',
                tabsize: 2,
                height: 350,
                width: 980,

                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],

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

        $('#childcategory').change(function(e) {

            let childcategoryId = $(this).val();
            // $('#product-attribute-list').empty();
            getBrandsByChildCat(childcategoryId);

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


                var selected_attr = sku_attributes_list.find(at => at.id == attr);
                // console.log("selected attr", selected_attr);

                var options = "";
                selected_attr.keys.forEach(function(key) {
                    options = options + ` <option value="${key.id}" >${key.name}</option>`;
                });


                var label = selected_attr.title;
                // console.log(label);
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

        // $('body').on('change', '#product-attribute-list', function() {

        //     $('.dynamic-col').remove();
        //     var selections = $(this).val(); // ARRAY OF SELECTED ATTRIBUTES
        //     console.log('selections');
        //     console.log(selections);

        //     var table = $('body').find('.render-table');
        //     var header = table.find('.render-header');
        //     var table_col = header.find('tr').first().find('th').first();
        //     var body = table.find('.render-body');

        //     // var col-placehodler = body.
        //     selections.forEach(function(attr) {
        //         var selected_element = $(`#${attr}`);
        //         var options = selected_element.html();
        //         console.log('attr');
        //         console.log(attr);

        //         var label = selected_element.attr('callerName');
        //         console.log(label);
        //         table_col.after(`
    //         <th class="dynamic-col">${label}</th>
    //     `);
        //         body.find('tr').each(function() {
        //             var box = $(this).find('td').first();
        //             box.after(`
    //             <td class="dynamic-col">
    //                 <div class="form-group">
    //                     <select id="${unique_string(8)}" class="form-control" name="${attr}[]">
    //                         ${options}
    //                     </select>
    //                 </div>
    //             </td>
    //         `);
        //         });
        //     });
        // });

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
                    <input type="file" class="form-control p-1 detail-image-validate" id="inputGroupFile01" name="images[]" accept="image/png,image/jpg,image/jpeg,"
                         />
                    <div class="delete-image"><i class="fas fa-trash-alt"></i></div>
                </div>
        `);
        });
        $('#multiple-image').on('click', '.delete-image', function() {
            $(this).parent().remove();
        });
    </script>

@endsection
