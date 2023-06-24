<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class VendorProductQuestionsController extends Controller
{
    /*
    |==================================================
    | Display a listing of the resource.
    |==================================================
    */

    public function __construct()
    {
        $this->middleware('permissions:vendor-questions-read', ['only' => ['index','productQuestions']]);
        $this->middleware('permissions:vendor-questions-write', ['only' => ['replyQuestion']]);


    }

    public function index(Request $request)
    {
        if ($request->ajax()){
            $token    = session()->get('token');
            $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
            $body     = NULL;
            $url      = config('app.url').'api/vendor/questions?page=' . $request->page_id . '&ajaxRequest=1&datatable_length=' . $request->datatable_length . '&search=' . $request->search. '&is_reported=' . $request->is_reported. '&reviews=' . $request->reviews;
            $response = \Unirest\Request::get($url ,$headers, $body);
            $status = $response->body->status;
            if ($status == 200) {
                $questions          = $response->body->questions;
                \Illuminate\Support\Facades\Session::put('questions_page_id', $request->page_id);
                Session::put('questions_datatable_length', $request->datatable_length);
                if ($request->has('is_reported') && $request->filled('is_reported')) {
                    Session::put('is_reported', $request->is_reported == 1 ? 1 : 2);
                }else{
                    Session::put('is_reported', 3);
                }
                if ($request->has('reviews') && $request->filled('reviews')) {
                    Session::put('reviews', $request->reviews == 1 ? 1 : 2);
                }else{
                    Session::put('reviews', 3);
                }
                return response()->json(['questions'=>$questions, 'imagesUrl' => config('app.url')]);
            }
        }

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url')."api/vendor/questions";
        $response = \Unirest\Request::get($url ,$headers, $body);
        $status = $response->body->status;
        if ($status == 200) {
            $total_questions    = $response->body->total_questions;
            $answer_questions   = $response->body->answer_questions;
            $pending_questions = $response->body->pending_questions;

            return view('vendor.questions.index')
                ->with(['total_questions'    => $total_questions])
                ->with(['answer_questions'   => $answer_questions])
                ->with(['pending_questions' => $pending_questions]);
        }
        return "Something Went Wrong";

    }

    public function replyQuestion(Request $request){

        $validator = \Validator::make( $request->all(), [
            'question_id' => 'required',
            'vendor_reply' => 'required'
        ]);

        if($validator->fails()){
            $errors = $validator->messages()->all();
            \Illuminate\Support\Facades\Session::flash('errors', $errors);
            return back();
        }

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $url      = config('app.url')."api/vendor/question/reply";
        $body     = $request->all();
        $response = \Unirest\Request::post($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $message = $response->body->message;
            Session::flash('response', array( "status"  => 200,
                "action"  => 'update',
                "message" => 'Question Replied Successfully'
            ));
            return back();
        }
        else {
            $errors = $response->body->errors;
            Session::flash('errors', $errors);
            return back();
        }
    }


    public function productQuestions($pid)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url')."api/vendor/products/$pid/questions";
        $response = \Unirest\Request::get($url ,$headers, $body);

//         dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $questions          = $response->body->questions;
            $total_questions = $response->body->total_questions;
            $answer_questions = $response->body->answer_questions;
            $pending_questions = $response->body->pending_questions;


            return view('vendor.products.questions.index')->with(['questions'=> $questions])
                ->with(['total_questions' => $total_questions])
                ->with(['answer_questions' => $answer_questions])
                ->with(['pending_questions' => $pending_questions])
                ->with(['imagesUrl' => config('app.url')]);
        }

    }


}
