<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorStoreController extends Controller
{
    /*
    |============================================================
    |   Index
    |============================================================
    */
    public function index()
    {
    }

   /*
    |============================================================
    |   Create
    |============================================================
    */
    public function create()
    {
        //
    }

    /*
    |============================================================
    |   Store
    |============================================================
    */
    public function store(Request $request)
    {
    }

    /*
    |============================================================
    |   Show
    |============================================================
    */
    public function show($id)
    {
        //
    }

   /*
    |============================================================
    |   Edit
    |============================================================
    */
    public function edit($id)
    {
       // dd($id);

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url')."api/admin/store/$id/edit";
        $response = \Unirest\Request::get($url, $headers, $body);
       dd($response);
        // dd($response);

        $status     = $response->body->status;
        if ($status == 200) {

            $store  = $response->body->store;
            return view('vendor.store.edit')->with(['store' => $store]);
        }

        return "Sorry, Something Went Wrong";
    }

    /*
    |============================================================
    |   Update
    |============================================================
    */
    public function update(Request $request, $id)
    {
    //  dd($request->all());
    $this->validate($request,[

            'username'    => 'required|min:4|max:30',
            'storename'   => 'required|min:4|max:30',
            'email'       => 'required|email',
            'storeurl'    => 'url',
            'phone'       => 'required|numeric|min:11',
            'mobile'      => 'required|numeric|min:13',
            'address'     => 'required|string',
            'country'     => 'required',
            'state'       => 'required',
            'district'    => 'required',
            'pob'         => 'required|string',
            'total_stock' => 'required|numeric|min:0|not_in:0',
            'weight'      => 'required|numeric|min:1|not_in:0',
            'logo_image'  => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'cover_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',

    ]);

    if ($validator->fails())
    {
        $errors = $validator->messages()->all();
        Session::flash('errors', $errors);
        return back();
    }

    $token    = session()->get('token');
    $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
    $url      = config('app.url')."api/admin/store/$id/update";
    $body     = $request->all();
    $response = \Unirest\Request::post($url ,$headers, $body);

    // dd($response);

    $status = $response->body->status;
    if ($status == 200)
    {
        $message = $response->body->message;
        Session::flash('response', array( "status"  => 200,
                                          "message" => 'Store Updated Successfully'));

        return redirect("/vendor/store/$id/edit");
    }

    else
    {
        $errors = $response->body->errors;
        Session::flash('errors', $errors);
        return back();
    }
    }

   /*
    |============================================================
    |   Delete
    |============================================================
    */
    public function destroy($id)
    {
        //

   }
}