<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PDF;
use App\Models\Order;
use App\Models\User;

class VendorInvoiceController extends Controller
{
    /*
    |=================================================
    | Get Order Data 
    |=================================================
    */
    public function getOrderData($id)
    {
        $token  = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $order = Order::findorfail($id);

        return view('OrderPdf')->with('order', $order);
    }

    /*
    |=================================================
    | Create Pdf  
    |=================================================
    */
    function pdf()
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_customer_data_to_html());

        return $pdf->stream();
    }

    function convert_customer_data_to_html($order)
    {
        $output = '
     <h3 align="center">Customer Data</h3>
    <table width="100%" style="border-collapse: collapse; border: 0px;">
     <tr>
        <th style="border: 1px solid; padding:12px;" width="20%">Name</th>
        <th style="border: 1px solid; padding:12px;" width="30%">Address</th>
        <th style="border: 1px solid; padding:12px;" width="15%">City</th>
        <th style="border: 1px solid; padding:12px;" width="15%">Postal Code</th>
        <th style="border: 1px solid; padding:12px;" width="20%">Country</th>
     </tr>
     ';

        $output .= '
      <tr>
       <td style="border: 1px solid; padding:12px;">' . $order->order_id . '</td>
       <td style="border: 1px solid; padding:12px;">' . $order->order_id . '</td>
       <td style="border: 1px solid; padding:12px;">' . $order->order_id . '</td>
       <td style="border: 1px solid; padding:12px;">' . $order->order_id . '</td>
       <td style="border: 1px solid; padding:12px;">' . $order->order_id . '</td>
      </tr>
      ';

        $output .= '</table>';
        return $output;
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
