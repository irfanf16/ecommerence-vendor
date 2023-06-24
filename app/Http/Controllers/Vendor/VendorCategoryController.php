<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     *------------------------------------------------
     * its for main categories
     *-------------------------------------------------
     */

    public function index()
    {

        // intialize an array to put active categories in it
        $active_categories = [];

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
        $body     = null;
        $url      = config('app.url') . 'api/vendor/categories';
        $response = \Unirest\Request::get($url, $headers, $body);

       //dd($response);
        $status = $response->body->status;
        if ($status == 200)
        {
            $categories = $response->body->categories;
            if ($categories)
            {
                foreach ($categories as $category) {
                    if($category) {
                        $active_categories[] = $category;
                    }
                }

                return view('vendor.categories.index', compact('active_categories'));

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
