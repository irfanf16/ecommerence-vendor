<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class VendorCouponsController extends Controller
{
    /*
    |====================================================================
    | Get Listing of All Coupons -- API
    |====================================================================
    */
    public function index()
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
        $body     = null;
        $url      = config('app.url') . 'api/vendor/coupons';
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {
            $coupons          = $response->body->coupons;
            $coupons_count    = $response->body->coupons_count;
            $active_coupons   = $response->body->active_coupons;
            $inactive_coupons = $response->body->inactive_coupons;
            $expired_coupons  = $response->body->expired_coupons;

            return view('vendor.coupons.index', compact('coupons','coupons_count','active_coupons','inactive_coupons','expired_coupons'));
        }
        return "Sorry Something Went Wrong";
    }



    /*
    |====================================================================
    | Show The Form For Creating a New Coupon
    |====================================================================
    */
    public function create()
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
        $body     = null;
        $url      = config('app.url') . 'api/vendor/coupons/create';
        $response = \Unirest\Request::get($url, $headers, $body);

        //  dd($response);

        $status = $response->body->status;
        if ($status == 200)
        {
            $products = $response->body->products;
            return view('vendor.coupons.create', compact('products'));
        }
        return "Sorry something went wrong";
    }

    
    
    /*
    |====================================================================
    | Store a Newly Created Coupon Records -- API
    |====================================================================
    */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title'          => 'required|string|max:255',
            'description'    => 'required|string|max:255',
            'apply_to'       => 'required|integer',
            'quantity'       => 'required|integer',
            'discount_type'  => 'required|integer',
            'discount_value' => 'required|integer',
            'minimum_order_value'=> 'required|integer',
            'per_user_limit' => 'required|integer',
            'start_at'       => 'required|date|after_or_equal:now',
            'expire_at'      => 'required|date|after_or_equal:start_at'
        ]);

        if($validator->fails()){
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
        $body     = $request->all();
        $url      = config('app.url') . "api/vendor/coupons";
        $response = \Unirest\Request::post($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;

        if ($status == 200) {
            Session::flash('response', array( 
                "status"  => 200,
                "action"  => 'add',
                "message" => 'Coupon is Added Successfully'
            ));
            return redirect('/vendor/coupons');
        }
        elseif($status == 403) {
            Session::flash('response', array(
                "status"  => 200,
                "action"  => 'warning',
                "message" => 'Please create your store first.'
            ));
            return redirect('/vendor/coupons');
        }
        else {
            $errors = $response->body->errors;
            Session::flash('errors', $errors);
            return back();
        }
    }

    
    
    
    /*
    |====================================================================
    | Display The Specified Coupon Details
    |====================================================================
    */
    public function show($id)
    {
        //
    }




    /*
    |====================================================================
    | Show The Form For Editing The Specified Coupon -- API
    |====================================================================
    */
    public function edit($id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
        $body     = null;
        $url      = config('app.url') . "api/vendor/coupons/$id/edit";
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200)
        {
            $coupon   = $response->body->coupon;
            $products = $response->body->products;

            return view('vendor.coupons.edit', compact('coupon','products'));
        }
        else{
            return "sorry, something went wrong";
        }

    }




    /*
    |====================================================================
    | Update The Specified Coupon Records -- API
    |====================================================================
    */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'title'          => 'required|string|max:255',
            'description'    => 'required|string|max:255',
            'apply_to'       => 'required|integer',
            'quantity'       => 'required|integer',
            'discount_type'  => 'required|integer',
            'discount_value' => 'required|integer',
            'minimum_order_value'=> 'required|integer',
            'per_user_limit' => 'required|integer',
            'start_at'       => 'required|date|after_or_equal:now',
            'expire_at'      => 'required|date|after_or_equal:start_at'
        ]);

        if($validator->fails()){
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
        $body     = $request->all();
        $url      = config('app.url') . "api/vendor/coupons/$id";
        $response = \Unirest\Request::post($url, $headers, $body);

       //dd($response);

       $status = $response->body->status;

       if ($status == 200) {
            Session::flash('response', array( 
                "status"  => 200,
                "action"  => 'add',
                "message" => 'Coupon is Updated Successfully'
            ));
            return redirect('/vendor/coupons');
       }
       else {
            $errors = $response->body->errors;
            Session::flash('errors', $errors);
            return back();
       }

    }

    


    /*
    |====================================================================
    | Delete The Specified Coupon -- API
    |====================================================================
    */
    public function destroy($id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url')."api/vendor/coupons/$id";
        $response = \Unirest\Request::delete($url, $headers, $body);

        $status = $response->body->status;

        if ($status == 200) {
            $success = $response->body->message;
            Session::flash('response', array("status"  => 200,
                                             "action"  => 'deleted',
                                             "message" => 'Coupon has been disabled successfully'
                                            ));
            return back();
        }

        return "Sorry, Something Went Wrong";
    }




    /*
    |====================================================================
    | Update (Enable/Disable) Status of The Specified Coupon -- AJAX API
    |====================================================================
    */
    public function updateStatus(Request $request)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = $request->all();
        $url      = config('app.url')."api/vendor/coupon/update-status";
        $response = \Unirest\Request::post($url, $headers, $body);

        $status = $response->body->status;
        if ($status == 200) {
            return response()->json([
                'status' => 200,
                'message'=> "Status has been update successfully"
            ]);
        }
        return response()->json([
            'status' => 100,
            'message'=> "something went wrong"
        ]);
    }


}