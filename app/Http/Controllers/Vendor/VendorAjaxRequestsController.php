<?php

namespace App\Http\Controllers\Vendor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
class VendorAjaxRequestsController extends Controller
{
    /*
    |===================================================
    | Get Categories Listing Using Ajax
    |===================================================
    */
    public function categoriesList(Request $request)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = $request->all();
        $url      = config('app.url')."api/product/subcategories-brands";
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response);

        $status   = $response->body->status;
        if ($status == 200) {
            $categories =  $response->body->categories;
            return response()->json([
                "status"     => 200,
                'categories' => $categories,
            ]);
        }
    }
    /*
    |===================================================
    | Get SubCategories-Brands Listing Using Ajax
    |===================================================
    */
    public function subcategoriesBrandsList(Request $request)
    {

        $token = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = $request->all();
        $url      = config('app.url')."api/vendor/product/subcategories-brands";
        $response = \Unirest\Request::post($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;

        if ($status == 200) {
            $subcategories = $response->body->data->subcategories;
            $brands        = $response->body->data->brands;

            return response()->json([
                "status"        => 200,
                'subcategories' => $subcategories,
                'brands'        => $brands,
            ]);
        }
    }
    /*
    |===================================================
    | Get Specific ChildCategories-Attribute  Using Ajax
    |===================================================
    */
    public function childcategoriesAttributesList(Request $request)
    {

        $token = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = $request->all();
        $url      = config('app.url')."api/vendor/product/childcategories-attributes";
        $response = \Unirest\Request::POST($url, $headers, $body);

        // return response()->json([
        //     "status"          => $response,
        // ]);

        $status = $response->body->status;

        if ($status == 200) {
            $childcategories = $response->body->results->childcategories;
            $attributes      = $response->body->results->attributes;
            $brands          = $response->body->results->brands;
            return response()->json([
                "status"          => 200,
                'childcategories' => $childcategories,
                'attributes'      => $attributes,
                "brands"          => $brands
            ]);
        }
    }


    public function childcategory_brands(Request $request)
    {

        $token = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = $request->all();
        $url      = config('app.url')."api/vendor/product/childcategory-brands";
        $response = \Unirest\Request::POST($url, $headers, $body);

        // return response()->json([
        //     "status"          => $response,
        // ]);
        // dd($response);

        $status = $response->body->status;

        if ($status == 200) {

            $brands          = $response->body->results->brands;
            $attributes          = $response->body->results->attributes;
            $sku_attributes_list = $response->body->results->sku_attributes;
            $sku_attributes  = array_column($sku_attributes_list , 'id');
            return response()->json([
                "status"          => 200,

                "brands"          => $brands,
                "attributes"          => $attributes,
                "sku_attributes" => $sku_attributes,
                "sku_attributes_list" => $sku_attributes_list
            ]);
        }
    }

     /*
    |===================================================
    | Get BRANDS Listing Using Ajax
    |===================================================
    */
    public function brandsList(Request $request)
    {
        $token = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = $request->all();
        $url      = config('app.url')."api/admin/ajax/subcategories";
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {
            $brands = $response->body->subcategories;
            return response()->json([
                "status"   => 200,
                'brands'   => $brands,
            ]);
        }
    }

    /*
    |===================================================
    | Get Specific Attributes Using Ajax
    |===================================================
    */
    public function attributesList(Request $request)
    {
        $token = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = $request->all();
        $url      = config('app.url')."api/admin/ajax/childcategories";
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {
            $attributes = $response->body->childcategories;
            return response()->json([
                "status"          => 200,
                'attributes'      => $attributes,
            ]);
        }
    }


    /*
    |===================================================
    | Get Specific Variants Using Ajax
    |===================================================
    */
    public function variantsList(Request $request)
    {
        $token = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = $request->all();
        $url      = config('app.url')."api/admin/ajax/variants";
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {
            $variants = $response->body->variants;
            return response()->json([
                "status"  => 200,
                'variants'=> $variants,
            ]);
        }
    }
}