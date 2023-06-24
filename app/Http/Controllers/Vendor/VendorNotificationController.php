<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class VendorNotificationController extends Controller
{
    /*
    |=================================================
    | Get Recent 10 Notifications listing
    |=================================================
    */
    public function recentNotifications()
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
        $body     = null;
        $url      = config('app.url') . 'api/vendor/notifications/recent';
        $response = \Unirest\Request::get($url, $headers, $body);

        //dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $notifications = $response->body->notifications;
            $unreadCounter = $response->body->unread_noti;
            return response()->json([
                "status"     => 200,
                'notifications' => $notifications,
                'unreadCounter' => $unreadCounter,
            ]);
            //dd($notifications);

        }

        return 'something went wrong';
    }



    /*
    |=================================================
    | Get All Notifications listing
    |=================================================
    */
    public function allNotifications(Request $request)
    {

        if ($request->ajax()) {
            $token    = session()->get('token');
            $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
            $body     = null;
            $url      = config('app.url') . 'api/vendor/notifications/all?page=' . $request->page_id . '&ajaxRequest=1&datatable_length=' . $request->datatable_length . '&search=' . $request->search;
            $response = \Unirest\Request::get($url, $headers, $body);
            //dd($response);
            $status = $response->body->status;
            if ($status == 200) {

                $notifications = $response->body->notifications;
                //dd($notifications);

                return response()->json(['status'=>true,'notifications'=>$notifications]);
            }
        }
        return view('vendor.notifications.index');
    }

    /*
    |=================================================
    | Status Notification Change
    |=================================================
    */
    public function statusNotification($id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
        $body     = null;
        $url      = config('app.url') . 'api/vendor/notifications/status' / $id;
        $response = \Unirest\Request::get($url, $headers, $body);

        //dd($response);

        $status = $response->body->status;
        if ($status == 200) {
            return redirect('/vendor/orders' / $id);

            //dd($notifications);

        }

        return 'something went wrong';
    }
}
