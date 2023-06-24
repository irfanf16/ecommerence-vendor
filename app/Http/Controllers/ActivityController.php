<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    //
    public function profileActivities(){
        $response = Activity::getBy('/by/profile');
        // dd($response);
        return view('vendor.activities.profile-activities')->with([
            'activities' => $response->activity_log
        ]);
    }
}