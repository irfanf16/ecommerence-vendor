<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorAttributesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     *------------------------------------------------
     * its for main attributes
     *-------------------------------------------------
     */

    public function index()
    {

        // intialize an array to put active attributes in it
        $active_attributes = [];

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
        $body     = null;
        $url      = config('app.url') . 'api/vendor/attributes';
        $response = \Unirest\Request::get($url, $headers, $body);

      // dd($response);
        $status = $response->body->status;
        if ($status == 200)
        {
            $attributes = $response->body->attributes;
            if ($attributes)
            {
                foreach ($attributes as $attribute) {
                    if($attribute) {
                        $active_attributes[] = $attribute;
                    }
                }

                return view('vendor.attributes.index', compact('active_attributes'));

            }

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        //
    }
}
