<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class AdminProductQuestionsController extends Controller
{
    /*
    |==================================================
    | Display a listing of the resource.
    |==================================================
    */
    public function index($pid)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url')."api/admin/products/$pid/questions";
        $response = \Unirest\Request::get($url ,$headers, $body);

//         dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $questions          = $response->body->questions;
            $questions_count    = $response->body->questions_count;
            $unreplied_questions= $response->body->unreplied_questions;
            $active_questions   = $response->body->active_questions;
            $inactive_questions = $response->body->inactive_questions;

            return view('admin.products.questions.index')->with(['questions'          => $questions])
                                                         ->with(['questions_count'    => $questions_count])
                                                         ->with(['unreplied_questions'=> $unreplied_questions])
                                                         ->with(['active_questions'   => $active_questions])
                                                         ->with(['inactive_questions' => $inactive_questions]);
        }

        return "Something Went Wrong";
    }



    /*
    |===================================================
    | Show the form for creating a new resource.
    |===================================================
    */
    public function create()
    {
        //
    }



    /*
    |=======================================================
    | Store a newly created resource in storage.
    |=======================================================
    */
    public function store(Request $request)
    {

    }



    /*
    |==================================================
    | Display the specified resource.
    |==================================================
    */
    public function show($id)
    {
        //
    }



    /*
    |==========================================================
    | Show the form for editing the specified resource.
    |==========================================================
    */
    public function edit($pid, $qid)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url')."api/admin/products/$pid/questions/$qid/edit";
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $question    = $response->body->question;
            return view('admin.products.questions.edit')->with(["question" => $question]);
        }

        return "Sorry, Something Went Wrong";
    }



    /*
    |====================================================
    | Update the specified resource in storage.
    |====================================================
    */
    public function update(Request $request, $pid, $qid)
    {
        $validator = \Validator::make( $request->all(), [
            'question' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $url      = config('app.url')."api/admin/products/$pid/questions/$qid";
        $body     = $request->all();
        $response = \Unirest\Request::post($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;

        if ($status == 200) {

            $message = $response->body->message;
            Session::flash('response', array( "status"  => 200,
                                              "action"  => 'update',
                                              "message" => 'Product Question is Updated Successfully'
                                            ));
            return back();
        }

        else {
            $errors = $response->body->errors;
            Session::flash('errors', $errors);
            return back();
        }
    }



    /*
    |====================================================
    | Remove the specified resource from storage.
    |====================================================
    */
    public function destroy($pid, $qid)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token );
        $body     = NULL;
        $url      = config('app.url')."api/admin/products/$pid/questions/$qid";
        $response = \Unirest\Request::delete($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {
            $success = $response->body->message;
            Session::flash('response', array("status"  => 200,
                                             "action"  => 'delete',
                                             "message" => 'Product Question is Deleted Successfully'
                                            ));
            return back();
        }
        else{
            return "Sorry, Something Went Wrong";
        }
    }

}
