@extends('vendor.layouts.master',['navItem'=>'products'])
@section('content')
    <div class="container-fluid">

        {{-- =============================================================================================
                                               Validation error alert
 ================================================================================================ --}}

        @if (count($errors) > 0)
            @php $errors = Session::get('errors'); @endphp
            <div class="card bg-danger" id="alertBox">
                <div class="card-header bg-danger text-white">
                    <strong>Errors - Please Resolve These FIrst</strong>
                    <a href="#" id="alertCloseBtn" class="float-right text-white alert-close-btn">X</a>
                </div>
                <div class="card-body p-0">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-white">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif


        {{-- =============================================================================================
                                               Card
 ================================================================================================ --}}

        <div class="card">
            <div class="card-header form-bdr-top ">
                <h5 class="d-inline">Product Details</h5>
                <a href="{{route('products.index')}}" class="btn btn-primary d-inline float-right">Back</a>
            </div>
            <div class="col-md-12 mx-auto">
                <div class="card-body">
                    <form method="POST" action="{{ route('products.store') }}" class="form" enctype='multipart/form-data'>
                        @csrf

                        {{-- ===============================================================================
                                                 General Section
 ================================================================================================ --}}
                        {{-- div row --}}
                        <div class="row mx-auto">

                            {{-- product name --}}
                            <div class="col-md-6 mt-2">
                                <label for="name" class="control-label"><strong>Product Name:<sup
                                            class="text-danger">*</sup></strong> </label>
                                <input type="text" class="form-control" name="name" id="name" required
                                    placeholder="Enter product name">
                            </div>

                            {{-- Store --}}
                            <div class="col-md-6 mt-2">
                                <label for="store" class="control-label"><strong>Store:<sup
                                            class="text-danger">*</sup></strong></label>
                                <select class="form-control show-tick ms select2" name="store" id="store" required
                                    placeholder="Choose Your Store Name">
                                    <option value=""></option>
                                    <option value="virtual">Individual Store</option>
                                </select>
                            </div>

                            {{-- =================================================================================
                                             Categories Section
 ================================================================================================ --}}

                            {{-- categorty --}}
                            <div class="col-md-4 mt-4 mb-4">
                                <label for="categorty" class="control-label"><strong>Categorty:<sup
                                            class="text-danger">*</sup></strong></label>
                                <select class="form-control show-tick ms select2" name="categorty" id="categorty" required
                                    placeholder="Search...">
                                    <option></option>
                                    <option value="clothes">clothes</option>
                                    <option value="fragrance">Fragrance</option>
                                </select>
                            </div>

                            {{-- sub categorty --}}
                            <div class="col-md-4 mt-4 mb-4">
                                <label for="subcategorty" class="control-label"><strong>Sub Categorty:<sup
                                            class="text-danger">*</sup></strong></label>
                                <select class="form-control show-tick ms select2" name="subcategorty" id="subcategorty"
                                    required placeholder="Search...">
                                    <option></option>
                                    <option value="detergent">detergent</option>
                                    <option value="kitchenware">kitchenware</option>
                                </select>
                            </div>

                            {{-- child categorty --}}
                            <div class="col-md-4 mt-4 mb-4">
                                <label for="childcategorty" class="control-label"><strong>Child Categorty:<sup
                                            class="text-danger">*</sup></strong></label>
                                <select class="form-control show-tick ms select2" name="childcategorty" id="childcategorty"
                                    required placeholder="Search...">
                                    <option></option>
                                    <option value="detergent">detergent</option>
                                    <option value="kitchenware">kitchenware</option>
                                </select>
                            </div>

                            {{-- =================================================================================
                                             Description  Section
 ================================================================================================ --}}

                            {{-- Short Description --}}
                            <div class="col-md-12 ">
                                <label for="short_desc" class="control-label"><strong>Short Description:<sup
                                            class="text-danger">*</sup></strong></label>
                                <textarea class="form-control" name="short_desc" id="short_desc"></textarea>
                            </div>

                            {{-- detailed description --}}
                            <div class="col-md-12 mb-4 ">
                                <label for="detailed_desc" class="control-label"><strong>Detailed
                                        Description:</strong></label>
                                <textarea class="form-control" name="detailed_desc" id="detailed_desc"></textarea>
                            </div>


                            {{-- ===========================================================================
                                                 Pricing Section
 ================================================================================================ --}}

                            {{-- retail price --}}
                            <div class="col-md-3 mb-5 mt-5">
                                <label for="retail_price" class="control-label"><strong> Retail Price:<sup
                                            class="text-danger">*</sup></strong> </label>
                                <input type="number" class="form-control" name="retail_price" id="retail_price" required
                                    placeholder="Enter Retail price">
                            </div>

                            {{-- sale price --}}
                            <div class="col-md-3 mb-5 mt-5">
                                <label for="name" class="control-label"><strong> Sale Price:</strong> </label>
                                <input type="number" class="form-control" name="sale_price" id="sale_price" required
                                    placeholder="Enter sale price">
                            </div>

                            {{-- start sale price date --}}
                            <div class="col-md-3 mb-5 mt-5">
                                <label for="name" class="control-label"><strong> Sale Start date :</strong> </label>
                                <input type="date" class="form-control" name="start_date" id="start_date"
                                    placeholder="Select Sale Price Start Date">
                            </div>

                            {{-- end sale price date --}}
                            <div class="col-md-3 mb-5 mt-5">
                                <label for="name" class="control-label"><strong> Sale End Date:</strong> </label>
                                <input type="date" class="form-control" name="end_date" id="end_date"
                                    placeholder="Select Sale Price End Date">
                            </div>




                            {{-- ============================================================================
                                                    SKU Configuration
 ================================================================================================ --}}

                            {{-- SKU --}}
                            <div class="col-md-3 mb-5">
                                <label for="sku" class="control-label"><strong> SKU:<sup
                                            class="text-danger">*</sup></strong>
                                </label>
                                <input type="text" class="form-control" name="sku" id="sku" required
                                    placeholder="Enter SKU">
                                <p class="field-info"><small>(Only Numeric AND Alphabets)</small></p>
                            </div>


                            {{-- ==============================================================================
                                                    Inventory
 ================================================================================================ --}}


                            {{-- Inventory --}}
                            <div class="col-md-3 mb-5">
                                <label for="total_stock" class="control-label"><strong> Total Available Stock:</strong>
                                </label>
                                <input type="number" class="form-control" name="total_stock" id="total_stock" required
                                    placeholder="Enter Total Available Stock">
                                <p class="field-info"><small>( Only Positive Number)</small></p>
                            </div>


                            {{-- =============================================================================
                                                 Shipping
 ================================================================================================ --}}

                            {{-- Weight --}}
                            <div class="col-md-3 mb-5">
                                <label for="weight" class="control-label"><strong> Weight( lbs ):</strong>
                                </label>
                                <input type="number" class="form-control" name="weight" id="weight" required
                                    placeholder="Enter Weight( lbs )">
                                <p class="field-info"><small>( Weight of Product Must be in lbs)</small></p>
                            </div>

                            {{-- Dimensions --}}
                            <div class="col-md-3 mb-5">
                                <label for="dimensions" class="control-label"><strong> Dimensions:</strong>
                                </label>
                                <input type="text" class="form-control" name="dimensions" id="dimensions" required
                                    placeholder="Enter Dimensions">
                            </div>

                            {{-- ==================================================================================
                                                      Product Images
 ================================================================================================ --}}

                            {{-- Images --}}
                            <div class="col-md-6 mb-5">
                                <label for="image" class="control-label"><strong> Product Images:<sup
                                            class="text-danger">*</sup></strong>
                                </label>
                                <input type="file" class="form-control" name="images[]" required
                                    placeholder="Select min 1 Image" title="select min:1 image || max:10 images" multiple>
                                <p class="field-info"><small>( Select Minimum 1 OR Maximum 10 images)</small></p>
                            </div>
                            {{-- =============================================================================
                                                      Video Link
 ================================================================================================ --}}

                            {{-- Video Link --}}

                            <div class="col-md-6 mb-5">
                                <label for="video_url" class="control-label"><strong> Video Link:</strong>
                                </label>
                                <input type="url" class="form-control" name="video_url" id="video_url"
                                    placeholder="Video URL">
                                <p class="field-info"><small>(Maximum 1 video || Video could hosted on our server or Video
                                        URL like YouTube)</small></p>
                            </div>


                            {{-- ===============================================================================
                                                     purchase note
 ================================================================================================ --}}

                            {{-- purchase note --}}
                            <div class="col-md-12 mb-5">
                                <label for="purchase_note" class="control-label"><strong> Purchase Note:</strong>
                                </label>
                                <textarea class="form-control" name="{{-- script for text editor --}}
                                " id="purchase_note" rows="5"
                                    placeholder="Write some purchase note "></textarea>

                            </div>

                            {{-- ===============================================================================
                                                     Switch buttons
 ================================================================================================ --}}

                            {{-- Status --}}
                            <div class="col-md-4 mb-5">
                                <div class="row">
                                    <label for="status" class="col-sm-4 col-form-label"><strong>Status:</strong></label>
                                    <label class="toggle-switch">
                                        <input type="checkbox" class="float-right" name="status" id="status">
                                        <span class="toggle-switch-slider" title="Activate/Deactivate Your Product"></span>
                                    </label>
                                </div>
                                <p class="field-info"><small>( If Enalbled then Product go Live on Store)</small></p>
                            </div>


                            {{-- Featured --}}

                            <div class="col-md-4 mb-5">
                                <div class="row">
                                    <label for="featured" class="col-sm-4 col-form-label"><strong>Featured:</strong></label>
                                    <label class="toggle-switch">
                                        <input type="checkbox" class="float-right" name="featured" id="featured">
                                        <span class="toggle-switch-slider" title="Featured Your Product"></span>
                                    </label>
                                </div>
                                <p class="field-info"><small>( If Enalbled then Product will be Featured)</small></p>
                            </div>

                            {{-- free delivery --}}
                            <div class="col-md-4 mb-5">
                                <div class="row">
                                    <label for="free_delivery" class="col-sm-6 col-form-label"><strong>Free
                                            Delivery:</strong></label>
                                    <label class="toggle-switch">
                                        <input type="checkbox" class="float-right" name="free_delivery" id="free_delivery">
                                        <span class="toggle-switch-slider" title="Enable Free Delivery"></span>
                                    </label>
                                </div>
                                <p class="field-info">( If Enalbled then Product delivery will be free)</p>
                            </div>

                            {{-- Cancel Available --}}
                            <div class="col-md-4 mb-5">
                                <div class="row">
                                    <label for="cancel_available" class="col-sm-6 col-form-label"><strong>Free
                                            Delivery:</strong></label>
                                    <label class="toggle-switch">
                                        <input type="checkbox" class="float-right" name="cancel_available"
                                            id="cancel_available">
                                        <span class="toggle-switch-slider" title="Enable Cancel Available"></span>
                                    </label>
                                </div>
                                <p class="field-info">( If Enalbled then Order will be cancel for this Product)</p>
                            </div>

                            {{-- Cash on Delivery --}}

                            <div class="col-md-4 mb-5">
                                <div class="row">
                                    <label for="cash_on_delivery" class="col-sm-6 col-form-label"><strong>Cash on
                                            Delivery:</strong></label>
                                    <label class="toggle-switch">
                                        <input type="checkbox" class="float-right" name="cash_on_delivery"
                                            id="cash_on_delivery">
                                        <span class="toggle-switch-slider" title="Enable Cash on Delivery"></span>
                                    </label>
                                </div>
                                <p class="field-info">( If Enalbled then Order will be cancel for this Product)</p>
                            </div>

                            {{-- div row 2 is closed here --}}
                        </div>




                        {{-- button --}}
                        {{-- <input type="submit" class="btn btn-primary mb-5 float-right" value="Add Product"> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('customScripts')

    {{-- script for text editor --}}

    <script type="text/javascript">
        $('#short_desc,#detailed_desc').summernote({
            height: 200
        });

    </script>

    //Jquery code for errors hide
    <script>
        $("#alertCloseBtn").click(function(e) {
            e.preventDefault();
            $("#alertBox").hide();
        });

    </script>

@endsection
