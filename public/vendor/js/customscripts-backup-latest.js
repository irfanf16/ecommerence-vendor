const { keys } = require("lodash");

/*
|===============================================
|  GET SPECIFIC SUBCATEGORIES-BRANDS USING AJAX
|===============================================
*/
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
        url: "/vendor/ajax/subcategories-brands", // Local Link
        data: {
            id: category_id,
        },
        success: function (response) {
            //  console.log(response);
            //  return;

            let subcategories = response.subcategories.length;
            let brands = response.brands.length;

            if (subcategories > 0) {
                $("#subcategory").empty();
                $("#childcategory").empty();
                subcategories = response.subcategories;
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
|===============================================
|  GET SPECIFIC CHILDCATEGORIES-ATTRIBUTES USING AJAX
|===============================================
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
        url: "/vendor/ajax/childcategories-attributes", // Local Link
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
                $("#childcategory").empty();
                childcategories = response.childcategories;
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

            if (attr > 0) {
                $("#attributes-div").html("");
                attributes = response.attributes;
                attributes.forEach(function (attribute) {
                    var attributeId = `selectattr-${attribute.id}`;
                    var attributeTitle = attribute.title;

                    if (attribute.keys.length > 0) {
                        $("#attributes-div").append(`
                            <div class="col-md-6 mt-4 pl-0">
                            <div class="row">
                                <div class="col-md-4">
                                <label for="attribute"class="control-label float-right">${attributeTitle}
                                    <sup class="text-danger">*</sup></label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control show-tick ms select2 data" callerName="${attributeTitle}" name="${attributeTitle}" id="${attributeId}">
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
                    }
                });
            } else {
                $("#attributes").html(
                    '<option value="" selected>No Record Found</option>'
                );
            }

            // $("#product-attribute-list").change(function () {
            //     var selected = $(this).val();
            //     $(".fixed-table th.dynamic-head").append(selected);
            //     $(".fixed-table td.dynamic-content").append(selected);
            //     console.log("selected", selected);
            // });
        },
    });
}

/*
|===============================================
|  GET BRANDS USING AJAX On Selected Category
|===============================================
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
|===============================================
|  GET SPECIFIC ATTRIBUTES USING AJAX
|===============================================
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
|===============================================
|  sign up slider
|===============================================
*/
$("#myCarousel").carousel({
    interval: 2500,
});
