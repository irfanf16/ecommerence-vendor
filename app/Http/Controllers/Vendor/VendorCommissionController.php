<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorCommissionController extends Controller
{
    public function index(){

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
        $body     = null;
        $url      = config('app.url') . 'api/vendor/commissions/items';
        $response = \Unirest\Request::get($url, $headers, $body);

//         dd($response);

        $status = $response->body->status;
        if ($status == 200) {
            $orders       = $response->body->orders;
            return view('vendor.commission.index', compact('orders'));
        }
    }
    public function appliedCommissionSection()
    {

        try {
            $token = session()->get('token');
            $headers = array('Accept' => 'application/json', 'Authorization' => $token);
            $body = NULL;
            $url = config('app.url') . 'api/vendor/commissions/structure';

            $response = \Unirest\Request::get($url, $headers, $body);

            $body = $response->body;
            if ($body->status == 200) {
                $categories = $body->categories;
                return view('vendor.commission.appliedCommissionSection', get_defined_vars());
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
