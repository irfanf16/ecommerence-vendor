<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

// INVOICE-PACKAGE(LaravelDaily)
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Contracts\PartyContract;
use LaravelDaily\Invoices\Traits\CurrencyFormatter;
use LaravelDaily\Invoices\Traits\DateFormatter;

use App\Mail\sendOrderStatusEmail;


class VendorOrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('permissions:vendor-orders-read', ['only' => ['index','orderInvoice']]);
        $this->middleware('permissions:vendor-orders-edit', ['only' => ['orderStatus','orderStatusUpdate']]);
    }
    /*
    |============================================================
    | Get Listing of All Orders For This Vendor -- API
    |============================================================
    */

    public function index()
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
        $body     = null;
        $url      = config('app.url') . 'api/vendor/orders';
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {
            $data         = $response->body;
            $orders       = $response->body->orders;
            $order_status = $response->body->order_status;
            $counters     = $response->body->counters;

            return view('vendor.orders.index', compact('orders', 'order_status', 'counters', 'data'));
        }
        return "Sorry Something Went Wrong";
    }



    /*
    |============================================================
    | Order Status Listing On Modal -- AJAX REQUEST API
    |============================================================
    */
    public function orderStatus(Request $request)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
        $body     = null;
        $url      = config('app.url') . "api/vendor/order/status/$request->orderStatusId";
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {
            $orders = $response->body->orders;

            return response()->json([
                'data' => $orders,
            ]);
        }
        return response()->json([
            'data' => "Sorry Something Went Wrong",
        ]);

    }



    /*
    |============================================================
    | Order Status Listing On Modal -- AJAX REQUEST
    |============================================================
    */
    public function orderStatusListing(Request $request)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
        $body     = $request->all();
        $url      = config('app.url') . "api/vendor/order/status/listing";
        $response = \Unirest\Request::post($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            return response()->json([
                'data'  => $response->body->order_status,
            ]);
        }
    }



    /*
    |============================================================
    | Update Order Status -- API
    |============================================================
    */
    public function orderStatusUpdate(Request $request, $id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
        $body     = $request->all();
        $url      = config('app.url') . "api/vendor/order/status/$id";
        $response = \Unirest\Request::post($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            return redirect('vendor/orders');
        }

        return "Sorry, Something Went Wrong";
    }



    /*
    |============================================================
    | Show The Form For Creating a New Order -- API
    |============================================================
    */
    public function create()
    {
        //
    }



   /*
    |============================================================
    | Show The Form For Creating a New Order -- API
    |============================================================
    */
    public function store(Request $request)
    {
        //
    }



    /*
    |============================================================
    | Display The Specified Order Details -- API
    |============================================================
    */
    public function show($id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
        $body     = null;
        $url      = config('app.url') . "api/vendor/orders/$id";
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {
            $order = $response->body->order;

            return view('vendor.orders.show', compact('order'));
        }
        return view('vendor.orders.show');
    }




    /*
    |============================================================
    | Show The Form For Editing The Specified Order -- API
    |============================================================
    */
    public function edit($id)
    {
        //
    }




    /*
    |============================================================
    | Update The Specified Specified Order -- API
    |============================================================
    */
    public function update(Request $request, $id)
    {
        //
    }




    /*
    |============================================================
    | Genrate Order Invoice -- API
    |============================================================
    */
    public function orderInvoice($id)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
        $body     = null;
        $url      = config('app.url') . "api/vendor/orders/$id";
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response->body->order->order_detail->billing_address);
        $order = $response->body->order;
        $customer = new Buyer([
            'order'       => $order,
        ]);

        $item = (new InvoiceItem())->title('Service 1')->pricePerUnit(2);
        $invoice = Invoice::make()
            ->buyer($customer)
            ->discountByPercent(10)
            ->taxRate(15)
            ->shipping(1.99)
            ->addItem($item)
            ->logo(public_path('vendor/invoices/storak-qa.png'));

        return $invoice->stream();





        $pdf = PDF::loadView('email.invoice');
        // download PDF file with download method
        return $pdf->download('order-invoice.pdf');

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
        $body     = null;
        $url      = config('app.url') . "api/vendor/orders/$id";
        $response = \Unirest\Request::get($url, $headers, $body);

        dd($response);

        $status = $response->body->status;
        if ($status == 200) {
            $order = $response->body->orders;
            $data = [
                'order' => $order
            ];


            $pdf = PDF::loadView('email.invoice', $data);
            // download PDF file with download method
            return $pdf->download('order-invoice.pdf');
        }
        return view('vendor.orders.index');
    }



    /*
    |============================================================
    | Remove The Specified Order -- API
    |============================================================
    */
    public function destroy($id)
    {
        //
    }

}
