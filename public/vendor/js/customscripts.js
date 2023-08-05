/*
|===================================================================
|  GET SPECIFIC SUBCATEGORIES-BRANDS USING AJAX
|===================================================================
*/


// global var
var sku_attributes_list = [];
var sku_attributes = [];

$(document).ready(function () {
    var typingTimer;                //timer identifier
    var doneTypingInterval = 2000;  //time in ms, 5 seconds for example
    $(document).on('click', '.Product-pagination a', function (event) {
        event.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var url = $(this).attr('href');
        var page = $(this).attr('href');
        getProductsList(page);
    });
    $('#products_datatable_length').change(function () {
        var page = $('ul#keyPagination').find('li.active a').attr('href');
        getProductsList(page)
    });
    // $('#productSearch').on('keypress keydown keyup', function () {
    //     var page = $('ul#productPagination').find('li.active a').attr('href');
    //     getProductsList(page)
    //
    // });
    //setup before functions

    var $productSearch = $('#productSearch');

//on keyup, start the countdown
    $productSearch.on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(getProducts, doneTypingInterval);
    });

//on keydown, clear the countdown
    $productSearch.on('keydown', function () {
        clearTimeout(typingTimer);
    });

//user is "finished typing," do something
    function getProducts() {
        var page = $('ul#productPagination').find('li.active a').attr('href');
        getProductsList(page)
    }

//    variants

    $(document).on('click', '.variants-pagination a', function (event) {
        event.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var url = $(this).attr('href');
        var page = $(this).attr('href');
        getVariantsList(page);
    });
    $('#variants_datatable_length').change(function () {
        var page = $('ul#keyPagination').find('li.active a').attr('href');
        getVariantsList(page)
    });
    // $('#productSearch').on('keypress keydown keyup', function () {
    //     var page = $('ul#productPagination').find('li.active a').attr('href');
    //     getProductsList(page)
    //
    // });
    //setup before functions

    var $variantsSearch = $('#variantsSearch');

//on keyup, start the countdown
    $variantsSearch.on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(getVariants, doneTypingInterval);
    });

//on keydown, clear the countdown
    $variantsSearch.on('keydown', function () {
        clearTimeout(typingTimer);
    });

//user is "finished typing," do something
    function getVariants() {
        var page = $('ul#productPagination').find('li.active a').attr('href');
        getVariantsList(page)
    }

//    variants end

//    Notification list


    $(document).on('click', '.notifications-pagination a', function (event) {
        event.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var url = $(this).attr('href');
        var page = $(this).attr('href');
        getNotificationList(page);
    });
    $('#notifications_datatable_length').change(function () {
        var page = $('ul#keyPagination').find('li.active a').attr('href');
        getNotificationList(page)
    });
    // $('#productSearch').on('keypress keydown keyup', function () {
    //     var page = $('ul#productPagination').find('li.active a').attr('href');
    //     getProductsList(page)
    //
    // });
    //setup before functions

    var $notificationsSearch = $('#notificationsSearch');

//on keyup, start the countdown
    $notificationsSearch.on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(getNotification, doneTypingInterval);
    });

//on keydown, clear the countdown
    $notificationsSearch.on('keydown', function () {
        clearTimeout(typingTimer);
    });

//user is "finished typing," do something
    function getNotification() {
        var page = $('ul#productPagination').find('li.active a').attr('href');
        getNotificationList(page)
    }


//    End Notification list

//    inside statistic start

    $(document).on('change','#statistic_start_date',function () {
        getInside();
    })
    $(document).on('change','#statistic_end_date',function () {
        getInside();
    })

//    inside statistic end

//translation enable/disable

$(document).on('change', '.translation_verified_change', function (e) {
    var translation = $(this).prop('checked') == true ? 1 : 0;
    var product_id = $(this).data('id');
    console.log(window.location.origin)

    $.ajax({
        type: "GET",
        dataType: "json",
        url: window.location.origin + '/vendor/product/change/status',
        data: {
            'translation': translation,
            'product_id': product_id,
        },
        success: function (data) {
            console.log(data.status)
            if (data.status == 0) {
                sweetAlert('update', 'Arabic Translation Disabled Successfully.!')
            } else {
                sweetAlert('update', 'Arabic Translation Verified Successfully.!')
            }
        }
    });
});
});

function getInside(){

    var start_date=$('#statistic_start_date').val()
    var end_date=$('#statistic_end_date').val()

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        type: "GET",
        url: window.location.origin+'/vendor/inside/statistic?start_date='+start_date+'&end_date='+end_date,
        success: function (response) {
            console.log(response);
            //   return;

        },
    })

}

function getSubCatsBrands(id) {
    let category_id = id;
    console.log(category_id);

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        type: "POST",
        url: "/vendor/ajax/subcategories-brands",
        data: {
            id: category_id,
        },
        success: function (response) {
            //  console.log(response);
            //  return;

            let subcategories = response.subcategories.length;
            let brands = response.brands.length;

            if (subcategories > 0) {
                subcategories = response.subcategories;

                $("#subcategory").html(
                    '<option value="" selected>Select Subcategory</option>'
                );
                $.each(subcategories, function (key, subcategory) {
                    $("#subcategory").append(
                        '<option  value="' +
                        subcategory.id +
                        '">' +
                        subcategory.title +
                        "</option>"
                    );
                });
            } else {
                $("#subcategory").html(
                    '<option value="" selected>No Record Found</option>'
                );
            }
            if (brands > 0) {
                $("#brand").empty();
                brands = response.brands;

                $("#brands").html(
                    '<option value="" selected>Select Brand</option>' +
                    '<option value="876">No Brand</option>'
                );
                $.each(brands, function (key, brand) {
                    $("#brands").append(
                        '<option  value="' +
                        brand.id +
                        '">' +
                        brand.name +
                        "</option>"
                    );
                });
            } else {
                $("#brands").html(
                    '<option value="" selected>No Record Found</option>'
                );
            }
        },
    });
}

/*
|=====================================================================
|  GET SPECIFIC CHILDCATEGORIES-ATTRIBUTES USING AJAX
|=====================================================================
*/
function getChildCatsAttr(id) {
    let subcategory_id = id;
    //console.log(categoryId);

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        type: "POST",
        url: "/vendor/ajax/childcategories-attributes",
        data: {
            id: subcategory_id,
        },

        success: function (response) {
            // console.log(response);
            // return;

            let childcats = response.childcategories.length;
            let attr = response.attributes.length;
            // let keys = response.attributes[0].keys.length;
            // console.log(keys);

            if (childcats > 0) {
                $("#childcategory").parent().removeClass('d-none');
                $("#childcategory").empty();

                childcategories = response.childcategories;
                $("#childcategory").html(
                    '<option value="" selected>Select Childcategory</option>'
                );
                $.each(childcategories, function (key, childcategory) {
                    $("#childcategory").append(
                        '<option  value="' +
                        childcategory.id +
                        '">' +
                        childcategory.title +
                        "</option>"
                    );
                });
            } else {
                $("#childcategory").html(
                    '<option value="" selected>No Record Found</option>'
                );
            }


            $("#brands").html(
                '<option value="" selected>Select Brand</option>' +
                '<option value="876">No Brand</option>'
            );
            // filter Brands
            if (response.brands.length > 0) {
                $("#brand").empty();
                brands = response.brands;

                $("#brands").html(
                    '<option value="" selected>Select Brand</option>' +
                    '<option value="876">No Brand</option>'
                );
                $.each(brands, function (key, brand) {
                    $("#brands").append(
                        '<option  value="' +
                        brand.id +
                        '">' +
                        brand.name +
                        "</option>"
                    );
                });
            } else {
                // $("#brands").html(
                //     '<option value="" selected>No Record Found</option>'
                // );
            }

            if (attr > 0) {
                $("#attributes-div").html("");
                attributes = response.attributes;
                attributes.forEach(function (attribute) {
                    // console.log(attribute);
                    var attributeId = `${attribute.id}`;
                    var attributeTitle = attribute.title;

                    if (attribute.keys.length > 0) {
                        $("#attributes-div").append(`
                            <div class="col-md-6 mt-4 pl-0">
                            <div class="row">
                                <div class="col-md-6">
                                <label for="attribute"class="control-label float-right">${attributeTitle}</label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control show-tick ms  multiselect data" callerName="${attributeTitle}" style="height:auto;" multiple name="attributes[${attribute.id}][]" id="${attributeId}">
                                    <option value="">Select ${attributeTitle}</option>
                                    </select>
                                </div>
                            </div>
                            </div>
                        `);
                        $("#product-attribute-list").append(`
                            <option  value="${attributeId}">
                                ${attributeTitle}
                            </option>
                        `);

                        attribute.keys.forEach(function (key) {
                            $(`#${attributeId}`).append(`

                                <option value="${key.id}">${key.name}</option>
                            `);
                        });

                        $(`#${attributeId}`).select2();
                        showless_attr();

                    }
                });
            } else {
                $("#attributes").html(
                    '<option value="" selected>No Record Found</option>'
                );
                $("#attributes-div").html("");
                $("#product-attribute-list").html('');


            }

            // $("#product-attribute-list").change(function() {
            //     var selected = $(this).val();
            //     $(".fixed-table th.dynamic-head").append(selected);
            //     $(".fixed-table td.dynamic-content").append(selected);
            //     console.log("selected", selected);
            // });
        },
    });
}


function getBrandsByChildCat(id) {


    let childcategory_id = id;
    //console.log(categoryId);

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        type: "POST",
        url: "/vendor/ajax/childcategory-brands",
        data: {
            id: childcategory_id,
        },
        success: function (response) {
            // filter Brands
            if (response.brands.length > 0) {
                $("#brand").empty();
                brands = response.brands;

                $("#brands").html(
                    '<option value="" selected>Select Brand</option>' +
                    '<option value="876">No Brand</option>'
                );
                $.each(brands, function (key, brand) {
                    $("#brands").append(
                        '<option  value="' +
                        brand.id +
                        '">' +
                        brand.name +
                        "</option>"
                    );
                });
            } else {
                // $("#brands").html(
                //     '<option value="" selected>No Record Found</option>'
                // );
            }

            let attr = response.attributes.length;

            if (attr > 0) {
                $("#attributes-div").html("");
                $("#product-attribute-list").html('');

                attributes = response.attributes;
                sku_attributes = response.sku_attributes;
                sku_attributes_list = response.sku_attributes_list;

                // add sku_attributes
                sku_attributes_list.forEach(function (attr) {

                    $("#product-attribute-list").append(`
                        <option  value="${attr.id}">
                            ${attr.title}
                        </option>
                    `);
                });
                attributes.forEach(function (attribute) {
                    // console.log(attribute);
                    var attributeId = `${attribute.id}`;
                    var attributeTitle = attribute.title;

                    if (attribute.keys.length > 0) {
                        $("#attributes-div").append(`
                            <div class="col-md-6 mt-4 pl-0">
                            <div class="row">
                                <div class="col-md-6">
                                <label for="attribute"class="control-label float-right">${attributeTitle}</label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control show-tick ms  multiselect data" callerName="${attributeTitle}" style="height:auto;" multiple name="attributes[${attribute.id}][]" id="${attributeId}">
                                    <option value="">Select ${attributeTitle}</option>
                                    </select>
                                </div>
                            </div>
                            </div>
                        `);
                        // console.log(attributeId, sku_attributes, sku_attributes.includes(parseInt(attributeId)));
                        // if (sku_attributes.includes(parseInt(attributeId))) {

                        //     $("#product-attribute-list").append(`
                        //         <option  value="${attributeId}">
                        //             ${attributeTitle}
                        //         </option>
                        //     `);


                        // }


                        attribute.keys.forEach(function (key) {

                            $(`#${attributeId}`).append(`

                                <option value="${key.id}">${key.name}</option>
                            `);
                        });

                        $(`#${attributeId}`).select2();
                    }
                });

                showless_attr();

            } else {
                $("#attributes").html(
                    '<option value="" selected>No Record Found</option>'
                );
                $("#attributes-div").html("");
                $("#product-attribute-list").html('');


            }


        }
    });
}


$('#show-more-attributes').click(function () {
    showmore_attr();
});
$('#show-less-attributes').click(function () {
    showless_attr();
});


function showless_attr() {
    var attribute_div = $('#attributes-div');
    var attribute_row_count = attribute_div.find('.row').length;

    var skip_rows = 4;
    var counter = 1;
    attribute_div.find('.row').each(function () {
        if (counter > skip_rows) {

            $(this).hide();
        }
        counter = counter + 1;
    });

    $('#show-more-attributes').show();
    $('#show-less-attributes').hide();

}

function showmore_attr() {
    var attribute_div = $('#attributes-div');


    attribute_div.find('.row').each(function () {


        $(this).show();

    });

    $('#show-more-attributes').hide();
    $('#show-less-attributes').show();

}


/*
|===================================================================
|  Get Brands on the basis of category
|===================================================================
*/
function getBrands(id) {
    let categoryId = id;
    console.log(categoryId);

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        type: "GET",
        url: "/vendor/ajax/brands", // Local Link
        // url: "https://monoluxe.co.uk/api/public/api/admin/ajax/services", // Live Link
        data: {
            categoryId: categoryId,
        },
        success: function (response) {
            //  console.log(response);
            //   return;

            let records = response.brands.length;
            if (records > 0) {
                $("#brands").empty();
                brands = response.brands;

                $.each(brands, function (key, brand) {
                    $("#brands").append(
                        '<option  value="' +
                        brand.id +
                        '">' +
                        brand.title +
                        "</option>"
                    );
                });
            } else {
                $("#brands").html(
                    '<option value="" selected>No Record Found</option>'
                );
            }
        },
    });
}

/*
|===================================================================
|  Get Specific Attributes
|===================================================================
*/
function getAttributes(id) {
    let subcategoryId = id;
    //console.log(categoryId);

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        type: "GET",
        url: "/vendor/ajax/attributes", // Local Link
        // url: "https://api.storak.qa/api/public/api/admin/ajax/attributes", // Live Link
        data: {
            subcategoryId: subcategoryId,
        },
        success: function (response) {
            // console.log(response);
            // return;

            let records = response.attributes.length;

            if (records > 0) {
                $("#attribute").empty();
                attributes = response.attributes;
                // console.log(attributes);
                $.each(attributes, function (key, attribute) {
                    $("#attributes-div").append(
                        `<div class="col-md-6 mt-4">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="attribute"
                                    class="control-label float-right">Attribute:<sup
                                        class="text-danger">*</sup></label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control show-tick ms select2"
                                    name="attribute" id="attribute">
                                    <option>Please Select</option>
                                </select>
                            </div>
                        </div>
                    </div>`
                    );
                });
            } else {
                $("#attribute").html(
                    '<option value="" selected>No Record Found</option>'
                );
            }
        },
    });
}

/*
|===================================================================
|  sign up slider
|===================================================================
*/
$("#myCarousel").carousel({
    interval: 2500,
});

/*
|===================================================================
|  Delete Product Detail Image
|===================================================================
*/
function deleteImage(id, imgDiv) {
    var imageId = id;
    var imageDiv = imgDiv;

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        type: "POST",
        url: "/vendor/delete-product-image",
        data: {
            image_id: imageId,
        },
        success: function (response) {

            if (response.status == 200) {
                $(`#${imageDiv}`).remove();
            } else {
                console.log(response);
            }
        },
    });
}
$(document).ready(function () {
    $(document).on('click', '.Product-pagination a', function (event) {
        event.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var url = $(this).attr('href');
        var page = $(this).attr('href');
        getProductsList(page);
    });
    $('#products_datatable_length').change(function () {
        var page = $('ul#keyPagination').find('li.active a').attr('href');
        getProductsList(page)
    });
    // $('#productSearch').on('keypress keydown keyup', function () {
    //     var page = $('ul#productPagination').find('li.active a').attr('href');
    //     getProductsList(page)
    //
    // });
    //setup before functions
    var typingTimer;                //timer identifier
    var doneTypingInterval = 3000;  //time in ms, 5 seconds for example
    var $input = $('#productSearch');

//on keyup, start the countdown
    $input.on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });

//on keydown, clear the countdown
    $input.on('keydown', function () {
        clearTimeout(typingTimer);
    });

//user is "finished typing," do something
    function doneTyping() {
        var page = $('ul#productPagination').find('li.active a').attr('href');
        getProductsList(page)
    }

//    review actions



    $(document).on('click', '.review-pagination a', function (event) {
        event.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var url = $(this).attr('href');
        var page = $(this).attr('href');
        getReviewsList(page);
    });
    $('#review_datatable_length').change(function () {
        var page = $('ul#keyPagination').find('li.active a').attr('href');
        getReviewsList(page)
    });
    // $('#productSearch').on('keypress keydown keyup', function () {
    //     var page = $('ul#productPagination').find('li.active a').attr('href');
    //     getProductsList(page)
    //
    // });
    //setup before functions
    var $inputReview = $('#reviewSearch');

//on keyup, start the countdown
    $inputReview.on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(reviewListing, doneTypingInterval);
    });

//on keydown, clear the countdown
    $inputReview.on('keydown', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(reviewListing, doneTypingInterval);

    });

//user is "finished typing," do something
    function reviewListing() {
        var page = $('ul#reviewPagination').find('li.active a').attr('href');
        getReviewsList(page)
    }

    $(document).on('change', '.filters_review', function () {
        getReviewsList(1);
    })

//    end review

    //questions


    $(document).on('click', '.questions-pagination a', function (event) {
        event.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var url = $(this).attr('href');
        var page = $(this).attr('href');
        getQuestionsList(page);
    });
    $('#questions_datatable_length').change(function () {
        var page = $('ul#questionsPagination').find('li.active a').attr('href');
        getQuestionsList(page)
    });
    // $('#productSearch').on('keypress keydown keyup', function () {
    //     var page = $('ul#productPagination').find('li.active a').attr('href');
    //     getProductsList(page)
    //
    // });
    //setup before functions
    var $inputQuestions = $('#questionSearch');

//on keyup, start the countdown
    $inputQuestions.on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(getQuestionsList, doneTypingInterval);
    });

//on keydown, clear the countdown
    $inputQuestions.on('keydown', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(getQuestionsList, doneTypingInterval);
    });

//user is "finished typing," do something
    function questionsListing() {
        var page = $('ul#questionsPagination').find('li.active a').attr('href');
        getQuestionsList(page)
    }

    $(document).on('change', '.filters_questions', function () {
        getQuestionsList(1);
    })
});

/*
|===================================================================
| Products List Show
|===================================================================
*/


function getProductsList(page_id) {
    var datatable_length = $('#products_datatable_length').val()
    var search = $('#productSearch').val()
    var primary_image;
    var editProduct;
    var deleteProduct;
    var category_id = $('#category_id').val()
    var subcategory_id = $('#subcategory_id').val()
    var childcategory_id = $('#childcategory_id').val()
    var brand_id = $('#brand_id').val()
    var status = $('#status').val()
    var featured = $('#featured').val()
    var from_date = $('#from_date').val()
    var to_date = $('#to_date').val()
    var translation = $('#translation').val()
    $('.pre-loader').show()
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: '/vendor/products?page_id=' + page_id + '&datatable_length=' + datatable_length + '&search=' + search+ '&category_id=' + category_id + '&subcategory_id=' + subcategory_id+ '&childcategory_id=' + childcategory_id+ '&brand_id=' + brand_id + '&status=' + status  + '&featured=' + featured + '&from_date=' + from_date+ '&to_date=' + to_date  + '&translation=' + translation ,
        type: 'get',

        success: function (response) {
            $('#productsList').empty()
            $('#productVariantModels').empty()
            $.each(response.products.data, function (index, value) {
                if (value.primary_image) {
                    primary_image = ' <img src="' + response.imagesUrl + 'storage/product/images/sm/' + value.primary_image + '"\n' +
                        'alt="" class=" rounded w-100" >'
                } else {
                    primary_image = '<img src="' + response.imagesUrl + '/product.svg"\n' +
                        'class=" rounded img-bdr-primary"> '
                }
                if (response.edit) {
                    editProduct = '<a href="/vendor/products/' + value.variants[0].id + '/edit? =true" title="Edit This Product" class="btn btn-primary btn-sm m-1"><span class="btn-inner-icon "><i class="fa fa-edit text-white"></i></span></a>'
                } else {
                    editProduct = ''
                }
                if (response.delete) {
                    deleteProduct = '<form action=\'/vendor/products/destroy/'+value.id+'\' method="POST" class="d-inline"><input type="hidden" name="_token" value="'+$('meta[name="csrf-token"]').attr('content')+'"><button type="button" class="btn btn-danger btn-sm archive-btn" title="Delete This Product "><span class="btn-inner-icon"><i class="fa fa-trash text-white"></i></span></button></form>\n'
                }else{
                    deleteProduct=''
                }
                if (value.status == 1) {
                    product_status = $('<span/>',{'class':'badge badge-lg badge-pill badge-success text-uppercase font-weight-bold'}).append('Active')
                } else {
                    product_status =$('<span/>',{'class':'badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold'}).append('Inactive')
                }

                if (value.featured == 1) {
                    product_feature =$('<span/>',{'class':'badge badge-lg badge-pill badge-success text-uppercase font-weight-bold'}).append('Yes')
                } else {
                    product_feature =$('<span/>',{'class':'badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold'}).append('No')
                }

                editTranslation = '<a href="/vendor/products/' + value.id + '/editTranslation" title="Edit This Product Translation " class="btn btn-primary btn-sm m-1"><span class="btn-inner-icon "><i class="fa fa-language" aria-hidden="true"></i></span></a>'

                //translation verified
                if (value.translation_verified == 1) {
                    translation_verified = $('<label/>', {'class': 'toggle-switch'}).append(
                        $('<input/>', {
                            type: 'checkbox',
                            name: 'translation_verified',
                            id: 'status-' + value.id + '',
                            'class': 'translation_verified_change',
                            'checked': 'checked',
                            'data-id': value.id
                        }),
                        $('<span/>', {'class': 'toggle-switch-slider'})
                    )
                    // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-success text-uppercase font-weight-bold'}).append('Active')
                } else {
                    translation_verified = $('<label/>', {'class': 'toggle-switch'}).append(
                        $('<input/>', {
                            type: 'checkbox',
                            name: 'translation_verified',
                            id: 'status-' + value.id + '',
                            'class': 'translation_verified_change',
                            'data-id': value.id
                        }),
                        $('<span/>', {'class': 'toggle-switch-slider'})
                    )
                    // status =$('<span/>',{'class':'badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold'}).append('Inactive')
                }


                $("#productsList").append(
                    $('<tr/>').append(
                        $('<td/>', {style: 'width:10%'}).append(
                            $('<a/>', {
                                href : 'https://storak.qa/product-detail/' + value.slug,
                                target : '_blank'
                            }).append(
                                primary_image
                            ),

                        ),
                        $('<td/>', {style: 'width:40%'}).append(
                            $('<b/>').append('Product: '), value.name, '<br>',
                            $('<b/>').append('Category: '), value.category?.title, '<br>',
                            $('<b/>').append('Sub Category: '), value.subcategory?.title, '<br>',
                            $('<b/>').append('Child Category: '), value.category?.title, '<br>',
                            $('<b/>').append('Brand: ', value.brand?.name ?? ''), '<br>',
                        ),
                        $('<td/>', {style: 'width:40%','class':'text-center'}).append(
                            translation_verified
                        ),
                        $('<td/>',{style: 'width:5%','class':'text-center'}).append(product_feature),
                        $('<td/>',{style: 'width:5%','class':'text-center'}).append(product_status),
                        $('<td/>',{style: 'width:5%'}).append( new Date(value.created_at)),
                        $('<td/>').append(
                            $('<button/>', {
                                'class': 'btn btn-primary btn-sm w-100 mb-1',
                                'data-toggle': 'modal',
                                'data-target': '#variantmodal' + value.id

                            }).append(
                                'Variants'
                            ),
                            $('<a/>', {
                                href: 'products/' + value.id + '/reviews',
                                'class': 'btn btn-warning btn-sm mb-1 w-100 text-white',
                                'title': 'Go to All Reviews of This Product Page',
                            }).append('Reviews'),

                            $('<a/>', {
                                href: 'products/' + value.id + '/questions',
                                'class': 'btn btn-info btn-sm mb-1 w-100 text-white',
                                'title': 'Go to All Questions of This Product Page',
                            }).append('Questions'),
                        ),
                        $('<td/>').append(
                            editTranslation,
                            editProduct,
                            deleteProduct

                        )
                    )
                );
                //    product variants
                var variant_count = value.variants.length;
                var productVariants = []
                var productVariant;
                $.each(value.variants, function (index, value) {

                    var variantImage = ''
                    if (value.image) {
                        variantImage = $('<img/>', {src: response.imagesUrl + 'storage/product/variant/image/lg/' + value.image,'class':'rounded w-100'})
                    }
                    var status
                    if (value.availability) {
                        status = $('<span/>', {'class': 'text-success text-uppercase font-weight-bold'}).append('Yes')
                    } else {
                        status = $('<span/>', {'class': 'badge badge-lg badge-primary text-capitalize font-weight-bold'}).append('No')

                    }
                    var editProductVairant = '';
                    var deleteProductVariant = '';
                    if (response.edit) {
                        editProductVairant = '<a href="/vendor/products/' + value.id + '/edit? =true" title="Edit This Product Variant" class="btn btn-primary btn-sm m-1"><span class="btn-inner-icon "><i class="fa fa-edit text-white"></i></span></a>'
                    } else {
                        editProductVairant = ''
                    }
                    if (variant_count > 1) {
                        if (response.delete) {
                            deleteProductVariant = '<form action=\'/vendor/products/variant/' + value.id + '\' method="GET" class="d-inline"><input type="hidden" name="_token" value="' + $('meta[name="csrf-token"]').attr('content') + '"><button type="button" class="btn btn-danger btn-sm archive-btn" title="Delete This Product Variant "><span class="btn-inner-icon"><i class="fa fa-trash text-white"></i></span></button></form>\n'
                        } else {
                            deleteProductVariant = ''
                        }
                    }
                    productVariant = $('<tr/>').append(
                        $('<td/>',{style: 'width:10%'}).append(variantImage),
                        $('<td/>',{style: 'width:10%'}).append(value.seller_sku),
                        $('<td/>',{style: 'width:10%'}).append(value.price),
                        $('<td/>',{style: 'width:10%'}).append(value.special_price),
                        $('<td/>',{style: 'width:10%'}).append(value.quantity),
                        $('<td/>',{style: 'width:10%'}).append(status),
                        $('<td/>',{style: 'width:10%'}).append(
                            $('<div/>', {'class': 'row'}).append(
                                $('<div/>', {'class': 'med-col-6'}).append(editProductVairant),
                                $('<div/>', {'class': 'med-col-6 mt-1'}).append(deleteProductVariant)
                            )
                        ),
                    )
                    productVariants.push(productVariant)
                });

                $('#productVariantModels').append(
                    $('<div/>', {
                        'class': 'modal fade',
                        id: 'variantmodal' + value.id,
                        tabindex: '-1',
                        role: 'dialog',
                        'aria-labelledby': 'exampleModalLabel',
                        'aria-hidden': 'true'
                    }).append(
                        $('<div/>', {'class': 'modal-dialog', style: 'max-width: 60%;', role: 'document'}).append(
                            $('<div/>', {'class': 'modal-content'}).append(
                                $('<div/>', {'class': 'modal-header'}).append(
                                    $('<h5/>', {'class': 'modal-title', id: 'exampleModalLabel'}).append(
                                        'Variants Of ' + value.name
                                    ),
                                    $('<button/>', {
                                        type: 'button',
                                        'class': 'close',
                                        'data-dismiss': 'modal',
                                        'aria-label': 'CLose'
                                    }).append(
                                        $('<span/>', {'aria-hidden': 'true'}).append('&times;')
                                    )
                                ),
                                $('<div/>', {'class': 'modal-body'}).append(
                                    $('<table/>', {style: 'width:100%'}).append(
                                        $('<thead/>').append(
                                            $('<th/>',{style: 'width:10%'}).append('Variant Image'),
                                            $('<th/>',{style: 'width:10%'}).append('Product SKu'),
                                            $('<th/>',{style: 'width:10%'}).append('Price'),
                                            $('<th/>',{style: 'width:10%'}).append('Special'),
                                            $('<th/>',{style: 'width:10%'}).append('Quantity'),
                                            $('<th/>',{style: 'width:10%'}).append('Availability'),
                                            $('<th/>',{style: 'width:10%'}).append('Action'),
                                        ),
                                        $('<tbody/>').append(productVariants)
                                    )
                                ),
                                $('<div/>', {'class': 'modal-footer'}).append(
                                    $('<a/>', {
                                        href: '/vendor/products/' + value.variants[0].id + '/add-variant',
                                        type: 'button',
                                        'class': 'btn btn-primary'
                                    }).append(
                                        'Add Variant'
                                    ),
                                    $('<button/>', {
                                        type: 'button',
                                        'class': 'btn btn-secondary',
                                        'data-dismiss': 'modal'
                                    }).append('Close')
                                )
                            )
                        )
                    )
                )
            });


            $('#paginationList').empty()
            var links = [];
            var link
            $.each(response.products.links, function (index, value) {
                if (value.url == null && value.label == '&laquo; Previous') {
                    link = $('<li/>', {'class': 'Product-pagination page-item disabled'}).append(
                        $('<a/>', {href: '', 'class': 'page-link'}).append('Previous')
                    )
                }
                if (value.url != null && value.label == '&laquo; Previous') {
                    var previous = response.products.current_page - 1
                    link = $('<li/>', {'class': 'Product-pagination page-item '}).append(
                        $('<a/>', {href: '' + previous + '', 'class': 'page-link'}).append('Previous')
                    )
                }
                if (value.url == null && value.label == 'Next &raquo;') {
                    link = $('<li/>', {'class': 'Product-pagination page-item disabled'}).append(
                        $('<a/>', {href: '', 'class': 'page-link'}).append('Next')
                    )
                }
                if (value.url != null && value.label == 'Next &raquo;') {
                    var next = response.products.current_page + 1;
                    link = $('<li/>', {'class': 'Product-pagination page-item '}).append(
                        $('<a/>', {href: '' + next + '', 'class': 'page-link'}).append('Next')
                    )
                }
                if (value.label != '&laquo; Previous' && value.label != 'Next &raquo;') {
                    if (value.active) {
                        link = $('<li/>', {'class': 'Product-pagination page-item active'}).append(
                            $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                        )
                    } else {
                        link = $('<li/>', {'class': 'Product-pagination page-item '}).append(
                            $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                        )
                    }
                }
                links.push(link);
            })

            var from = 0;
            var to = 0;
            if (response.products.from) {
                from = response.products.from;
            }
            if (response.products.to) {
                to = response.products.to
            }
            $('#paginationList').append(
                $('<div/>', {'class': 'col-sm-12 col-md-5'}).append(
                    $('<div/>', {'class': 'dataTables_info'}).append(
                        'Showing ' + from + ' to ' + to + ' of ' + response.products.total + ' entries ',
                    )
                ),
                $('<div/>', {'class': 'col-sm-12 col-md-7'}).append(
                    $('<div/>', {'class': 'dataTables_paginate paging_simple_numbers'}).append(
                        $('<ul/>', {'class': 'pagination', id: 'productPagination'}).append(
                            links
                        )
                    )
                ),
            )

            $('.pre-loader').hide()

        },
        fail: function (e) {
            $('.pre-loader').hide()
            console.log(e)
        }
    });
}

/*
|===================================================================
| Products List end
|===================================================================
*/

/*
|===================================================================
| Reviews List Show
|===================================================================
*/


function getReviewsList(page_id) {
    var datatable_length = $('#review_datatable_length').val()
    var search = $('#reviewSearch').val()
    var primary_image;
    var review_image;
    var addResponse;
    var is_reportedBtn;
    var is_reported = 3
    var reviews = $('#reviews').val()

    $('.pre-loader').show()
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: '/vendor/reviews?page_id=' + page_id + '&datatable_length=' + datatable_length + '&search=' + search+ '&is_reported=' + is_reported + '&reviews=' + reviews,
        type: 'get',

        success: function (response) {
            $('#reviewsList').empty()

            console.log(response)

            $.each(response.reviews.data, function (index, value) {
                if (value.product_detail.primary_image) {
                    primary_image = ' <img src="' + response.imagesUrl + 'storage/product/images/sm/' + value.product_detail.primary_image + '"\n' +
                        'alt="" class=" rounded w-100" >'
                } else {
                    primary_image = '<img src="' + response.imagesUrl + '/product.svg"\n' +
                        'class=" rounded img-bdr-primary"> '
                }
                if (value.images[0]) {
                    review_image = ' <img src="' + response.imagesUrl + 'storage/images/products/reviews/lg/' + value.images[0].image + '"\n' +
                        'alt="" class=" rounded w-100" >'
                } else {
                    review_image = '<img src="' + response.imagesUrl + '/product.svg"\n' +
                        'class=" rounded img-bdr-primary"> '
                }
                if (!value.vendor_reply) {
                    addResponse = '<button title="Edit This Product" class="btn btn-primary btn-sm text-center reviewReply" data-id="'+ value.id +'">Reply</button>'
                } else {
                    addResponse = ''
                }

                //translation verified
                if (value.is_reported) {
                    // is_reportedBtn = $('<label/>', {'class': 'toggle-switch'}).append(
                    //     $('<input/>', {
                    //         type: 'checkbox',
                    //         name: 'translation_verified',
                    //         id: 'status-' + value.id + '',
                    //         'class': 'translation_verified_change',
                    //         'checked': 'checked',
                    //         'data-id': value.id
                    //     }),
                    //     $('<span/>', {'class': 'toggle-switch-slider'})
                    // )
                    is_reportedBtn =$('<span/>',{'class':'badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold'}).append('Yes')
                } else {
                    // is_reportedBtn = $('<label/>', {'class': 'toggle-switch'}).append(
                    //     $('<input/>', {
                    //         type: 'checkbox',
                    //         name: 'translation_verified',
                    //         id: 'status-' + value.id + '',
                    //         'class': 'translation_verified_change',
                    //         'data-id': value.id
                    //     }),
                    //     $('<span/>', {'class': 'toggle-switch-slider'})
                    // )
                    is_reportedBtn =$('<span/>',{'class':'badge badge-lg badge-pill badge-success text-uppercase font-weight-bold'}).append('No')
                }


                $("#reviewsList").append(
                    $('<tr/>').append(
                        $('<td/>', {style: 'width:10%'}).append(
                            primary_image
                        ),
                        $('<td/>', {style: 'width:10%'}).append(
                            $('<b/>').append('Product: '), value.product_detail.name, '<br>'
                        ),
                        $('<td/>',{style: 'width:10%'}).append(value.customer_review),
                        $('<td/>',{style: 'width:10%'}).append(review_image),
                        $('<td/>',{style: 'width:5%'}).append( value.customer_rating),
                        $('<td/>',{style: 'width:5%'}).append(value.vendor_reply),
                        $('<td/>',{'class':'text-center'}).append(addResponse,)
                    )
                );
            });


            $('#paginationList').empty()
            var links = [];
            var link
            $.each(response.reviews.links, function (index, value) {
                if (value.url == null && value.label == '&laquo; Previous') {
                    link = $('<li/>', {'class': 'review-pagination page-item disabled'}).append(
                        $('<a/>', {href: '', 'class': 'page-link'}).append('Previous')
                    )
                }
                if (value.url != null && value.label == '&laquo; Previous') {
                    var previous = response.reviews.current_page - 1
                    link = $('<li/>', {'class': 'review-pagination page-item '}).append(
                        $('<a/>', {href: '' + previous + '', 'class': 'page-link'}).append('Previous')
                    )
                }
                if (value.url == null && value.label == 'Next &raquo;') {
                    link = $('<li/>', {'class': 'review-pagination page-item disabled'}).append(
                        $('<a/>', {href: '', 'class': 'page-link'}).append('Next')
                    )
                }
                if (value.url != null && value.label == 'Next &raquo;') {
                    var next = response.reviews.current_page + 1;
                    link = $('<li/>', {'class': 'review-pagination page-item '}).append(
                        $('<a/>', {href: '' + next + '', 'class': 'page-link'}).append('Next')
                    )
                }
                if (value.label != '&laquo; Previous' && value.label != 'Next &raquo;') {
                    if (value.active) {
                        link = $('<li/>', {'class': 'review-pagination page-item active'}).append(
                            $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                        )
                    } else {
                        link = $('<li/>', {'class': 'review-pagination page-item '}).append(
                            $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                        )
                    }
                }
                links.push(link);
            })

            var from = 0;
            var to = 0;
            if (response.reviews.from) {
                from = response.reviews.from;
            }
            if (response.reviews.to) {
                to = response.reviews.to
            }
            $('#paginationList').append(
                $('<div/>', {'class': 'col-sm-12 col-md-5'}).append(
                    $('<div/>', {'class': 'dataTables_info'}).append(
                        'Showing ' + from + ' to ' + to + ' of ' + response.reviews.total + ' entries ',
                    )
                ),
                $('<div/>', {'class': 'col-sm-12 col-md-7'}).append(
                    $('<div/>', {'class': 'dataTables_paginate paging_simple_numbers'}).append(
                        $('<ul/>', {'class': 'pagination', id: 'reviewPagination'}).append(
                            links
                        )
                    )
                ),
            )

            $('.pre-loader').hide()

        },
        fail: function (e) {
            $('.pre-loader').hide()
            console.log(e)
        }
    });
}

/*
|===================================================================
| Reviews List end
|===================================================================
*/
/*
|===================================================================
| Questions List Show
|===================================================================
*/


function getQuestionsList(page_id) {
    var datatable_length = $('#questions_datatable_length').val()
    var search = $('#questionSearch').val()
    var primary_image;
    var review_image;
    var addResponse;
    var is_reportedBtn;
    var is_reported = 3
    var reviews = $('#questions').val()

    $('.pre-loader').show()
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: '/vendor/questions?page_id=' + page_id + '&datatable_length=' + datatable_length + '&search=' + search+ '&is_reported=' + is_reported + '&reviews=' + reviews,
        type: 'get',

        success: function (response) {
            $('#questionsList').empty()

            console.log(response)

            $.each(response.questions.data, function (index, value) {
                if (value.product_detail.primary_image) {
                    primary_image = ' <img src="' + response.imagesUrl + 'storage/product/images/sm/' + value.product_detail.primary_image + '"\n' +
                        'alt="" class=" rounded w-100" >'
                } else {
                    primary_image = '<img src="' + response.imagesUrl + '/product.svg"\n' +
                        'class=" rounded img-bdr-primary"> '
                }
                if (!value.vendor_reply) {
                    addResponse = '<button title="Edit This Product" class="btn btn-primary btn-sm text-center questionReply" data-id="'+ value.id +'">Reply</button>'
                } else {
                    addResponse = ''
                }


                $("#questionsList").append(
                    $('<tr/>').append(
                        $('<td/>', {style: 'width:10%'}).append(
                            primary_image
                        ),
                        $('<td/>', {style: 'width:10%'}).append(
                            $('<b/>').append('Product: '), value.product_detail.name, '<br>'
                        ),
                        $('<td/>',{style: 'width:10%'}).append(value.customer_question),
                        $('<td/>',{style: 'width:5%'}).append(value.vendor_reply),
                        $('<td/>',{'class':'text-center'}).append(addResponse,)
                    )
                );
            });


            $('#paginationList').empty()
            var links = [];
            var link
            $.each(response.questions.links, function (index, value) {
                if (value.url == null && value.label == '&laquo; Previous') {
                    link = $('<li/>', {'class': 'questions-pagination page-item disabled'}).append(
                        $('<a/>', {href: '', 'class': 'page-link'}).append('Previous')
                    )
                }
                if (value.url != null && value.label == '&laquo; Previous') {
                    var previous = response.questions.current_page - 1
                    link = $('<li/>', {'class': 'questions-pagination page-item '}).append(
                        $('<a/>', {href: '' + previous + '', 'class': 'page-link'}).append('Previous')
                    )
                }
                if (value.url == null && value.label == 'Next &raquo;') {
                    link = $('<li/>', {'class': 'questions-pagination page-item disabled'}).append(
                        $('<a/>', {href: '', 'class': 'page-link'}).append('Next')
                    )
                }
                if (value.url != null && value.label == 'Next &raquo;') {
                    var next = response.questions.current_page + 1;
                    link = $('<li/>', {'class': 'questions-pagination page-item '}).append(
                        $('<a/>', {href: '' + next + '', 'class': 'page-link'}).append('Next')
                    )
                }
                if (value.label != '&laquo; Previous' && value.label != 'Next &raquo;') {
                    if (value.active) {
                        link = $('<li/>', {'class': 'questions-pagination page-item active'}).append(
                            $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                        )
                    } else {
                        link = $('<li/>', {'class': 'questions-pagination page-item '}).append(
                            $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                        )
                    }
                }
                links.push(link);
            })

            var from = 0;
            var to = 0;
            if (response.questions.from) {
                from = response.questions.from;
            }
            if (response.questions.to) {
                to = response.questions.to
            }
            $('#paginationList').append(
                $('<div/>', {'class': 'col-sm-12 col-md-5'}).append(
                    $('<div/>', {'class': 'dataTables_info'}).append(
                        'Showing ' + from + ' to ' + to + ' of ' + response.questions.total + ' entries ',
                    )
                ),
                $('<div/>', {'class': 'col-sm-12 col-md-7'}).append(
                    $('<div/>', {'class': 'dataTables_paginate paging_simple_numbers'}).append(
                        $('<ul/>', {'class': 'pagination', id: 'questionsPagination'}).append(
                            links
                        )
                    )
                ),
            )

            $('.pre-loader').hide()

        },
        fail: function (e) {
            $('.pre-loader').hide()
            console.log(e)
        }
    });
}

/*
|===================================================================
| Questions List end
|===================================================================
*/

/*
|===================================================================
| Variants List Show
|===================================================================
*/


function getVariantsList(page_id) {
    var datatable_length = $('#variants_datatable_length').val()
    var search = $('#variantsSearch').val()
    var primary_image;
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: '/vendor/products/variants?page_id=' + page_id + '&datatable_length=' + datatable_length + '&search=' + search,
        type: 'get',

        success: function (response) {
            $('#variantsList').empty()
            $.each(response.products.data, function (index, product) {
                $.each(product.variants, function (index, value) {


                    if (product.primary_image) {
                        primary_image = ' <img src="' + response.imagesUrl + 'storage/product/images/sm/' + product.primary_image + '"\n' +
                            'alt="" class=" rounded img-bdr-primary" style="width:35%">'
                    } else {
                        primary_image = '<img src="' + response.imagesUrl + 'product.svg"\n' +
                            'class=" rounded img-bdr-primary" style="width:35%"> '
                    }
                    var status
                    if (value.availability) {
                        status = $('<span/>', {'class': 'text-success text-uppercase font-weight-bold'}).append('Yes')
                    } else {
                        status = $('<span/>', {'class': 'badge badge-lg badge-primary text-capitalize font-weight-bold'}).append('No')

                    }
                    var editProductVairant = '';
                    if (response.edit) {
                        editProductVairant = '<a href="/vendor/products/' + value.id + '/edit? =true" title="Edit This Product Variant" class="btn btn-primary btn-sm m-1"><span class="btn-inner-icon "><i class="fa fa-edit text-white"></i></span></a>'
                    } else {
                        editProductVairant = ''
                    }
                    $('#variantsList').append($('<tr/>').append(
                            $('<td/>').append(primary_image),
                            $('<td/>').append(product.name),
                            $('<td/>').append(value.seller_sku),
                            $('<td/>').append(value.price),
                            $('<td/>').append(value.special_price),
                            $('<td/>').append(value.quantity),
                            $('<td/>').append(status),
                            $('<td/>').append(editProductVairant),
                        )
                    )
                });
            });


            $('#paginationList').empty()
            var links = [];
            var link
            $.each(response.products.links, function (index, value) {
                if (value.url == null && value.label == '&laquo; Previous') {
                    link = $('<li/>', {'class': 'variants-pagination page-item disabled'}).append(
                        $('<a/>', {href: '', 'class': 'page-link'}).append('Previous')
                    )
                }
                if (value.url != null && value.label == '&laquo; Previous') {
                    var previous = response.products.current_page - 1
                    link = $('<li/>', {'class': 'variants-pagination page-item '}).append(
                        $('<a/>', {href: '' + previous + '', 'class': 'page-link'}).append('Previous')
                    )
                }
                if (value.url == null && value.label == 'Next &raquo;') {
                    link = $('<li/>', {'class': 'variants-pagination page-item disabled'}).append(
                        $('<a/>', {href: '', 'class': 'page-link'}).append('Next')
                    )
                }
                if (value.url != null && value.label == 'Next &raquo;') {
                    var next = response.products.current_page + 1;
                    link = $('<li/>', {'class': 'variants-pagination page-item '}).append(
                        $('<a/>', {href: '' + next + '', 'class': 'page-link'}).append('Next')
                    )
                }
                if (value.label != '&laquo; Previous' && value.label != 'Next &raquo;') {
                    if (value.active) {
                        link = $('<li/>', {'class': 'variants-pagination page-item active'}).append(
                            $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                        )
                    } else {
                        link = $('<li/>', {'class': 'variants-pagination page-item '}).append(
                            $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                        )
                    }
                }
                links.push(link);
            })
            var from = 0
            var to = 0
            if (response.products.from) {
                from = response.products.from
            }
            if (response.products.to) {
                to = response.products.to
            }
            $('#paginationList').append(
                $('<div/>', {'class': 'col-sm-12 col-md-5'}).append(
                    $('<div/>', {'class': 'dataTables_info'}).append(
                        'Showing ' + from + ' to ' + to + ' of ' + response.products.total + ' entries ',
                    )
                ),
                $('<div/>', {'class': 'col-sm-12 col-md-7'}).append(
                    $('<div/>', {'class': 'dataTables_paginate paging_simple_numbers'}).append(
                        $('<ul/>', {'class': 'pagination', id: 'productPagination'}).append(
                            links
                        )
                    )
                ),
            )


        },
        fail: function (e) {
            console.log(e)
        }
    });
}

/*
|===================================================================
| Variants List end
|===================================================================
*/

/*
|===================================================================
| Variants List Show
|===================================================================
*/


function getNotificationList(page_id) {
    var datatable_length = $('#notifications_datatable_length').val()
    var search = $('#notificationsSearch').val()
    var primary_image;
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: '/vendor/notifications/all?page_id=' + page_id + '&datatable_length=' + datatable_length + '&search=' + search,
        type: 'get',

        success: function (response) {
            console.log(response)
            $('#notificationsList').empty()
            $.each(response.notifications.data, function (index, value) {
                edit = '<a href="/' + value.link + '" title="View Notification" class="btn btn-primary btn-sm m-1"><span class="btn-inner-icon "><i class="fa fa-eye text-white"></i></span></a>'

                $('#notificationsList').append($('<tr/>').append(
                        $('<td/>').append($('<div/>', {'class': 'order-icon'}).append($('<img/>', {src: '/assets/images/notification/' + value.icon + '.svg'}))),
                        $('<td/>').append(value.message),
                        $('<td/>').append(value.created_at),
                        $('<td/>').append(value.updated_at),
                        $('<td/>').append(
                            $('<div/>', {'class': 'row'}).append(
                                $('<div/>', {'class': 'med-col-6'}).append(edit),
                            )
                        ),
                    )
                )
            });


            $('#paginationList').empty()
            var links = [];
            var link
            $.each(response.notifications.links, function (index, value) {
                if (value.url == null && value.label == '&laquo; Previous') {
                    link = $('<li/>', {'class': 'notifications-pagination page-item disabled'}).append(
                        $('<a/>', {href: '', 'class': 'page-link'}).append('Previous')
                    )
                }
                if (value.url != null && value.label == '&laquo; Previous') {
                    var previous = response.notifications.current_page - 1
                    link = $('<li/>', {'class': 'notifications-pagination page-item '}).append(
                        $('<a/>', {href: '' + previous + '', 'class': 'page-link'}).append('Previous')
                    )
                }
                if (value.url == null && value.label == 'Next &raquo;') {
                    link = $('<li/>', {'class': 'notifications-pagination page-item disabled'}).append(
                        $('<a/>', {href: '', 'class': 'page-link'}).append('Next')
                    )
                }
                if (value.url != null && value.label == 'Next &raquo;') {
                    var next = response.notifications.current_page + 1;
                    link = $('<li/>', {'class': 'notifications-pagination page-item '}).append(
                        $('<a/>', {href: '' + next + '', 'class': 'page-link'}).append('Next')
                    )
                }
                if (value.label != '&laquo; Previous' && value.label != 'Next &raquo;') {
                    if (value.active) {
                        link = $('<li/>', {'class': 'notifications-pagination page-item active'}).append(
                            $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                        )
                    } else {
                        link = $('<li/>', {'class': 'notifications-pagination page-item '}).append(
                            $('<a/>', {href: '' + value.label + '', 'class': 'page-link'}).append('' + value.label + '')
                        )
                    }
                }
                links.push(link);
            })
            var from = 0
            var to = 0
            if (response.notifications.from) {
                from = response.notifications.from
            }
            if (response.notifications.to) {
                to = response.notifications.to
            }
            $('#paginationList').append(
                $('<div/>', {'class': 'col-sm-12 col-md-5'}).append(
                    $('<div/>', {'class': 'dataTables_info'}).append(
                        'Showing ' + from + ' to ' + to + ' of ' + response.notifications.total + ' entries ',
                    )
                ),
                $('<div/>', {'class': 'col-sm-12 col-md-7'}).append(
                    $('<div/>', {'class': 'dataTables_paginate paging_simple_numbers'}).append(
                        $('<ul/>', {'class': 'pagination', id: 'productPagination'}).append(
                            links
                        )
                    )
                ),
            )


        },
        fail: function (e) {
            console.log(e)
        }
    });
}

/*
|===================================================================
| Variants List end
|===================================================================
*/
