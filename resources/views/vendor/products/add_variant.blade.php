@extends('vendor.layouts.master',['navItem'=>'products'])
@section('title', 'Add new variant')

@section('content')


    @php
    $product_edit = false;
    $variant_edit = false;

    if (isset($_GET['product']) && $_GET['product'] == 'true') {
        $product_edit = true;
    }

    if (isset($_GET['variant']) && $_GET['variant'] == 'true') {
        $variant_edit = true;
    }

    // dd($product_edit);

    @endphp


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
            @foreach ($errors as $error)
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Sorry! </strong>{{ $error }}
                </div>
            @endforeach
        @endif

        {{-- breadcrumb row --}}
        <div class="row px-5 pb-3">
            <h6>
                <a href="{{ URL::to('/vendor/dashboard') }}">Home</a> -
                <a href="{{ URL::to('/vendor/products') }}">Products</a> -
                <a href="#">Add Variant</a>
            </h6>
        </div>

        <div class="row px-5">
            <div class="col-md-12">
                <div class="row">

                    {{-- form start --}}
                    <form method="POST"
                        action='{{ URL::to('vendor/products/' . $variant->product->id . '/add-variant') }}'
                        enctype="multipart/form-data">
                        @csrf
                        {{-- @method('PUT') --}}




                        {{-- =================== Add new Variant =================== --}}
                        {{-- ============================================================= --}}
                        <div class="col-md-12 p-0">
                            <div class="card">
                                <div class="card-header p-2 very-light-gray-bg shadow-sm">
                                    <h6><b>Add Variant</b></h6>
                                </div>
                                <div class="card-body">

                                    <div class="col-md-12">
                                        <div class="table-listing">
                                            {{-- <div class="add-row">
                                                <a href="javascript:void(0);" class="btn btn-primary add-new-row-table">Add
                                                    New
                                                    SKU</a>
                                            </div> --}}
                                            <div class="row">
                                                <div class="col-md-12 p-0">
                                                    <div class="dynamic-table">
                                                        <table id="add_sku"
                                                            class="table table-hover fixed-table render-table"
                                                            cellspacing="0" width="100%">
                                                            <thead class="render-header">
                                                                <tr>
                                                                    <th class="w-20 ">Availability</th>
                                                                    <th>Sku Image</th>
                                                                    @foreach ($variant->product->product_attributes as $attr)
                                                                        <th>{{ $attr->attribute_detail->title }}</th>
                                                                    @endforeach
                                                                    <th class="dynamic-head">Price</th>
                                                                    <th>Special Price</th>
                                                                    <th>Quantity</th>
                                                                    <th>Seller SKU</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="render-body">
                                                                <tr>
                                                                    <td class="">
                                                                        <select class="form-control" name="availability">
                                                                            <option value="1">
                                                                                Available
                                                                            </option>
                                                                            <option value="0">
                                                                                Not Available
                                                                            </option>
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
                                                                            style="display: none;" name="sku_images"
                                                                            required>
                                                                        <input type="text" class=" sku-images-data"
                                                                            style="display: none;" name="sku_images_data">
                                                                    </td>
                                                                    @foreach ($attributes as $attr)
                                                                        {{-- {{ dd($attr) }} --}}
                                                                        <td class="">
                                                                            <select class="form-control">

                                                                                @foreach ($attr->keys as $key)
                                                                                    <option>{{ $key->name }}
                                                                                    </option>
                                                                                @endforeach

                                                                            </select>
                                                                        </td>
                                                                    @endforeach
                                                                    <td class="dynamic-content">
                                                                        <input type="number" class="form-control"
                                                                            name="price" id="" min="0"
                                                                            placeholder="Please Enter" value="" required>
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" class="form-control"
                                                                            name="special_price" id="" min="0"
                                                                            placeholder="Please Enter" value="" required>
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" class="form-control"
                                                                            name="quantity" id="" min="0"
                                                                            placeholder="Please Enter" value="" required>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control"
                                                                            name="seller_sku" id="" min="0"
                                                                            placeholder="Please Enter" value="" required>
                                                                    </td>

                                                                    {{-- <td>
                                                                        <div class="delete-action delete-row-table">
                                                                            <i class="fas fa-trash-alt"></i>
                                                                        </div>
                                                                    </td> --}}
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





                        <button id="sumbitBtn" type="submit" class="btn btn-primary float-right">Save Variant</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

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
        var cropper_primary_obj;
        var cropper;
        var modal_cropper_status = false;
        var cropper_primary_obj;
        var cropper;
        var imageProcessingModel = $('#image-processing-modal');
        var last_selected_row = '';
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



        });





        // $('.add-new-row-table').click(function() {
        //     var table = $('body').find('.render-table');
        //     var body = table.find('.render-body');
        //     var firstrow = body.find('tr').first().html();
        //     body.append(`
    //     <tr>
    //         ${firstrow}
    //     </tr>
    // `);
        // });
        // $('body').on('click', '.delete-row-table', function() {
        //     // alert('delete');
        //     // $(this).css('background-color', 'red');
        //     var count = $('.render-body').find('tr').length;
        //     console.log(count);
        //     if (count > 1) {

        //         $(this).parents('tr').remove();
        //     }
        // });
        // $('.add-new-image').click(function() {
        //     var body = $('#multiple-image');
        //     body.append(`
    //         <div class="input-group px-0 mb-2">
    //             <input type="file" class="form-control p-1 detail-image-validate" name="images[]" accept="image/png,image/jpg,image/jpeg,"
    //                 onchange="backSide(this)" />
    //             <div class="delete-image"><i class="fas fa-trash-alt"></i></div>
    //         </div>
    // `);
        // });
        // $('#multiple-image').on('click', '.delete-image', function() {
        //     $(this).parent().remove();
        // });
    </script>

@endsection
