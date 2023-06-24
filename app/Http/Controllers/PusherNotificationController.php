<?php

namespace App\Events;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NotifyEvent;
use App\Events\InformMe;

class PusherNotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function sendEvent($name)
    {
        event(new InformMe($name));

    }
}