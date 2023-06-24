<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Traits\userPermissionCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Image;

use App\Imports\ProductsImport;
use App\Models\Product;
use App\Traits\ApiHelper;
use App\Traits\ApiModel;
use Maatwebsite\Excel\Facades\Excel;

// FOR GUZZLE HTTP REQUEST
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use Illuminate\Support\Facades\Session as FacadesSession;

class VendorProductController extends Controller
{

    use ApiHelper;
    use ApiModel, userPermissionCheck;

    /*
    |==================================================================
    | Get Listing of the All Products By This Vendor -- API index()
    |==================================================================
    */
    public function __construct()
    {
        $this->middleware('permissions:vendor-products-write', ['only' => ['create','store','addVariant']]);
        $this->middleware('permissions:vendor-products-edit', ['only' => ['edit','update','destroy','variantDelete','editTranslation','updateTranslation','changeStatus']]);
        $this->middleware('permissions:vendor-products-read', ['only' => ['index','variantIndex']]);

    }
    public function variantIndex(Request $request)
    {

        try {
            if ($request->ajax()) {
                $response = Product::getBy('/list?page=' . $request->page_id . '&ajaxRequest=1&datatable_length=' . $request->datatable_length . '&search=' . $request->search);
                $status = $response->status;
                if ($status == 200) {
                    $products = $response->products;
                    $imagesUrl = $response->imagesUrl;
                    $edit = $this->userPermissionCheck('vendor-products-edit');
                    $delete = $this->userPermissionCheck('vendor-products-edit');

                    return response()->json(['status' => true, 'products' => $products, 'imagesUrl' => config('app.url'), 'edit' => $edit, 'delete' => $delete]);
                }
            }
            $response = Product::getBy('/list');
            $status = $response->status;
            if ($status == 200) {

//                $products          = $response->products;
                $products_count = $response->products_count;
                $active_products = $response->active_products;
                $inactive_products = $response->inactive_products;
                $featured_products = $response->featured_products;
                $store_info = $response->store_info;
                return view('vendor.products.variants')
//                    ->with(['products'         => $products])
                    ->with(['products_count' => $products_count])
                    ->with(['active_products' => $active_products])
                    ->with(['inactive_products' => $inactive_products])
                    ->with(['featured_products' => $featured_products])
                    ->with(['store_info' => $store_info]);
            }
            dd($status, $response, 'Something Went Wrong');

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }


    /*
    |==================================================================
    | Get Listing of the All Products By This Vendor -- API index()
    |==================================================================
    */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $response = Product::getBy('/list?page=' . $request->page_id . '&ajaxRequest=1&datatable_length=' . $request->datatable_length . '&search=' . $request->search. '&category_id=' . $request->category_id . '&subcategory_id=' . $request->subcategory_id . '&childcategory_id=' . $request->childcategory_id . '&brand_id=' . $request->brand_id . '&status=' . $request->status . '&featured=' . $request->featured . '&from_date=' . $request->from_date . '&to_date=' . $request->to_date . '&translation=' . $request->translation);
                $status = $response->status;
                if ($status == 200) {
                    $products = $response->products;
                    $imagesUrl = $response->imagesUrl;
                    $edit = $this->userPermissionCheck('vendor-products-edit');
                    $delete = $this->userPermissionCheck('vendor-products-edit');
                    Session::put('product_page_id', $request->page_id);
                    Session::put('product_datatable_length', $request->datatable_length);
                    Session::put('category_id', $request->category_id);
                    Session::put('subcategory_id', $request->subcategory_id);
                    Session::put('childcategory_id', $request->childcategory_id);
                    Session::put('store_id', $request->store_id);
                    Session::put('brand_id', $request->brand_id);
                    if ($request->has('status') && $request->filled('status')) {
                        Session::put('status', $request->status == 1 ? 1 : 2);
                    }else{
                        Session::put('status', 3);
                    }
                    if ($request->has('featured') && $request->filled('featured')) {
                        Session::put('featured', $request->featured == 1 ? 1 : 2);
                    }else{
                        Session::put('featured',3);
                    }
                    if ($request->has('translation') && $request->filled('translation')) {
                        Session::put('translation', $request->translation == 1 ? 1 : 2);
                    }else{
                        Session::put('translation',3);
                    }
                    Session::put('from_date', $request->from_date);
                    Session::put('to_date', $request->to_date);
                    return response()->json(['status' => true, 'products' => $products, 'imagesUrl' => config('app.url'), 'edit' => $edit, 'delete' => $delete]);
                }
            }
            $response = Product::getBy('/list');
            $status = $response->status;
            if ($status == 200) {

                $products_count = $response->products_count;
                $active_products = $response->active_products;
                $inactive_products = $response->inactive_products;
                $featured_products = $response->featured_products;
                $store_info = $response->store_info;
                $categories = $response->categories;
                $sub_categories = $response->sub_categories;
                $child_categories = $response->child_categories;
                $brands = $response->brands;
                return view('vendor.products.products')
                    ->with(['products_count' => $products_count])
                    ->with(['active_products' => $active_products])
                    ->with(['inactive_products' => $inactive_products])
                    ->with(['featured_products' => $featured_products])
                    ->with(['categories' => $categories])
                    ->with(['sub_categories' => $sub_categories])
                    ->with(['child_categories' => $child_categories])
                    ->with(['brands' => $brands])
                    ->with(['store_info' => $store_info]);
            }
            dd($status, $response, 'Something Went Wrong');

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }


    /*
    |==================================================================
    | Get Required Listings For Creating a New Product -- API create()
    |==================================================================
    */
    public function create()
    {
        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = NULL;
        $url = config('app.url') . 'api/vendor/products/create';

        try {
            $response = \Unirest\Request::get($url, $headers, $body);
            // dd($response);

            $status = $response->body->status;
            if ($status == 200) {

                $has_store = $response->body->store_info->id ?? null;
                if (!$has_store) {
                    return view('vendor.products.complete_store');
                }

                $categories = $response->body->categories;
                $warranty = $response->body->warranty;

                return view('vendor.products.create')->with(['has_store' => $has_store])
                    ->with(['categories' => $categories])
                    ->with(['warranty' => $warranty]);
            }
            return "Something Went Wrong";

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }


    /*
    |==================================================================
    | Go To CSV-File-Upload Page For Products Bulk Upload -- API create()
    |==================================================================
    */
    public function csvUploadPage()
    {
        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = NULL;
        $url = config('app.url') . 'api/vendor/products/create';
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $has_store = $response->body->store_info;

            return view('vendor.products.csv')->with(['has_store' => $has_store]);
        }

        return "Something Went Wrong";
    }


    public function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }


    /*
    |==================================================================
    | Upload CSV FILE For Products Bulk Uploading -- API create()
    |==================================================================
    */
    public function uploadCSVFile(Request $request)
    {
        // dd($request->csv);

        // $excel = Excel::import(new ProductsImport, $request->file('csv'));

        $excel = \Importer::make('Excel');
        dd($excel);

        $excel->load($request->file);
        $collection = $excel->getCollection();

        dd($collection);


        $validator = \Validator::make($request->all(), [
            'file' => 'required|max:5000|mimes:xlsx,xls,csv'
        ]);

        if ($validator->passes()) {

            $excel = \Importer::make('Excel');
            $excel->load($request->file);
            $collection = $excel->getCollection();

            // CHECK NO OF COLUMNS IN EXCEL FILE
            if (sizeof($collection[1]) == 9) {

                for ($i = 2; $i < sizeof($collection); $i++) {

                    $spins_token = $this->generateRandomString(6);
                    $formData = [
                        'name' => $collection[$i][1],
                        'email' => $collection[$i][2],
                        'no_of_spins' => $collection[$i][3],
                        'spins_used' => $collection[$i][4],
                        'spins_remaining' => $collection[$i][3] - $collection[$i][4],
                        'spins_token' => $spins_token,
                        'is_token_used' => 0,
                        'prize' => $collection[$i][5],
                        'status' => 1,
                    ];

                    // dd($formData);
                    $winner = new winner();
                    $isSaved = $winner->create($formData);
                }

                // AFTER FILE UPLOAD
                Session::flash('response', array("status" => 200,
                    "action" => 'add',
                    "message" => 'Winner Records Added Successfully'
                ));

                return redirect('/admin/winners');

            } else {
                return back()->with(['errors' => [0 => "Warning - File Columns Mismatch With DB columns",
                    1 => "Please Provide Data According to the Sample File"]
                ]);
            }
        } else {
            return back()->with(['errors' => $validator->errors()->all()]);
        }


    }


    /*
    |==================================================================
    | Store A New Product For This Vendor -- API store()
    |==================================================================
    */
    public function store(Request $request)
    {
        // dd($request->all());
        // VALIDATE IF VENDOR HAS STORE
        if (!$request->store_id) {
            $errors[0] = "Please create your store first.";
            Session::flash('errors', $errors);
            return back();
        }

        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'short_description' => 'required',
            'warranty_type' => 'required',
            'package_weight' => 'required',
            'package_length' => 'required',
            'package_width' => 'required',
            'package_height' => 'required',
            'good_type' => 'integer'
        ]);

        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        // STORE PRODUCT-DETAIL IMAGES IN STORAGE-FOLDER
        $content = $request->detailed_description;


        $body = $request->except(['images', 'primary_image']);


        $files = [];
        if ($request->images) {
            foreach ($request->images as $image) {

                array_push($files, self::file64($image));

            }
        }


        //  dd($files);

        // $body["primary_image"] = ApiHelper::file64($request->primary_image);
        $body["primary_image"] = $request->primary_image_data;


        $body['files'] = $files;

        $response = Product::create($body, true);


//         dd($response);
        // hit

        try {


            $status = $response->status;

            if ($status == 200) {
                Session::flash('response', array(
                    "status" => 200,
                    "action" => 'add',
                    "message" => 'Product is Added Successfully'
                ));
                return redirect('/vendor/products');
            } elseif ($status == 403) {
                Session::flash('response', array(
                    "status" => 200,
                    "action" => 'warning',
                    "message" => 'Please create your store first.'
                ));
                return redirect('/vendor/products');
            } else {
                $errors = $response->errors;
                Session::flash('errors', $errors);
                return back();
            }

        } catch (\Exception $e) {
            // throw($e);
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }


    /*
    |==================================================================
    | Display the specified resource
    |==================================================================
    */
    public function show($id)
    {
        //
    }


    /*
    |==================================================================
    | Show The Form for Editing The Specified Product -- API edit()
    |==================================================================
    */
    public function edit($id)
    {

        try {

            $token = session()->get('token');
            $headers = array('Accept' => 'application/json', 'Authorization' => $token);
            $body = NULL;
            $url = config('app.url') . "api/vendor/products/$id/edit";


            $response = \Unirest\Request::get($url, $headers, $body);
            $status = $response->body->status;
            if ($status == 200) {

                $variant = $response->body->variant;

                // dd($variant);
                $warranty = $response->body->warranty;
                $categories = $response->body->categories;
                $brands = $response->body->brands;
                $attributes = $response->body->attributes;
                $selected_attributes = $response->body->selected_attributes;

                return view('vendor.products.edit')->with(['variant' => $variant])
                    ->with(['warranty' => $warranty])
                    ->with(['categories' => $categories])
                    ->with(['brands' => $brands])
                    ->with(['selected_attributes' => $selected_attributes])
                    ->with(['attributes' => $attributes]);
            }
            dd("Sorry, Something Went Wrong", $response);

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }


    /*
    |==================================================================
    | Update The Specified Product For This Vendor -- API update()
    |==================================================================
    */
    public function update(Request $request, $id)
    {

        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            // 'category_id'       => 'required|integer',
            // 'subcategory_id'    => 'required|integer',
            'brand_id' => 'required|integer',
            'short_description' => 'required',
            'warranty_type' => 'required',
            'package_weight' => 'required',
            'package_length' => 'required',
            'package_width' => 'required',
            'package_height' => 'required',
            'good_type' => 'integer',
        ]);

        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        // STORE PRODUCT-DETAIL IMAGES IN STORAGE-FOLDER
        $content = $request->detailed_description;


        $body = $request->except(['images', 'primary_image']);


        // STORE PRODUCT PRIMARY-IMAGE
        if ($request->primary_image_data) {
            // $body["primary_image"] = ApiHelper::file64($request->primary_image);
            $body["primary_image"] = $request->primary_image_data;

        }

        // STORE PRODUCT DETAIL-IMAGES
        if ($request->images) {
            $files = [];

            foreach ($request->images as $image) {

                array_push($files, self::file64($image));

            }


            //  dd($files);


            $body['files'] = $files;

        }

//         dd($body);

        try {
//            dd($body);
            $response = Product::put($id, $body, true);
//            dd($response);
            $status = $response->status;
            if ($status == 200) {
                Session::flash('response', array(
                    "status" => 200,
                    "action" => 'update',
                    "message" => 'Product variant is updated successfully'
                ));
                return back();
            }
            $errors = $response->errors;
            Session::flash('errors', $errors);
            return back();

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }


    /*
    |==================================================================
    | Delete The Specified Product For This Vendor -- API destroy()
    |==================================================================
    */
    public function destroy($id)
    {
        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = NULL;
        $url = config('app.url') . "api/vendor/products/$id";

        try {
            $response = \Unirest\Request::delete($url, $headers, $body);
            // dd($response);

            $status = $response->body->status;
            if ($status == 200) {

                $success = $response->body->message;
                Session::flash('response', array("status" => 200,
                    "action" => 'success',
                    "message" => 'Product  has been deleted successfully'
                ));
                dd('working');


                return back();
            }
            return "Sorry, Something Went Wrong";

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }


    public function variantDelete($id)
    {

        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = NULL;
        $url = config('app.url') . "api/vendor/products/variant/$id";

        try {
            $response = \Unirest\Request::get($url, $headers, $body);
            // dd($response);

            $status = $response->body->status;
            if ($status == 200) {

                $success = $response->body->message;
                Session::flash('response', array("status" => 200,
                    "action" => 'success',
                    "message" => 'Product variant has been deleted successfully'
                ));
                return back();
            }
            return "Sorry, Something Went Wrong";

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }


    /*
    |=================================================================================
    | Delete The Specified-Product-Image For This Product -- API deleteProductImage()
    |=================================================================================
    */
    public function deleteProductImage(Request $request)
    {
        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = $request->all();
        $url = config('app.url') . "api/vendor/product/image/delete";

        try {
            $response = \Unirest\Request::post($url, $headers, $body);
            // dd($response);

            $status = $response->body->status;
            if ($status == 200) {
                return response()->json([
                    "status" => 200,
                    "message" => "Product image has been deleted successfully"
                ]);
            }
            return response()->json([
                "status" => 100,
                "errors" => $response->body->errors
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }


    public function addVariant($id)
    {
        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = NULL;
        $url = config('app.url') . "api/vendor/products/$id/edit";
        // dd($id);
        try {
            $response = \Unirest\Request::get($url, $headers, $body);
            // dd($response);

            $status = $response->body->status;
            if ($status == 200) {

                $variant = $response->body->variant;

                $warranty = $response->body->warranty;
                $categories = $response->body->categories;
                $brands = $response->body->brands;
                $attributes = $response->body->attributes;
                $selected_attributes = $response->body->selected_attributes;
                // dd($attributes , $selected_attributes);

                return view('vendor.products.add_variant')->with(['variant' => $variant])
                    ->with(['warranty' => $warranty])
                    ->with(['categories' => $categories])
                    ->with(['brands' => $brands])
                    ->with(['selected_attributes' => $selected_attributes])
                    ->with(['attributes' => $attributes]);
            }
            return "Sorry, Something Went Wrong";

        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }


    public function storeNewVariant(Request $request, $id)
    {
        // dd($request->all());

        $response = Product::postBy("/variant/$id/add-variant", $request->all(), true);

        // dd($response);/
        if ($response->status == 200) {
            FacadesSession::flash('response', array(
                "status" => 200,
                "action" => 'add',
                "message" => 'Product variant is Added'
            ));
            return redirect("/vendor/products");
        } else {
            return "Somthing Went Wrong";
        }
    }

    public function editTranslation($id)
    {
     try {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url')."api/vendor/products/$id/edit/vendorTranslation";
        $response = \Unirest\Request::get($url ,$headers, $body);
//dd($response);
//         dd($response->body);
    //    $description_detail = $response->body->product->detailed_description;

        if($response->body->status == 200)
        {
            $product = $response->body->product;
//            dd($product);

            return view('vendor.products.editTranslation', get_defined_vars());
        }
     } catch (\Throwable $th) {
        throw $th;
     }
    }

    public function updateTranslation(Request $request, $id)
    {
    try {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body['name']     = $request->name;
        $body['name_ar']     = $request->name_ar;
        $body['short_description']     = $request->short_description;
        $body['short_description_ar']     = $request->short_description_ar;
        $body['detailed_description']     = $request->detailed_description;
        $body['detailed_description_ar']     = $request->detailed_description_ar;
        $body['translation_verified'] = $request->translation_verified;
        $url      = config('app.url')."api/vendor/products/$id/update/vendorTranslation";
        $response = \Unirest\Request::post($url ,$headers, $body);

        // dd($response->body);
        if($response->body->status == 200)
        {
            return back();
        }
    } catch (\Throwable $th) {
        throw $th;
    }
    }


    public function changeStatus(Request $request)
    {
        try {
            // dd($request->translation);
            $token = session()->get('token');
            $headers = array('Accept' => 'application/json', 'Authorization' => $token);
            $body = NULL;
            if ($request->has('status')) {
                $url = config('app.url') . 'api/vendor/products/change/status?product_id=' . $request->product_id . '&status=' . $request->status;
            } elseif($request->has('featured')) {
                $url = config('app.url') . 'api/vendor/products/change/status?product_id=' . $request->product_id . '&featured=' . $request->featured;
            } else {
                $url = config('app.url') . 'api/vendor/products/change/status?product_id=' . $request->product_id . '&translation=' . $request->translation;
            }
            $response = \Unirest\Request::get($url, $headers, $body);

            // dd($response);

            $status = $response->body->status;

            if ($status == 200) {

                if ($request->has('status')) {
                    return response()->json(['status' => $request->status]);
                } elseif($request->has('featured')) {
                    return response()->json(['status' => $request->featured]);

                } else {
                    return response()->json(['status' => $request->translation]);
                }
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => $e->getMessage()
            ]);
        }
    }

}
