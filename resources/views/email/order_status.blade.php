<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style type="text/css">
        @media screen {
            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 400;
                src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 700;
                src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 400;
                src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 700;
                src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
            }
        }

        /* CLIENT-SPECIFIC STYLES */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* RESET STYLES */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* MOBILE STYLES */
        @media screen and (max-width:600px) {
            h1 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }

        /* ANDROID CENTER FIX */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }

    </style>
</head>

<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
    <!-- HIDDEN PREHEADER TEXT -->
    <div
        style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Lato', Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
    </div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <!-- LOGO -->
        <tr>
            <td align="center"
                style="background-color: {{ $package_details->order_status_detail->background_color }}">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center"
                style="padding: 0px 10px 0px 10px; background-color: {{ $package_details->order_status_detail->background_color }}"
                class="___class_+?0___">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="center" valign="top"
                            style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 2px; line-height: 48px; ">
                            <h1 style="font-size: 36px; font-weight: 350; "> Hey
                                {{ $package_details->order_detail->user->name }} !</h1>

                            {{-- Pending --}}
                            @if ($package_details->order_status_detail->status == 'Pending')
                                <h4 style="line-height: 48px;font-weight: 350px ">Your Order is still Pending </h4>
                            @endif

                            {{-- Accepeted --}}
                            @if ($package_details->order_status_detail->status == 'Accepeted')
                                <h4 style="line-height: 48px;font-weight: 350px ">Your Order is confirmed </h4>
                            @endif

                            {{-- Rejected --}}
                            @if ($package_details->order_status_detail->status == 'Rejected')
                                <h4 style="line-height: 48px;font-weight: 350px ">Oops - Your Order has been rejected
                                </h4>
                            @endif

                            {{-- Ready To Ship --}}
                            @if ($package_details->order_status_detail->status == 'Ready to Ship')
                                <h4 style="line-height: 48px;font-weight: 350px ">Your Order is ready to ship</h4>
                            @endif

                            {{-- Shipped --}}
                            @if ($package_details->order_status_detail->status == 'Shipped')
                                <h4 style="line-height: 48px;font-weight: 350px ">Good News - Your Order has been
                                    Shipped</h4>
                            @endif

                            {{-- Delivered --}}
                            @if ($package_details->order_status_detail->status == 'Delivered')
                                <h4 style="line-height: 48px;font-weight: 350px ">Great News! Your Order has been
                                    Delivered
                                </h4>
                            @endif

                            {{-- Returned --}}
                            @if ($package_details->order_status_detail->status == 'Returned')
                                <h4 style="line-height: 48px;font-weight: 350px ">Sorry! Your Order is
                                    Returned</h4>
                            @endif

                            {{-- Cancelled --}}
                            @if ($package_details->order_status_detail->status == 'Cancelled')
                                <h4 style="line-height: 48px;font-weight: 350px ">Oops! Your Order has been Cancelled
                                </h4>
                            @endif

                            {{-- Failed Delivery --}}
                            @if ($package_details->order_status_detail->status == 'Failed Delivery')
                                <h4 style="line-height: 48px;font-weight: 350px "> Your Order Delivery has been
                                    Failed</h4>
                            @endif

                            {{-- Icons --}}

                            {{-- Pending --}}
                            @if ($package_details->order_status_detail->status == 'Pending')
                                <img src="https://img.icons8.com/glyph-neue/94/000000/data-pending.png" width="125"
                                    height="120" style="display: block; border: 0px;" />
                            @endif

                            {{-- Accepeted --}}
                            @if ($package_details->order_status_detail->status == 'Accepeted')
                                <img src="https://img.icons8.com/clouds/94/000000/checked--v1.png" width="125"
                                    height="120" style="display: block; border: 0px;" />
                            @endif

                            {{-- Rejected --}}
                            @if ($package_details->order_status_detail->status == 'Rejected')
                                <img src="https://img.icons8.com/fluency/96/000000/delete-forever.png" width="125"
                                    height="120" style="display: block; border: 0px;" />
                            @endif

                            {{-- Ready To Ship --}}
                            @if ($package_details->order_status_detail->status == 'Ready to Ship')
                                <img src="https://img.icons8.com/fluency/94/000000/deliver-food.png" width="125"
                                    height="120" style="display: block; border: 0px;" />
                            @endif

                            {{-- Shipped --}}
                            @if ($package_details->order_status_detail->status == 'Shipped')
                                <img src="https://img.icons8.com/ultraviolet/94/000000/shipped.png" width="125"
                                    height="120" style="display: block; border: 0px;" />
                            @endif

                            {{-- Delivered --}}
                            @if ($package_details->order_status_detail->status == 'Delivered')
                                <img src="https://img.icons8.com/ultraviolet/94/000000/checked-truck.png" width="125"
                                    height="120" style="display: block; border: 0px;" />
                            @endif

                            {{-- Returned --}}
                            @if ($package_details->order_status_detail->status == 'Returned')
                                <img src="https://img.icons8.com/nolan/94/commodity-turnover.png" />
                            @endif

                            {{-- Cancelled --}}
                            @if ($package_details->order_status_detail->status == 'Cancelled')
                                <img src="https://img.icons8.com/dusk/94/000000/crying--v2.png" />
                            @endif

                            {{-- Failed Delivery --}}
                            @if ($package_details->order_status_detail->status == 'Failed Delivery')
                                <img src="https://img.icons8.com/fluency/94/000000/important-delivery.png" width="125"
                                    height="120" style="display: block; border: 0px;" />
                            @endif

                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="left"
                            style="padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            {{-- Pending --}}
                            @if ($package_details->order_status_detail->status == 'Pending')
                                <p style="margin: 0;">Your order placed but it's
                                    still pending .We’ll inform when it’s confirm.Don’t forget to check out our latest
                                    email..

                                    Let me know if you
                                    have questions!</p>
                            @endif

                            {{-- Accepeted --}}
                            @if ($package_details->order_status_detail->status == 'Accepeted')
                                <p>Dear {{ $package_details->order_detail->user->name }}, we’ve received an update
                                    that your order has been accepted successfully. </p>
                            @endif
                            {{-- Rejected --}}
                            @if ($package_details->order_status_detail->status == 'Rejected')
                                <p>Dear {{ $package_details->order_detail->user->name }}, we’ve received an update
                                    that your order has been rejected unfortunately. </p>
                            @endif

                            {{-- Ready To Ship --}}
                            @if ($package_details->order_status_detail->status == 'Ready to Ship')
                                <p>Hey {{ $package_details->order_detail->user->name }} , Your order pickup is
                                    ready to Ship at our location.We’ll inform when it’s time for you to pick yours
                                    up.Don’t forget to check out our latest email..

                                    Let me know if you
                                    have questions!</p>
                            @endif

                            {{-- Shipped --}}
                            @if ($package_details->order_status_detail->status == 'Shipped')
                                <h4 style="line-height: 48px;font-weight: 350px ">We’re excited to say that your order
                                    is on the way ! Right now, they’re estimated to arrive around given time period .
                                    Check out our website to look up the tracking details.
                                    Thank you.</h4>
                            @endif

                            {{-- Delivered --}}
                            @if ($package_details->order_status_detail->status == 'Delivered')
                                <p>Dear {{ $package_details->order_detail->user->name }}, we’ve received an update
                                    that your order has been delivered.Let us know how you like your order ? </p>
                            @endif

                            {{-- Returned --}}
                            @if ($package_details->order_status_detail->status == 'Returned')
                                <p>Dear {{ $package_details->order_detail->user->name }}! we are sorry that you
                                    didn’t
                                    love your order, but we’re here to make it better!
                                    If you’d like to place a new order, feel free to text this line for personal advice!
                                    Our team of experts is always happy to help , Thank you.</p>
                            @endif

                            {{-- Cancelled --}}
                            @if ($package_details->order_status_detail->status == 'Cancelled')

                            @endif

                            {{-- Failed Delivery --}}
                            @if ($package_details->order_status_detail->status == 'Failed Delivery')
                                <h4 style="line-height: 48px;font-weight: 350px "> Your Order Delivery has been
                                    Failed</h4>
                            @endif

                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="center" style="border-radius: 3px;"><a href="#"
                                                        target="_blank"
                                                        style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid; display: inline-block; background-color: #113150">View
                                                        Order Details</a></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr> <!-- COPY -->
                    <tr>
                        <td bgcolor=" #ffffff" align="left"
                            style="padding: 0px 30px 0px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">
                            </p>
                        </td>
                    </tr> <!-- COPY -->
                    <tr>
                        <td bgcolor="#ffffff" align="left"
                            style="padding: 20px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;"><a href="#" target="_blank" style="color:#13548D">
                                </a>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left"
                            style="padding: 0px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">Thank you for your business, your trust, and your
                                confidence. It is our pleasure to work with you.
                                Please let us know If you're facing any trouble ,just click
                                the below link or visit our site :<br><a href="">Storaq.qa</a> </p>

                            <p style="margin: 0;">If you have any Questions, just reply to this
                                Email - We're always happy
                                to help out.</p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left"
                            style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">Cheers,<br>Storak Team</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center"
                            style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px; background-color: #288CFF">
                            <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">
                                Need more help?
                            </h2>
                            <p style="margin: 0;"><a href="#" target="_blank"
                                    style="color:rgb(255, 255, 255);">We&rsquo;re here
                                    to help you out</a></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#f4f4f4" align="left"
                            style="padding: 0px 30px 30px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;">
                            <br>

                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
