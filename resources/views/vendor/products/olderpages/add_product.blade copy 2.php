@extends('vendor.layouts.master',['navItem'=>'products'])
@section('title', 'Add New Product')

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

        {{-- jquery plugin testing --}}

        {{-- end --}}

        {{-- DIV ROW SRART --}}
        <div class="row px-5">
            {{-- DIV COL 8  START --}}
            <div class="col-md-12">
                <div class="row">
                    {{-- Basic Information CARD  START --}}
                    <div class="card">
                        {{-- CARD HEADER START --}}
                        <div class="card-header p-2 very-light-gray-bg shadow-sm">
                            <h6><b>Basic Information</b> </h6>
                        </div>
                        {{-- CARD HEADER END --}}

                        {{-- CARD BODY START --}}
                        <div class="card-body">
                            <div class="col-md-12">
                                {{-- form start --}}
                                <form action="">
                                    <div class="row">
                                        {{-- PRODUCT NAME --}}
                                        <div class="col-md-12 mb-4">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="control-label-lg" for="name">Product Name<sup
                                                            class="text-danger">*</sup></label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="name" id="name" class="form-control"
                                                        placeholder="">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- CATEGORY --}}
                                        <div class="col-md-12 mb-4">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="control-label-lg" for="category">Category <sup
                                                            class="text-danger">*</sup></label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="category" id="category" class="form-control"
                                                        placeholder="">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- VIDEO URL --}}
                                        <div class="col-md-12 mb-4">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="control-label-lg" for="video_url">Video URL</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="url" name="video_url" id="video_url" class="form-control"
                                                        placeholder="">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Product Attributes --}}
                                        <div class="col-md-12">
                                            <h6><b>Product Attributes</b><sup class="text-danger">*</sup></h6>
                                        </div>
                                        <div class="col-md-12">
                                            <p class="mt-2 text-muted">Boost your item's searchability by filling-up the Key
                                                Product
                                                Information marked with
                                                KEY. The more you fill-up, the easier for buyers to find your product.</p>
                                        </div>
                                        <div class="col-md-12 border border-darken-1 p-3">
                                            <div class="row mt-3">
                                                {{-- Brand --}}
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="brand" class="control-label float-right">Brand:<sup
                                                                    class="text-danger">*</sup></label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select class="form-control show-tick ms select2" name="brand"
                                                                id="brand" placeholder="">
                                                                <option>Please Select</option>
                                                                <option>J.</option>
                                                                <option>Saphire</option>
                                                            </select>
                                                            <p><a href="#">No Brand</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Protection --}}
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="protection"
                                                                class="control-label float-right">Protection:<sup
                                                                    class="text-danger">*</sup></label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select class="form-control show-tick ms select2"
                                                                name="protection" id="protection" placeholder="">
                                                                <option>Please Select</option>
                                                                <option>Glass</option>
                                                                <option>Cover</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </section>



                                    </div>
                                </form>
                                {{-- form end --}}
                            </div>
                        </div>
                        {{-- CARD BODY END --}}
                    </div>
                    {{-- END of Basic Information CARD --}}

                    {{-- Descriptions CARD  START --}}
                    <div class="col-md-12 p-0">
                        <div class="card">
                            <div class="card-header p-2 very-light-gray-bg shadow-sm">
                                <h6><b>Descriptions</b></h6>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        {{-- Short Description --}}
                                        <div class="col-md-12">
                                            <label for="short_desc" class="control-label">Short Description:<sup
                                                    class="text-danger">*</sup></label>
                                            <textarea class="form-control description" name="short_description"
                                                id="short_description" required></textarea>
                                        </div>

                                        {{-- detailed description --}}
                                        <div class="col-md-12 mb-4">
                                            <label for="detailed_desc" class="control-label">Detailed
                                                Description:</label>
                                            <textarea class="form-control description" name="detailed_description"
                                                id="detailed_description"></textarea>
                                        </div>
                                        {{-- english description --}}
                                        <div class="col-md-12 mb-4">
                                            <label for="english_desc" class="control-label">English
                                                Description:</label>
                                            <textarea class="form-control description" name="english_description"
                                                id="english_description"></textarea>
                                        </div>
                                        {{-- what is in the box --}}
                                        <div class="col-md-12 mb-4">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="in_box" class="float-right">What's in the box <strong><sup
                                                                class="text-danger font-15">*</sup></strong></label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="in_box" id="in_box"
                                                        required>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- END of Descriptions CArd --}}

                    {{-- Price & Stock CARD  START --}}
                    <div class="col-md-12 p-0">
                        <div class="card">
                            <div class="card-header p-2 very-light-gray-bg shadow-sm">
                                <h6><b>Price & Stock</b></h6>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">

                                        {{-- Storage Capacity --}}
                                        <div class="col-md-12 mb-4">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="storage_capacity"
                                                                class="control-label float-right">Storage Capacity:<sup
                                                                    class="text-danger">*</sup></label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select class="form-control show-tick ms select2"
                                                                name="storage_capacity" id="storage_capacity"
                                                                placeholder="">
                                                                <option>Please Select</option>
                                                                <option>Glass</option>
                                                                <option>Cover</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Variation Information --}}
                                        <div class="col-md-8">
                                            <label for="">Variation Information <b><sup
                                                        class="text-danger">*</sup></b></label>
                                            <br><a href="" class="btn btn-outline-tertiary"> <i class="fa fa-plus"></i> Add
                                                New
                                                SKU
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Service & Delivery CARD  START --}}
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
                                            <div id="services" class="collapse">

                                                {{-- Warranty Type --}}
                                                <div class="col-md-12 mb-4">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="warranty_type"
                                                                class="control-label float-right">Warranty Type:<sup
                                                                    class="text-danger">*</sup></label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <select class="form-control show-tick ms select2"
                                                                name="warranty_type" id="warranty_type" placeholder="">
                                                                <option>Please Select</option>
                                                                <option>Glass</option>
                                                                <option>Cover</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Warranty period --}}
                                                <div class="col-md-12 mb-4">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="warranty_period"
                                                                class="control-label float-right">Warranty Period:<sup
                                                                    class="text-danger">*</sup></label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <select class="form-control show-tick ms select2"
                                                                name="warranty_period" id="warranty_period" placeholder="">
                                                                <option>Please Select</option>
                                                                <option>Glass</option>
                                                                <option>Cover</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Warranty Policy --}}
                                                <div class="col-md-12 mb-4">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="warranty_policy"
                                                                class="control-label float-right">Warranty Policy:<sup
                                                                    class="text-danger">*</sup></label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <select class="form-control show-tick ms select2"
                                                                name="warranty_policy" id="warranty_policy" placeholder="">
                                                                <option>Please Select</option>
                                                                <option>Glass</option>
                                                                <option>Cover</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span9 btn-block">

                                                <a href="#services" class="btn btn-large btn-block btn-secondary"
                                                    data-toggle="collapse"><i class="fas fa-chevron-circle-down"
                                                        aria-hidden="true"></i> More</a>
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
                                                            Weight (kg):<sup class="text-danger">*</sup></label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="number" step="0.01" name="package_weight"
                                                            id="package_weight">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Package Dimensions (cm) --}}
                                            <div class="col-md-12 mb-4">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="package_dimensions_lenght"
                                                            class="control-label float-right">Package Dimensions (cm):<sup
                                                                class="text-danger">*</sup></label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="number" min="0" step="0.01"
                                                            name="package_dimensions_lenght" id="package_dimensions_lenght"
                                                            placeholder="Lenght (cm)" required>

                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="number" min="0" step="0.01"
                                                            name="package_dimensions_width" id="package_dimensions_width"
                                                            placeholder="Width (cm)" required>

                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="number" min="0" step="0.01"
                                                            name="package_dimensions_height" id="package_dimensions_height"
                                                            placeholder="Height (cm)" required>

                                                    </div>
                                                </div>
                                            </div>
                                            <div id="delivery" class="collapse">

                                                {{-- Dangerous Goods --}}
                                                <div class="col-md-12 mb-4">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="warranty_period"
                                                                class="control-label float-right">Dangerous Goods:<sup
                                                                    class="text-danger">*</sup></label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            {{-- Battery --}}
                                                            <input type="checkbox" name="battery" id="battery"> Battery
                                                            {{-- Flammable --}}
                                                            <input type="checkbox" class="ml-2" name="flammable"
                                                                id="flammable">
                                                            Flammable
                                                            {{-- Liquid --}}
                                                            <input type="checkbox" class="ml-2" name="liquid" id="liquid">
                                                            Liquid
                                                            <input type="checkbox" class="ml-2" name="None" id="None">
                                                            None
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="span9 btn-block">

                                                <a href="#delivery" class="btn btn-large btn-block btn-secondary"
                                                    data-toggle="collapse"><i class="fas fa-chevron-circle-down"
                                                        aria-hidden="true"></i> More</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>
        {{-- DIV COL 8  END --}}
    </div>
    </div>

@endsection
@section('customScripts')
    <script>
        $(document).ready(function() {
            // TEXT EDITOR
            $('.description').summernote({
                height: 200
            });
        });
    </script>

    {{-- jquery cascading category selection plugin --}}
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous">
    </script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="dist/js/bootstrap-cascader-dcbf0e3207.min.js"></script>
    <script>
        $(function() {
            var o = "ABCDEFJHIJKL".split(""),
                n = function() {
                    return function(n, c) {
                        setTimeout(function() {
                            var e = n.length + 1,
                                d = [];
                            if (4 < e) return c(d);
                            var i = "",
                                t = "";
                            0 < n.length && (i = n[n.length - 1].c, t = n[n.length - 1].n), $.each(o,
                                function(n, c) {
                                    var a = {
                                        c: i + n,
                                        n: t + c
                                    };
                                    4 == e && (a.hasChild = !1), d.push(a)
                                }), c(d)
                        }, 500)
                    }
                };
            $("#example").bsCascader({
                splitChar: " / ",
                btnCls: 'btn-primary',
                openOnHover: !0,
                lazy: !0,
                placeHolder: 'Select...',
                loadData: n()
            })
        });
    </script>
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-36251023-1']);
        _gaq.push(['_setDomainName', 'jqueryscript.net']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') +
                '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();
    </script>
@endsection
