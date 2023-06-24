<?php

// AUTH-CONTROLLER

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthController;

// VENDOR-CONTROLLERS
use App\Http\Controllers\Vendor\VendorCommissionController;
use App\Http\Controllers\Vendor\VendorDashboardController;
use App\Http\Controllers\Vendor\VendorProductController;
use App\Http\Controllers\Vendor\VendorOrderController;
use App\Http\Controllers\Vendor\VendorCouponsController;
use App\Http\Controllers\Vendor\VendorProductQuestionsController;
use App\Http\Controllers\Vendor\VendorProductReviewsController;
use App\Http\Controllers\Vendor\VendorSettingsController;
use App\Http\Controllers\Vendor\VendorProfileController;
use App\Http\Controllers\Vendor\VendorNotificationController;

// AJAX CONTROLLERS
use App\Http\Controllers\Vendor\VendorAjaxRequestsController;

// EXTRA
use App\Http\Controllers\Vendor\VendorStatisticController;
use App\Http\Controllers\Vendor\VendorStoreController;
use App\Http\Controllers\Vendor\VendorCategoryController;
use App\Http\Controllers\Vendor\VendorSubCategoryController;
use App\Http\Controllers\Vendor\VendorChildCategoryController;
use App\Http\Controllers\Vendor\VendorBrandsController;
use App\Http\Controllers\Vendor\VendorAttributesController;
use App\Http\Controllers\Vendor\VendorVariantsController;


// namespace App\Http\Controllers\Auth;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Route;

// TESTING EVENTS
use App\Http\Controllers\PusherNotificationController;
use App\Http\Controllers\Vendor\RoleController;
use App\Http\Controllers\Vendor\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// use Illuminate\Routing\Route;

/*
|========================================================================
|   AUTH ROUTES
|========================================================================
*/
Route::group(['middleware' => []], function () {

    Route::get('/', [AuthController::class, 'registerForm']);
    Route::get('/vendor/login', [AuthController::class, 'vendorLoginForm']);
    Route::post('/vendor/login', [AuthController::class, 'vendorLogin']);
    Route::get('/vendor/register', [AuthController::class, 'registerForm']);
    Route::post('/vendor/register', [AuthController::class, 'registerVendor'])->name('registerVendor');
    Route::post('/vendor/validate-unique-email', [AuthController::class, 'validateUniqueEmail']);
    Route::post('/vendor/validate-unique-mobile', [AuthController::class, 'validateUniqueMobile']);

    // PASSWORD-RESET -- EMAIL
    Route::get('/password/reset/email', [AuthController::class, 'resetPasswordWithEmailPage']);
    Route::post('/password/reset/email/send-link', [AuthController::class, 'sendPasswordResetLink']);
    Route::get('/password/reset/email/reset-password/{code}', [AuthController::class, 'matchResetPasswordCode']);
    Route::post('/password/reset/email/update-password', [AuthController::class, 'updatePasswordViaEmail']);

    // PASSWORD-RESET -- OTP
    Route::get('/password/reset/mobile', [AuthController::class, 'resetPasswordViaOtp']);
    Route::post('/password/reset/mobile', [AuthController::class, 'sendMessageOtp']);
    Route::post('/password/reset/mobile/verify-otp', [AuthController::class, 'verify_otp'])->name('verify-otp');
    Route::post('/password/reset/mobile/update-password', [AuthController::class, 'updatePassword']);
});
Route::get('/logout', [AuthController::class, 'logout']);
Auth::routes(['verify' => true]);
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');


/*
|========================================================================
|   TWILLIO - OTP MOBILE-NO VERIFICATION
|========================================================================
*/
Route::post('/verify-phone', [AuthController::class, 'verifyPhone']);
Route::get('/mobile/verify', [AuthController::class, 'confirmOTP']);
Route::post('/mobile/verify', [AuthController::class, 'verifyOTP']);


/*
|========================================================================
|   EMAIL VERIFICATION
|========================================================================
*/
Route::post('verify-email', [AuthController::class, 'verifyEmail']);
Route::get('email-verify/{confirmationCode}', [AuthController::class, 'confirmEmailCode']);
// Route::get('email-verify/{confirmationCode}', [
//     'as' => 'confirmation_path',
//     'uses' => 'App\Http\Controllers\AuthController@confirm_email_code'
// ]);

/*
|=========================================================================
|   SOCIALITE ROUTES
|=========================================================================
*/
Route::get('auth/social', [AuthController::class, 'show'])->name('social.login');;
Route::get('oauth/{driver}', [AuthController::class, 'redirectToProvider'])->name('social.oauth');
Route::get('oauth/{driver}/callback', [AuthController::class, 'handleProviderCallback'])->name('social.callback');





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


    // User management
    Route::resource('users' , UserController::class);

    // Role management
    Route::resource('roles' , RoleController::class);


    // COUPONS
    Route::resource('coupons', VendorCouponsController::class);
    Route::post('coupon/update-status', [VendorCouponsController::class, 'updateStatus']);

    // STORE
    Route::resource('stores', VendorStoreController::class);
    Route::resource('categories', VendorCategoryController::class);
    Route::resource('subcategories', VendorSubCategoryController::class);
    Route::resource('childcategories', VendorChildCategoryController::class);

    // PROFILE
    Route::get('profile/edit', [VendorProfileController::class, 'editProfile']);
    Route::post('basic-info', [VendorProfileController::class, 'vendorBasicInfo']);
    Route::post('business-info', [VendorProfileController::class, 'vendorBusinessInfo']);
    Route::post('store-info', [VendorProfileController::class, 'vendorStoreInfo']);
    Route::post('documents', [VendorProfileController::class, 'vendorBusinessDocuments']);
    Route::post('bank-info', [VendorProfileController::class, 'vendorBankInfo']);
    Route::post('warehouse', [VendorProfileController::class, 'vendorWarehouseInfo']);
    Route::post('return-warehouse', [VendorProfileController::class, 'vendorReturnWarehouseInfo']);
    Route::post('save-review', [VendorProfileController::class, 'saveReview']);

    // PREVIEW BUSINESS DOCUMENT
    Route::get('doc/preview/{id}', [VendorProfileController::class, 'previewBusinessDocument']);
    Route::get('doc/bank/preview/{id}', [VendorProfileController::class, 'previewBankDocument']);

    // GENERAL-SETTINGS
    Route::post('settings/account/edit', [VendorSettingsController::class, 'editAccountSettings']);
    Route::put('settings/account', [VendorSettingsController::class, 'updateAccountSettings']);
    Route::get('/account/edit', [VendorSettingsController::class, 'index']);
    Route::patch('/account/{id}', [VendorSettingsController::class, 'update']);


    // NOTIFICATIONS
    Route::get('notifications/recent', [VendorNotificationController::class, 'recentNotifications']);
    Route::get('notifications/all', [VendorNotificationController::class, 'allNotifications']);
    Route::get('notification/status', [VendorNotificationController::class, 'statusNotification']);



    Route::get('activities/profile', [ActivityController::class , 'profileActivities']  );

    // commission structure
    Route::prefix('commissions')->group(function (){
        Route::get('structure',[VendorCommissionController::class,'appliedCommissionSection']);
        Route::get('/',[VendorCommissionController::class,'index']);
    });

    Route::prefix('inside')->group(function(){
        Route::get('statistic',[VendorStatisticController::class,'index']);
    });


});



//testing Emails
use App\Mail\sendUserOrderPlace;
use App\Mail\sendVendorOrderPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

Route::get("/emailformats", function () {
    return View::make("vendor.emailFormats.index");
});
// EMAIL SENT to User
Route::POST('user-placed', function (Request $request) {
    Mail::to($request->email)->send(new sendUserOrderPlace());
    return back();
});
// EMAIL SENT to vendor
Route::POST('vendor-placed', function (Request $request) {
    Mail::to($request->email)->send(new sendVendorOrderPlace());
    return back();
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

// buyer Email Testing
Route::get('buyer_email', function () {
    return view('email.buyer_email');
});
// vendor Email Testing
Route::get('vendor_email', function () {
    return view('email.vendor_email');
});
// vendor invoice Testing
Route::get('invoice', function () {
    return view('email.invoice');
});
// vendor invoice Testing
Route::get('status', function () {
    return view('email.order_');
});

Route::get('test_otp', function () {
    return view('test_otp');
});
Route::get('pusher', function () {
    return view('pusher');
});
// Route::get('pusher/{name}',[PusherNotificationController::class , 'sendEvent']);

    Route::post('/notifications/update_session/', function (Request $request) {
    session()->put('notifications', $request->notifications);

    return response()->json([
        'status' => 200,
        'notifications' => session()->get('notifications'),
        'EQUEST'=> $request->notifications
    ]);

});
