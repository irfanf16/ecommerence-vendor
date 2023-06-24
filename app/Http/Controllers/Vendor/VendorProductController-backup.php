<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

// FOR GUZZLE HTTP REQUEST
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

class VendorProductController extends Controller
{
    /*
    |=================================================
    | Get listing of the all products
    |=================================================
    */
    public function index()
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url').'api/vendor/products';
        $response = \Unirest\Request::get($url ,$headers, $body);

        // dd($response);

        $status = $response->body->status;

        if ($status == 200) {

            $products          = $response->body->products;
            $products_count    = $response->body->products_count;
            $active_products   = $response->body->active_products;
            $inactive_products = $response->body->inactive_products;
            $featured_products = $response->body->featured_products;


            return view('vendor.products.index')->with(['products'         => $products])
                                                ->with(['products_count'   => $products_count])
                                                ->with(['active_products'  => $active_products])
                                                ->with(['inactive_products'=> $inactive_products])
                                                ->with(['featured_products'=> $featured_products]);
        }

            return "Something Went Wrong";
    }



    /*
    |==========================================================
    | Get Required Listings for create new product page
    |==========================================================
    */
    public function create()
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => 'Bearer'.$token );
        $body     = NULL;
        $url      = config('app.url').'api/admin/products/create';
        $response = \Unirest\Request::get($url ,$headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $stores     = $response->body->stores;
            $brands     = $response->body->brands;
            $categories = $response->body->categories;

            return view('vendor.products.create')->with(['stores' => $stores])
                                                 ->with(['brands' => $brands])
                                                 ->with(['categories' => $categories]);
        }

        return "Something Went Wrong";
    }



    /*
    |============================================================
    | Post a newly created Vendor in API (api/admin/stores)
    |============================================================
    */
    public function store(Request $request)
    {
        // dd($request->all());

        $primary_image = $request->primary_image;

        $token = session()->get('token');

        $client = new Client( [
            'base_uri' => config('app.url'),
        ]);


        $response = $client->request('POST', '/api/vendor/products', [
            'headers'  => ['Authorization' => 'Bearer'.$token],
            'multipart' => [
                [
                    'name'     => 'field_name',
                    'contents' => 'abc'
                ],
                [
                    'name'     => 'primary_image',
                    'contents' => Psr7\Utils::tryFopen($primary_image, 'r')
                ],
            ]
        ]);

        $body = $response->getBody();
        echo $body;

        $response = json_decode($body);

        dd($response->data);





        $validator = \Validator::make( $request->all(), [
            'name'             => 'required|string|max:255',
            'category_id'      => 'required|integer',
            'subcategory_id'   => 'required|integer',
            'brand_id'         => 'required|integer',
            'video_url'        => 'url',
            'short_description'=> 'required|string|max:500',

            'warranty_type'    => 'required|integer',
            'warranty_period'  => 'integer',

            'package_weight'   => 'required|integer',
            'package_length'   => 'required|integer',
            'package_width'    => 'required|integer',
            'package_height'   => 'required|integer',
            'good_type'        => 'integer'
        ]);

        if($validator->fails()){
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        $primary_image = $request->primary_image;
        // dd($primary_image);


        // GUZZLE POST REQEUST TYPE
        $url    = config('app.url') . 'api/vendor/products';

        $attributes    = $request->input('attributes');
        $sku_attributes= $request->input('sku_attributes');
        $price         = $request->input('price');
        $special_price = $request->input('special_price');
        $quantity      = $request->input('quantity');
        $seller_sku    = $request->input('seller_sku');
        $availability  = $request->input('availability');


        $inputs = $request->all();
        // dd($inputs);
        // dd(count($body));
        // dd(is_array($request->images));
        // dd($body['name']);



        // DETAIL-SCREEN-IMAGES
        $data = [];
        if($request->images){
            foreach ($request->images as $image ) {
                $data[] = [
                'name'     => 'image[]',
                'contents' => Psr7\Utils::tryFopen($image, 'r'),
                ];
            }
        }

        // PRIMARY-IMAGE
        $data[] = [
            'name'     => 'primary_image',
            'contents' => Psr7\Utils::tryFopen($primary_image, 'r'),
        ];

        // INSERT ALL INPUTS WHICH ARE NOT ARRAY
        foreach ($inputs as $key => $input) {
            if(!is_array($input)){
                $data[] = [
                    'name'     => $key,
                    'contents' => $input
                ];

            }
        }
        // dd($attributes);

        // ATTRIBUTES -- (ASSOCIATIVE ARRAY)
        if($attributes){
            foreach ($attributes as $key => $attribute ) {
                $attributes = [];
                $data[] = [
                'name'     => "attribute[$key]",
                'contents' => $attribute,
                ];
            }
        }

        // PRICE
        if($price){
            foreach ($price as $pri ) {
                $data[] = [
                'name'     => "price[]",
                'contents' => $pri,
                ];
            }
        }

        // SPECIAL PRICE
        if($special_price){
            foreach ($special_price as $sprice ) {
                $data[] = [
                'name'     => "sprice[]",
                'contents' => $sprice,
                ];
            }
        }

        // QUANTITY
        if($quantity){
            foreach ($quantity as $qty ) {
                $data[] = [
                'name'     => "quantity[]",
                'contents' => $qty,
                ];
            }
        }

        // SELLER SKU
        if($seller_sku){
            foreach ($seller_sku as $sku ) {
                $data[] = [
                'name'     => "seller_sku[]",
                'contents' => $sku,
                ];
            }
        }


        // AVAILABILITY
        if($availability){
            foreach ($availability as $avail ) {
                $data[] = [
                'name'     => "availability[]",
                'contents' => $avail,
                ];
            }
        }

        // SKU-ATTRIBUTES
        if($sku_attributes){
            foreach ($sku_attributes as $sku_attr ) {
                $data[] = [
                'name'     => "sku_attributes[]",
                'contents' => $sku_attr,
                ];

                $dynamicArray = $request->input($sku_attr);
                foreach($dynamicArray as $sk) {

                    $data[] = [
                        'name'     => $sku_attr."[]",
                        'contents' => $sk,
                    ];
                }
            }
        }

        dd($data);

        $token    = session()->get('token');

        $client = new Client( [
            'base_uri' => config('app.url'),
        ]);

        $response = $client->request( 'POST', 'api/vendor/products', [
            'headers'  => ['Authorization' => 'Bearer'.$token],
            'multipart'=> $data,
        ]);

        $body = $response->getBody();
        echo $body;

        $img = json_decode($body)->data;
        dd($img->extension());

        // dd($response->getBody());

        $response = json_decode($response);

        dd($request);


























        // $response = Http::post($url,$body);
        // dd($response->object());


        $primary_image = fopen($request->primary_image, 'r');

        $response = Http::attach(
            'primary_image', $primary_image,
            'body'
        )->withHeaders([
                'accept' => 'application/json',
                'content-type' => 'application/json'
            ])->post($url,
            [
                'data' => $body,
            ]);

        dd($response->body());




        // dd($request->all());
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Content-Type' => 'application/json', 'Authorization' => 'Bearer'.$token);
        $url      = config('app.url').'api/vendor/products';
        // $data1    =  $request->all();

        // dd($body);

        // PRIMARY IMAGE
        if ($request->primary_image) {
            $body['primary_image']  =  \Unirest\Request\Body::file($request->primary_image);
        }
        else {
            $body['primary_image'] = null;
        }

        // dd($body);

        // DETAIL SCREEN IMAGES
        // $images = [];
        // foreach ($request->images as $image) {
        //     if ($image) {
        //         $images[]  =  \Unirest\Request\Body::file($image);
        //     }
        //     else {
        //         $images[] = null;
        //     }
        // }
        // $body['images'] = $images;

        // dd($body);

        // CONVERT DATA INTO JSON FORMAT -- FOR NESTED-ARRAYS
        $body     = \Unirest\Request\Body::json($body);
        $response = \Unirest\Request::post($url ,$headers, $body);

		dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $message = $response->body->message;
            Session::flash('response', array( "status"  => 200,
                                              "action"  => 'add',
                                              "message" => 'Product Added Successfully'
                                            ));
            return redirect('/vendor/products');
        }

        else {
            $errors = $response->body->errors;
            Session::flash('errors', $errors);
            return back();
        }
    }



    /*
    |==================================================
    | Display the specified resource.
    |==================================================
    */
    public function show($id)
    {
        //
    }



    /*
    |==========================================================
    | Show the form for editing the specified Vendor.
    |==========================================================
    */
    public function edit($id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => 'Bearer'.$token );
        $body     = NULL;
        $url      = config('app.url')."api/admin/products/$id/edit";
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $product         = $response->body->product;
            $stores          = $response->body->stores;
            $brands          = $response->body->brands;
            $categories      = $response->body->categories;
            $subcategories   = $response->body->subcategories;
            $childcategories = $response->body->childcategories;


            return view('vendor.products.edit')->with(['product'        => $product])
                                              ->with(['stores'         => $stores])
                                              ->with(['brands'         => $brands])
                                              ->with(['categories'     => $categories])
                                              ->with(['subcategories'  => $subcategories])
                                              ->with(['childcategories'=> $childcategories]);
        }

        return "Sorry, Something Went Wrong";
    }



    /*
    |====================================================
    | Update the specified resource in storage.
    |====================================================
    */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make( $request->all(), [

            'name'                 => 'required|min:4|max:100',
            'store_id'             => 'required|integer',
            'brand_id'             => 'required|integer',
            'category_id'          => 'required|integer',
            'subcategory_id'       => 'required|integer',
            'childcategory_id'     => 'required|integer',
            'short_description'    => 'required|string|max:255',
            'detailed_description' => 'string',
            'primary_image'        => 'image|mimes:jpeg,png,jpg|max:2048',
            'video_url'            => 'url',
            'purchase_note'        => 'string',
        ]);

        if($validator->fails()){
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => 'Bearer'.$token );
        $url      = config('app.url')."api/admin/products/$id";
        $body     = $request->all();

        // PRIMARY IMAGE
        if ($request->primary_image) {
            $body['primary_image']  =  \Unirest\Request\Body::file($request->primary_image);
        }

        $response = \Unirest\Request::post($url ,$headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $message = $response->body->message;
            Session::flash('response', array( "status"  => 200,
                                              "action"  => 'update',
                                              "message" => 'Product Updated Successfully'
                                            ));
            return back();
        }

        else {
            $errors = $response->body->errors;
            Session::flash('errors', $errors);
            return back();
        }
    }


    /*
    |====================================================
    | Add New Product Page
    |====================================================
    */
    public function addProduct(Request $request)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => 'Bearer'.$token );
        $body     = NULL;
        $url      = config('app.url').'api/product/categories';
        $response = \Unirest\Request::post($url ,$headers, $body);

        //  dd($response);

        $status = $response->body->status;
        if ($status == 200) {
            $categories = $response->body->categories;

            return view('vendor.products.add_product')->with(['categories' => $categories]);
        }

        return "Something Went Wrong";
    }

    /*
    |====================================================
    | Remove the specified resource from storage.
    |====================================================
    */
    public function destroy($id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => 'Bearer'.$token );
        $body     = NULL;
        $url      = config('app.url')."api/admin/stores/$id";
        $response = \Unirest\Request::delete($url, $headers, $body);

        // dd($response);
        $status = $response->body->status;

        if ($status == 200) {

            $success = $response->body->message;
            Session::flash('response', array("status"  => 200,
                                             "action"  => 'success',
                                             "message" => 'Store Deactived Successfully'
                                            ));
            return back();
        }

        else{
            return "Sorry, Something Went Wrong";
        }
    }
}