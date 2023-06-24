<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // intializa an array to put active categories in it
        $active_subcategories = [];

        $token = session()->get('token');

        $headers   = array('Accept' => 'application/json', 'Authorization' => $token);
        $body      = null;
        $url       = config('app.url') . 'api/vendor/categories-with-subcategories';
        $response  = \Unirest\Request::get($url, $headers, $body);
        $status    = $response->body->status;

        dd($response);
        if ($status == 200)
        {
            $subcategories = $response->body->subcategories;


            if ($subcategories)
             {
                foreach ($subcategories as $subcategory)
                {
                    if ($subcategory) {

                        $active_subcategories[] = $subcategory;
                    }
                }

                return view('vendor.subcategories.index', compact('active_subcategories'));

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
        //
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