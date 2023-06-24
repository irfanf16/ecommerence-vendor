<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class VendorProductReviewsController extends Controller
{
    /*
    |==================================================
    | Display a listing of the resource.
    |==================================================
    */
    public function __construct()
    {
        $this->middleware('permissions:vendor-reviews-read', ['only' => ['index','productReviews']]);
        $this->middleware('permissions:vendor-reviews-write', ['only' => ['replyReview']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $token = session()->get('token');
            $headers = array('Accept' => 'application/json', 'Authorization' => $token);
            $body = NULL;
            $url = config('app.url') . 'api/vendor/reviews?page=' . $request->page_id . '&ajaxRequest=1&datatable_length=' . $request->datatable_length . '&search=' . $request->search . '&is_reported=' . $request->is_reported . '&reviews=' . $request->reviews;
            $response = \Unirest\Request::get($url, $headers, $body);
            $status = $response->body->status;
            if ($status == 200) {
                $reviews = $response->body->reviews;
                Session::put('review_page_id', $request->page_id);
                Session::put('review_datatable_length', $request->datatable_length);
                if ($request->has('is_reported') && $request->filled('is_reported')) {
                    Session::put('is_reported', $request->is_reported == 1 ? 1 : 2);
                } else {
                    Session::put('is_reported', 3);
                }
                if ($request->has('reviews') && $request->filled('reviews')) {
                    Session::put('reviews', $request->reviews == 1 ? 1 : 2);
                } else {
                    Session::put('reviews', 3);
                }
                return response()->json(['reviews' => $reviews, 'imagesUrl' => config('app.url')]);
            }
        }

        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $body = NULL;
        $url = config('app.url') . "api/vendor/reviews";
        $response = \Unirest\Request::get($url, $headers, $body);
        $status = $response->body->status;
        if ($status == 200) {

//            $reviews          = $response->body->reviews;
            $total_reviews = $response->body->total_reviews;
            $answer_reviews = $response->body->answer_reviews;
            $pending_reviews = $response->body->pending_reviews;

            return view('vendor.reviews.index')
                ->with(['total_reviews' => $total_reviews])
                ->with(['answer_reviews' => $answer_reviews])
                ->with(['pending_reviews' => $pending_reviews]);
        }

        return "Something Went Wrong";
    }

    public function replyReview(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'review_id' => 'required',
            'vendor_reply' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        $token = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Authorization' => $token);
        $url = config('app.url') . "api/vendor/review/reply";
        $body = $request->all();
        $response = \Unirest\Request::post($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $message = $response->body->message;
            Session::flash('response', array("status" => 200,
                "action" => 'update',
                "message" => 'Review Replied Successfully'
            ));
            return back();
        } else {
            $errors = $response->body->errors;
            Session::flash('errors', $errors);
            return back();
        }
    }

    public function productReviews($pid)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url')."api/vendor/products/$pid/reviews";
        $response = \Unirest\Request::get($url ,$headers, $body);

//         dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $reviews          = $response->body->reviews;
            $total_reviews = $response->body->total_reviews;
            $answer_reviews = $response->body->answer_reviews;
            $pending_reviews = $response->body->pending_reviews;


            return view('vendor.products.reviews.index')->with(['reviews'=> $reviews])
                ->with(['total_reviews' => $total_reviews])
                ->with(['answer_reviews' => $answer_reviews])
                ->with(['pending_reviews' => $pending_reviews])
                ->with(['imagesUrl' => config('app.url')]);
        }

    }


}
