<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

use App\Traits\hellowWorld;

class VendorDashboardController extends Controller
{
    /*
    |=============================================================
    | Get Statistics For Vendor Dashboard  -- API Index()
    |=============================================================
    */
    protected function index()
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url').'api/vendor/dashboard';
        $response = \Unirest\Request::get($url ,$headers, $body);


        $recent_notifications = Notification::getBy('/recent');

//        dd($response);
        $status = $response->body->status;

        if ($status == 200) {
            $orders_count   = $response->body->orders_count;
            $delivered_orders   = $response->body->delivered_orders;
            $products_count = $response->body->products_count;
            $coupons_count  = $response->body->coupons_count;
            $profile_status = $response->body->profile_status;
            $recent_notifications = $recent_notifications->notifications;

            return view('vendor.dashboard.index', compact('orders_count','products_count','coupons_count','profile_status' , 'recent_notifications', 'delivered_orders'));
        }
        return view('vendor.dashboard.index');
    }

}
