<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class VendorStatisticController extends Controller
{
    public function index(Request $request){

        try {
            if ($request->ajax()) {

                $token = session()->get('token');
                $headers = array('Accept' => 'application/json', 'Authorization' => $token);
                $body = NULL;
                $url = config('app.url') . 'api/vendor/inside/statistic?start_date='.$request->start_date.'&end_date='.$request->end_date;
//                dd($url);
                $response = \Unirest\Request::get($url, $headers, $body);

                dd($response);

                $status = $response->status;
                if ($status == 200) {
                    $products = $response->products;
                    $imagesUrl = $response->imagesUrl;
                    return response()->json(['status' => true, 'products' => $products, 'imagesUrl' => config('app.url')]);
                }
            }
            return view('vendor.inside.index');
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }
}
