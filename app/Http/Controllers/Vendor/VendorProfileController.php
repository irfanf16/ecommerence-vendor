<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Traits\ApiHelper;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;


class VendorProfileController extends Controller
{
    use ApiHelper;
    /*
    |=================================================================
    | GET Vendor Profile Details For Profile Edit Screen
    |=================================================================
    */
    public function __construct()
    {
        $this->middleware('permissions:vendor-setting-read,vendor-setting-edit', ['only' => ['editProfile','vendorBasicInfo',
            'vendorBusinessInfo','vendorBusinessDocuments','previewBusinessDocument','vendorBankInfo',
            'previewBankDocument','vendorStoreInfo','vendorWarehouseInfo','vendorReturnWarehouseInfo','saveReview']]);

    }
    public function editProfile()
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' ,'Authorization' => $token);
        $body     = NULL;
        $url      = config('app.url')."api/vendor/profile/basic";

        try{
            $response = \Unirest\Request::get($url, $headers, $body);
            // dd($response);

            $status = $response->body->status;
            if ($status == 200) {

                $profile_details  = $response->body->profile_details;
                $profile_status   = $response->body->profile_details->vendor_profile_status;
                $documents        = $response->body->documents;
                $cities           = $response->body->cities;
                $categories       = $response->body->categories;
                $business_document = $response->body->business_document;

                // dd($business_document);
                $business_document_available = [];
                foreach($business_document as $doc){
                    array_push($business_document_available , $doc->document_input_id);
                }

                return view('vendor.profile.edit')->with(['profile_details' => $profile_details])
                                                ->with(['cities'          => $cities])
                                                ->with(['profile_status'  => $profile_status])
                                                ->with(['categories'      => $categories])
                                                ->with(['documents'       => $documents])
                                                ->with(['business_document' => $business_document])
                                                ->with(['business_document_available' => $business_document_available]);
            }
            else{
                $errors = $response->body->errors;
                Session::flash('errors', $errors);
                return back();
            }

        }
        catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }



    /*
    |=================================================================
    | Store/Update Vendor Profile's Basic-Information
    |=================================================================
    */
    public function vendorBasicInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'   => 'required|string|max:100|min:4',
            // 'email'  => 'required|email|max:55',
            // 'mobile' => 'required|string|max:15|min:10',
        ]);

        if($validator->fails()){
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $url      = config('app.url')."api/vendor/profile/basic";
        $body     = $request->all();

        $response = \Unirest\Request::post($url ,$headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {
            $message = $response->body->message;
            Session::flash('response', array( "status"  => 200,
                                              "action"  => 'update',
                                              "message" => $message,
                                            ));
            return redirect('vendor/profile/edit')->with('success', 'Basic Profile Information is Updated Successfully !');
        }
        else{
            $errors = $response->body->errors;
            Session::flash('errors', $errors);
            return back();
        }
    }




    /*
    |=================================================================
    | Store/Update Vendor Profile's Business Information
    |=================================================================
    */
    public function vendorBusinessInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name'              => 'string|max:100',
            'company_address'           => 'max:255',
            'country_id'                => 'required|integer|max:15',
            'city_id'                   => 'required|integer|max:15',
            'company_zone_no'           => 'required|string|max:255',
            'company_street_no'         => 'required|string|max:255',
            'company_building_no'       => 'required|string|max:255',
            'company_floor_no'          => 'max:255',
            'company_appartment_no'     => 'max:255',
            //person in Charge
            'person_incharge_name'      => 'string|max:100',
            'person_incharge_mobile'    => 'required|string|max:15',
            'person_incharge_email'     => 'string|email|max:55',
            'person_id_type'            => 'string|integer|max:100',
            'person_id_front_image'     => 'file|image|mimes:jpeg,png,jpg|max:1024',
            'person_id_back_image'      => 'file|image|mimes:jpeg,png,jpg|max:1024',
        ]);

        if($validator->fails()){
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $url      = config('app.url')."api/vendor/profile/business";
        $body     = $request->all();
         // person_id_front_image
         if ($request->person_id_front_image) {
            // $body['person_id_front_image']  =  \Unirest\Request\Body::file($request->person_id_front_image);
            $body['person_id_front_image']  =  self::file64($request->person_id_front_image);
        }
        else {
            $body['person_id_front_image'] = null;
        }
         // person_id_back_image
         if ($request->person_id_back_image) {
            // $body['person_id_back_image']  =  \Unirest\Request\Body::file($request->person_id_back_image);
            $body['person_id_back_image']  =  self::file64($request->person_id_back_image);
        }
        else {
            $body['person_id_back_image'] = null;
        }
        $response = \Unirest\Request::post($url ,$headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $message = $response->body->message;
            Session::flash('response', array( "status"  => 200,
                                              "action"  => 'update',
                                              "message" => $message,
                                            ));
            return redirect("/vendor/profile/edit")->with('success', 'Business Information is Updated Successfully !');;
        }

        else {
            $errors = $response->body->errors;
            Session::flash('errors', $errors);
            return back();
        }
    }





    /*
    |=================================================================
    | Store/Update Vendor Profile's Business Documents
    |=================================================================
    */
    public function vendorBusinessDocuments(Request $request)
    {
        $document = $request->document;



        // REQUEST DOCUMENTS-ARRAY
        $doc_list = $request->doc_list;
        $document = $request->document;

        // dd($document , $doc_list);

        $docs = [];
        $files = [];


        // iF REQUEST DON'T HAVE ANY FILE
        if(!$document) {
            foreach ($doc_list as $key => $d) {
                $docs[$key] = null;
            }
            $validator = \Validator::make($request->all(), [
                "document"    => "required|array|min:6",
                "document.*"  => "required|mimes:jpg,jpeg,png,pdf|max:2048",
            ]);

            if($validator->fails()){
                $errors = $validator->messages()->all();
                Session::flash('errors', $errors);
                return back();
            }
        }
        // iF REQUEST HAVE AT-LEAST ONE FILE
        else{
            foreach ($doc_list as $key => $d) {
                if (array_key_exists($key, $document)) {

                    // STORE BUSINESS DOCUMENT IN PUBLIC-PATH-FOLDER
                    $business_doc_ext = $document[$key]->extension();
                    $current_time     = time();
                    $file_name        = "doc".$key."-".$current_time.'.'.$business_doc_ext;

                    // $document[$key]->move(public_path('/vendor/docs/business'), $file_name);
                    // array_push($files , self::file64($document[$key]) );

                    // $docs[$key] = $file_name;
                    $docs[$key] = self::file64($document[$key]);
                }
                else{
                    $docs[$key] = null;
                }
            }
        }

        $body['docs'] = $docs;
        // $body['files'] =$files;

        $token   = session()->get('token');
        $headers = array('Accept' => 'application/json', 'Content-Type' => 'application/json', 'Authorization' => $token);
        $url     = config('app.url')."api/vendor/profile/business/documents";

        // CONVERT DATA INTO JSON FORMAT -- FOR NESTED-ARRAYS
        $body     = \Unirest\Request\Body::json($body);
        $response = \Unirest\Request::post($url ,$headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $message = $response->body->message;
            Session::flash('response', array( "status"  => 200,
                                              "action"  => 'update',
                                              "message" => $message,
                                            ));
            return redirect("/vendor/profile/edit")->with('success', 'Business Documents are Updated Successfully !');;
        }

        else {
            $errors = $response->body->message;
            Session::flash('errors',$errors);
            return back();
        }


    }



    /*
    |=================================================================
    | Preview Business Documents
    |=================================================================
    */
    public function previewBusinessDocument($doc)
    {
        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json', 'Authorization' => $token);
        $body     = null;
        $url      = config('app.url') . "api/vendor/doc/preview/$doc";
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $file = $response->body->doc->document_input_value;
            // dd($file);
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            $baseurl = config('app.url');

            // // file path
            $path = "$baseurl"."storage/documents/lg/$file";
            if ($ext == "pdf") {

                // header
                $header = [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="' . $file . '"'
                ];
                return response()->file($path, $header);
            }
            // dd($baseurl);
            return redirect("$baseurl"."storage/documents/lg/$file");
        }
        return "something went wrong";

    }




    /*
    |=================================================================
    | Store/Update Vendor Profile's Bank Information
    |=================================================================
    */
    public function vendorBankInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_title'   => 'required|string|max:255',
            'account_no'      => 'required|string|max:100',
            'bank_name'       => 'required|string|max:255',
            'branch_code'     => 'required|string|max:100',
            'iban'            => 'required|string|max:255',
        ]);

        if($validator->fails()){
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $url      = config('app.url')."api/vendor/profile/bank";
        $body     = $request->all();

        // BANK-LETTER-DOCS
        if ($request->bank_letter_doc) {

            $validator = Validator::make($request->all(), [
                'bank_letter_doc' => 'file|mimes:pdf|max:2048',
            ]);

            if($validator->fails()){
                $errors = $validator->messages()->all();
                Session::flash('errors', $errors);
                return back();
            }

            // STORE NEW BANK LATTER DOCUMENT IN STORAGE
            $bank_letter_doc = $request->bank_letter_doc;
            $doc_extension   = $bank_letter_doc->extension();
            $current_time    = time();
            $file_name       = $current_time.'.'.$doc_extension;
            $bank_letter_doc->move(public_path('/vendor/docs/bank_letters'), $file_name);

            $body['bank_letter_doc'] =  $file_name;
        }
        else {
            $body['bank_letter_doc'] = null;
        }

        $response = \Unirest\Request::post($url ,$headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $message = $response->body->message;
            Session::flash('response', array( "status"  => 200,
                                              "action"  => 'update',
                                              "message" => $message,
                                            ));
            return redirect("/vendor/profile/edit")->with('success', 'Bank Information is Updated Successfully !');;
        }
        else {
            $errors = $response->body->errors;
            Session::flash('errors', $errors);
            return back();
        }
    }




    /*
    |=================================================================
    | Preview Bank Document
    |=================================================================
    */
    public function previewBankDocument($doc)
    {
        $file = $doc;
        $ext  = pathinfo($file, PATHINFO_EXTENSION);

        // file path
        $path = public_path('vendor/docs/bank_letters/' . $file);

        if ($ext == "pdf") {
            // header
            $header = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $file . '"'
            ];
            return response()->file($path, $header);
        }

        return redirect("/vendor/docs/bank_letters/$file");

    }




    /*
    |=================================================================
    | Store/Update Vendor Profile's Store Information
    |=================================================================
    */
    public function vendorStoreInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'store_name'        => 'required|string|max:255',
            'tag_line'          => 'max:255',
            'short_description' => 'max:255',
        ]);

        if($validator->fails()){
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        if ($request->holiday_mode == 'on') {
            $validator = \Validator::make( $request->all(), [
                'holiday_start_date' => 'required|date|before_or_equal:holiday_end_date|after:yesterday',
                'holiday_end_date'   => 'required|date|after_or_equal:holiday_end_date'
            ]);
            if ($validator->fails()) {
                $errors = $validator->messages()->all();
                Session::flash('errors', $errors);
                return back();
            }
        }

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $url      = config('app.url')."api/vendor/profile/store";
        $body     = $request->all();

        // LOGO-IMAGE
        if ($request->logo_image) {
            // $body['logo_image']  =  \Unirest\Request\Body::file($request->logo_image);
            // $body['logo_image']  =  self::file64($request->logo_image);
            $body['logo_image']  =  $request->logo_image_data;
        }
        else {
            $body['logo_image'] = null;
        }
         // COVER-IMAGE
        if ($request->cover_image) {
            // $body['cover_image']  =  \Unirest\Request\Body::file($request->cover_image);
            // $body['cover_image']  =  self::file64($request->cover_image);
            $body['cover_image']  =$request->cover_image_data;
        }
        else {
            $body['cover_image'] = null;
        }

        $response = \Unirest\Request::post($url ,$headers, $body);

//          dd($response);

        $status = $response->body->status;
        if ($status == 200) {
            $message = $response->body->message;
            Session::flash('response', array( "status"  => 200,
                                              "action"  => 'update',
                                              "message" => $message
                                            ));
            return redirect("/vendor/profile/edit")->with('success', 'Store Information is Updated Successfully !');;
        }
        else {
             $errors = $response->body->errors;
            Session::flash('errors', $errors);
            return back();
        }
    }




    /*
    |=================================================================
    | Store/Update Vendor Profile's Warehouse Information
    |=================================================================
    */
    public function vendorWarehouseInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'warehouse_name'            => 'required|string|max:100',
            'warehouse_phone_no'        => 'required|string|max:15',
            'warehouse_email'           => 'email|max:55',
            'country_id'                => 'required|integer',
            'city_id'                   => 'required|integer',
            'warehouse_zone_no'         => 'required|string|max:255',
            'warehouse_street_no'       => 'required|string|max:255',
            'warehouse_building_no'     => 'required|string|max:255',
            'warehouse_floor_no'        => 'max:255',
            'warehouse_appartment_no'   => 'max:255',
            'warehouse_address'         => 'max:255',
        ]);

        if($validator->fails()){
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $url      = config('app.url')."api/vendor/profile/warehouse";
        $body     = $request->all();
        $response = \Unirest\Request::post($url ,$headers, $body);

        //dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $message = $response->body->message;
            Session::flash('response', array( "status"  => 200,
                                              "action"  => 'update',
                                              "message" => $message,
                                            ));
            return redirect("/vendor/profile/edit")->with('success', 'Warehouse Information is Updated Successfully !');;
        }

        else {
            $errors = $response->body->errors;
            Session::flash('errors', $errors);
            return back();
        }
    }




    /*
    |=================================================================
    | Store/Update Vendor Profile's Warehouse-Return-Address
    |=================================================================
    */
    public function vendorReturnWarehouseInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'warehouse_name'            => 'required|string|max:100',
            'warehouse_phone_no'        => 'required|string|max:15',
            'warehouse_email'           => 'string|email|max:50',
            'country_id'                => 'required|integer',
            'city_id'                   => 'required|integer',
            'warehouse_zone_no'         => 'required|string|max:255',
            'warehouse_street_no'       => 'required|string|max:255',
            'warehouse_building_no'     => 'required|string|max:255',
            'warehouse_floor_no'        => 'max:255',
            'warehouse_appartment_no'   => 'max:255',
            'warehouse_address'         => 'max:255',
        ]);

        if($validator->fails()){
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $url      = config('app.url')."api/vendor/profile/return";
        $body     = $request->all();
        $response = \Unirest\Request::post($url ,$headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $message = $response->body->message;
            Session::flash('response', array( "status"  => 200,
                                              "action"  => 'update',
                                              "message" => $message
                                            ));
            return redirect("/vendor/profile/edit")->with('success', 'Return Warehouse Information is Updated Successfully !');
        }

        else {
            $errors = $response->body->errors;
            Session::flash('errors', $errors);
            return back();
        }
    }



    /*
    |=================================================================
    | Save And Review Vendor Profile Information
    |=================================================================
    */
    public function saveReview(REQUEST $request)
    {
        if(!$request->disclaimer){
            Session::flash('errors', 'Please Read and Accept the Disclaimer First ');
            return back();
        }

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json' , 'Authorization' => $token);
        $url      = config('app.url')."api/vendor/profile/review";
        $body     = $request->all();
        $response = \Unirest\Request::post($url ,$headers, $body);

        //  dd($response);

        $status = $response->body->status;
        if ($status == 200) {
            $message[] = $response->body->message;
            return redirect("/vendor/profile/edit");
        }
        else {
            $errors[] = $response->body->message;
            Session::flash('errors', $errors);
            return back();
        }

    }


}
