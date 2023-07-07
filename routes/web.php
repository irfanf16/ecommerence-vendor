<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Vendor\VendorAjaxRequestsController;
use App\Http\Controllers\Vendor\VendorDashboardController;
use App\Http\Controllers\Vendor\VendorProductController;
use App\Http\Controllers\Vendor\VendorOrderController;
use App\Http\Controllers\Vendor\VendorCouponsController;
use App\Http\Controllers\Vendor\VendorProductQuestionsController;
use App\Http\Controllers\Vendor\VendorProductReviewsController;
use App\Http\Controllers\Vendor\VendorSettingsController;
use App\Http\Controllers\Vendor\VendorNotificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|========================================================================
|   AUTH ROUTES
|========================================================================
*/
Route::group(['middleware' => ['guest']], function () {
    Route::get('/', [AuthController::class, 'vendorLoginForm']);
    Route::post('/vendor/login', [AuthController::class, 'vendorLogin']);
});
Route::get('/logout', [AuthController::class, 'logout']);
Auth::routes(['verify' => true]);

/*
|==========================================================================
| Vendor ROUTES
|==========================================================================
*/
Route::group(['prefix' => 'vendor', 'middleware' => ['isVendor']], function () {

    // DASHBOARD
    Route::get('dashboard', [VendorDashboardController::class, 'index']);

    // PRODUCT
    Route::get('products/variants', [VendorProductController::class, 'variantIndex']);
    Route::get('products/variant/{id}', [VendorProductController::class, 'variantDelete']);
    Route::get('products/{id}/add-variant', [VendorProductController::class, 'addVariant']);
    Route::post('products/{id}/add-variant', [VendorProductController::class, 'storeNewVariant']);
    Route::get('products/{id}/editTranslation', [VendorProductController::class, 'editTranslation']);
    Route::put('products/{id}/updateTranslation', [VendorProductController::class, 'updateTranslation']);
    Route::get('product/change/status', [VendorProductController::class, 'changeStatus']);
    Route::resource('products', VendorProductController::class);
    Route::post('products/destroy/{id}',[VendorProductController::class,'destroy'])->name('products.destroy');


    // PRODUCT QUESTIONS
    Route::get('questions', [VendorProductQuestionsController::class, 'index']);
    Route::post('question/reply', [VendorProductQuestionsController::class, 'replyQuestion']);
    Route::get('products/{pid}/questions', [VendorProductQuestionsController::class, 'productQuestions']);


    // PRODUCT REVIEWS
    Route::get('reviews', [VendorProductReviewsController::class, 'index']);
    Route::post('review/reply', [VendorProductReviewsController::class, 'replyReview']);
    Route::get('products/{pid}/reviews', [VendorProductReviewsController::class, 'productReviews']);



    Route::get('product/upload-csv', [VendorProductController::class, 'csvUploadPage']);
    Route::post('product/upload-csv', [VendorProductController::class, 'uploadCSVFile']);
    Route::post('delete-product-image', [VendorProductController::class, 'deleteProductImage']);

    // ORDER
    Route::resource('orders', VendorOrderController::class);
    Route::post('order-status', [VendorOrderController::class, 'orderStatus']);
    Route::post('order/status/listing', [VendorOrderController::class, 'orderStatusListing']);
    Route::post('order-status/{id}', [VendorOrderController::class, 'orderStatusUpdate']);
    Route::get('order-invoice/{id}', [VendorOrderController::class, 'orderInvoice']);


    // COUPONS
    Route::resource('coupons', VendorCouponsController::class);
    Route::post('coupon/update-status', [VendorCouponsController::class, 'updateStatus']);


    // GENERAL-SETTINGS
    Route::post('settings/account/edit', [VendorSettingsController::class, 'editAccountSettings']);
    Route::put('settings/account', [VendorSettingsController::class, 'updateAccountSettings']);
    Route::get('/account/edit', [VendorSettingsController::class, 'index']);
    Route::patch('/account/{id}', [VendorSettingsController::class, 'update']);


    // NOTIFICATIONS
    Route::get('notifications/recent', [VendorNotificationController::class, 'recentNotifications']);
    Route::get('notifications/all', [VendorNotificationController::class, 'allNotifications']);
    Route::get('notification/status', [VendorNotificationController::class, 'statusNotification']);

});


/*
|===========================================================
| AJAX ROUTES
|===========================================================
*/
Route::group(
    ['prefix' => '/vendor/ajax/', 'middleware' => []],
    function () {
        Route::get('categories', [VendorAjaxRequestsController::class, 'categoriesList']);
        Route::post('subcategories-brands', [VendorAjaxRequestsController::class, 'subcategoriesBrandsList']);
        Route::post('childcategories-attributes', [VendorAjaxRequestsController::class, 'childcategoriesAttributesList']);
        Route::post('childcategory-brands', [VendorAjaxRequestsController::class, 'childcategory_brands']);
        Route::get('brands', [VendorAjaxRequestsController::class, 'brandsList']);
        Route::get('attributes', [VendorAjaxRequestsController::class, 'attributesList']);
        Route::get('variants', [VendorAjaxRequestsController::class, 'variantsList']);
    }
);
