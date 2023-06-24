<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $invoice->name }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style type="text/css" media="screen">
        html {
            font-family: sans-serif;
            line-height: 1.15;
            margin: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
            font-size: 10px;
            margin: 36pt;
        }

        h4 {
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        strong {
            font-weight: bolder;
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

        table {
            border-collapse: collapse;
        }

        th {
            text-align: inherit;
        }

        h4,
        .h4 {
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        h4,
        .h4 {
            font-size: 1.5rem;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table th,
        .table td {
            /* padding: 0.75rem; */
            vertical-align: top;
            /* border-top: 1px solid #dee2e6; */
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
            background-color: #dee2e6
        }

        .table tbody+tbody {
            /* border-top: 2px solid #dee2e6; */
        }

        .mt-5 {
            margin-top: 3rem !important;
        }

        .pr-0,
        .px-0 {
            padding-right: 0 !important;
        }

        .pl-0,
        .px-0 {
            padding-left: 0 !important;
        }

        .text-right {
            text-align: right !important;
        }

        .text-center {
            text-align: center !important;
        }

        .text-uppercase {
            text-transform: uppercase !important;
        }

        * {
            font-family: "DejaVu Sans";
        }

        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        table,
        th,
        tr,
        td,
        p,
        div {
            line-height: 1;
        }

        .party-header {
            font-size: 1.5rem;
            font-weight: 400;
        }

        .total-amount {
            font-size: 12px;
            font-weight: 700;
        }

        .border-0 {
            border: none !important;
        }

    </style>
</head>

<body>
    {{-- Header --}}
     @if ($invoice->logo)
     <div style="text-align: left" style="height: 150px; width: 150px">
         <img src="{{ $invoice->getLogo() }}" alt="logo" height="100">
     </div>
     @endif

    <h1 class="text-uppercase" style="text-align: center; background-color: #0c2a47 ; color: #fff">
        {{-- <strong>{{ $invoice->name }}</strong> --}}
        Storak.qa
    </h1>

    <table class="table">
        <tbody>

            <tr>
                <td style=" width: 50%">
                    <p>Order No.<strong>{{ $invoice->buyer->order->order_detail->order_no }}</strong></p>
                </td>
                <td style="width: 50%">
                    <p>Order Date:
                        <strong>{{ \Carbon\Carbon::parse($invoice->buyer->order->order_detail->created_at)->format('d-m-Y') }}</strong>
                    </p>
                </td>
                <td style="width: 50%">
                    <p>Fulfillment Type: <strong
                            style="text-transform: capitalize">{{ $invoice->buyer->order->fulfillment_detail->name }}</strong>
                    </p>
                </td>
                <td style="width: 50%">
                    <p>Store Name : <strong
                            style="text-transform: capitalize">{{ $invoice->buyer->order->store_detail->store_name }}</strong>
                    </p>
                </td>
            </tr>

        </tbody>
    </table>

    {{-- Seller - Buyer --}}
    <table class="table" style="border: 0px !important; padding-top: -1%;">
        <tbody>
            <tr>
                <td colspan="2" style="font-size: 12px; line-height: 18px ; font-weight: bold">Buyer details</td>
            </tr>
            <tr>
                <td>Name: {{ $invoice->buyer->order->order_detail->user->name }}</td>
                <td>Payment Method: <span
                        style="text-transform: capitalize">{{ $invoice->buyer->order->order_detail->payment_method }}
                    </span></td>
            </tr>
            <tr>
                <td>Phone: {{ $invoice->buyer->order->order_detail->user->mobile }}</td>
                <td>Email: {{ $invoice->buyer->order->order_detail->user->email }}</td>
            </tr>
            <tr>
                <td style="font-size: 12px;line-height: 18px ; font-weight: bold">Billing Address</td>
                <td style="font-size: 12px;line-height: 18px ; font-weight: bold">Shipping Address</td>
            </tr>
            <tr>
                <td>
                    <p class="buyer-address">
                        {{ $invoice->buyer->order->order_detail->billing_address->user_address }}
                    </p>
                    {{-- <p class="buyer-address">
                        Country: Qatar
                    </p> --}}
                </td>
                <td>
                    <p class="buyer-address">
                        {{ $invoice->buyer->order->order_detail->shipping_address->user_address }}
                    </p>
                    {{-- <p class="buyer-address">
                        City: Doha
                    </p> --}}
                    {{-- <p class="buyer-address">
                        Country: Qatar
                    </p> --}}
                </td>
            </tr>
        </tbody>
    </table>

    <h4 style="font-size: 12px;line-height: 18px ; font-weight: bold">Order Details</h4>

    {{-- Table --}}
    <table class="table">
        <thead>
            <tr >
                <th scope="col" class="text-left border-0 pl-0" style="padding: 5px 0px">Seller SKU</th>
                <th scope="col" class="text-left border-0 pl-0" style="padding: 5px 0px">Product Name</th>
                <th scope="col" class="text-center border-0" style="padding: 5px 0px">Quantity</th>
                <th scope="col" class="text-center border-0" style="padding: 5px 0px">Unit Price</th>
                <th scope="col" class="text-center border-0" style="padding: 5px 0px">Item Total</th>
            </tr>
        </thead>
        <tbody>
            {{-- Items --}}
            @foreach ($invoice->buyer->order->package_items as $item)
                <tr>
                    <td style="padding: 5px 0px">#{{ $item->product_id }}</td>
                    <td style="text-align: left; padding: 5px 0px">{{ $item->product_detail->name }}</td>
                    <td class="text-center" style="padding: 5px 0px" >{{ $item->quantity }}</td>
                    <td class="text-center" style="padding: 5px 0px"></td>{{ $item->price / $item->quantity }}</td>
                    <td class="text-center" style="padding: 5px 0px">{{ $item->price }}</td>
                </tr>
            @endforeach
            <tr style="padding: 10px 0px">
                <td style="text-align: right;  border-top: 2px solid rgb(147, 147, 148); padding: 10px 0px 0px 0px" colspan="5"><b>Fulfillment
                        Charges
                        :</b>
                </td>
                <td style="padding: 10px 0px 0px 0px"> &nbsp; &nbsp; + {{ $invoice->buyer->order->fulfillment_detail->charges }}</td>
            </tr>
            <tr>
                <td style="text-align: right" colspan="5"><b> Discount :</b>
                </td>
                <td> &nbsp; &nbsp; - {{ $invoice->buyer->order->order_detail->discount }}</td>
            </tr>
            <tr>
                <td style="text-align: right ;" colspan="5"><b> Grand Total = </b>
                </td>
                <td>
                    &nbsp; &nbsp;  {{ $invoice->buyer->order->package_bill + $invoice->buyer->order->fulfillment_detail->charges - $invoice->buyer->order->order_detail->discount }}
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <p>
        * Total charges for this shipment includes prepaid custom duties and other taxes as applicable for the
        merchandise to be delivered to the address in the country specified by the customer .
    </p>
    <p>For return policy and return form , please visit at <a href="#"> https://www.storak.qa/contact-us/</a></p>
    <p>NEED HELP?Contact us at <a href="#"> https://www.storak.qa/contact-us/</a></p>
    <p>LIKE US on FACEBOOK:<a href="#">https:facebook.com/storak.qa/</a></p>
    <p>FOLLOW US on TWITTER: <a href="#">https:twitter.com/storak.qa/</a></p>
    <p>Have a great day! Thank you for shopping on <a href="#">https://storak.qa/</a></p>

    <script type="text/php">
        if (isset($pdf) && $PAGE_COUNT > 1) {$text = "Page {PAGE_NUM} / {PAGE_COUNT}";$size = 10; $font = $fontMetrics->getFont("Verdana");$width = $fontMetrics->get_text_width($text, $font, $size) / 2; $x = ($pdf->get_width() - $width);$y = $pdf->get_height() - 35;$pdf->page_text($x, $y, $text, $font, $size);}








                        </script>
</body>

</html>
