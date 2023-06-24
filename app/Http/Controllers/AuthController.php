<?php

namespace App\Http\Controllers;

use App\Mail\sendVerifyMail;
use App\Mail\resetPassword;
use Illuminate\Support\Facades\Mail;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Twilio\Rest\Client;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Redirect;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;



class AuthController extends Controller
{
    use AuthenticatesUsers;

    /*
    |============================================================
    |   Where To Redirect Users After Login.
    |============================================================
    */
    protected $redirectTo = RouteServiceProvider::HOME;


    /*
    |============================================================
    |  Create a new controller instance.
    |============================================================
    */
    public function __construct()
    {
        $this->middleware('guest');
    }


    /*
    |============================================================
    |  Social logins with GOOGLE and Facebook
    |============================================================
    */
    protected $providers = [
        'facebook', 'google',
    ];




    public function show()
    {
        return view('auth.login');
    }



    public function redirectToProvider($driver)
    {
        if (!$this->isProviderAllowed($driver)) {

            return $this->sendFailedResponse("{$driver} is not currently supported");
        }

        try {

            return Socialite::driver($driver)->redirect();
        } catch (Exception $e) {
            // You should show something simple fail message
            return $this->sendFailedResponse($e->getMessage());
        }
    }




    public function handleProviderCallback($driver)
    {
        try {
            $user = Socialite::driver($driver)->user();
        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }

        // check for email in returned user
        return empty($user->email)
            ? $this->sendFailedResponse("No email id returned from {$driver} provider.")
            : $this->loginOrCreateAccount($user, $driver);
    }



    protected function sendSuccessResponse()
    {
        return redirect()->intended('dashboard');
    }




    protected function sendFailedResponse($msg = null)
    {
        return redirect()->route('social.login')
            ->withErrors(['msg' => $msg ?: 'Unable to login, try with another provider to login.']);
    }



    private function isProviderAllowed($driver)
    {
        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }



    /*
    |============================================================
    |   Try to login user with provided credentials.
    |============================================================
    */
    protected function loginOrCreateAccount($providerUser, $driver)
    {
        // dd($providerUser);
        $data = [];
        $data['name']            = $providerUser->name;
        $data['email']           = $providerUser->email;
        $data['profile_image']   = $providerUser->avatar;
        $data['token']           = $providerUser->token;
        $data['provider_id']     = $providerUser->id;
        $data['registered_with'] = $driver;

        //  dd($data);

        $headers  = array('Accept' => 'application/json');
        $url      = config('app.url') . "api/vendor/register/social";
        $body     = $data;
        $response = \Unirest\Request::post($url, $headers, $body);

        //dd($response);

        $status   = $response->body->status;
        if ($status == 200) {

            $user   = $response->body->user;
            return redirect('/vendor/dashboard');
        }

    }



    /*
    |============================================================
    |   Show The Vendor Loging Form
    |============================================================
    */
    public function vendorLoginForm()
    {
        return view('auth.login');
    }



    /*
    |============================================================
    |   Login Vendor User With Provided Credentials.
    |============================================================
    */
    public function vendorLogin(Request $request)
    {
        // dd('here');
        $validator = Validator::make($request->all(), [
            'email'    => ['required', 'string', 'email', 'max:30'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        $headers   = array('Accept' => 'application/json');
        $body      = $request->all();
        $url       = config('app.url') . 'api/login';
        // dd($body);
        $response  = \Unirest\Request::post($url, $headers, $body);
        $status    = $response->body->status;
        $message   = $response->body->message;

        if ($status == 200) {

            $user   = $response->body->user;
            $user_role_permissions   = $response->body->user_role_permissions[0]->permissions;
            $notifications   = $response->body->notifications;
            if ($user->role_id == 2) {
                $token  = $response->body->token;

                Session::put('token', "Bearer".$token);
                Session::put('user', $user);
                Session::put('user_role_permissions', $user_role_permissions);
                Session::put('notifications', $notifications);

                return redirect('vendor/dashboard');

            }
            else {
                Session::flash('error', 'Sorry! the credentials you are using are invalid');
                return back();
            }

        }
        else {
            Session::flash('error', $message);
            return back();
        }

    }



    /*
    |=====================================================================
    |   Validate Vendor Email-Address For Uniqueness -- Ajax Reqeust
    |=====================================================================
    */
    public function validateUniqueEmail(Request $request)
    {
        $headers  = array('Accept' => 'application/json ');
        $body     = $request->all();
        $url      = config('app.url') . 'api/validate-unique-email';
        $response = \Unirest\Request::post($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $isAlreadyUsed = $response->body->isAlreadyUsed;
            return response()->json([
                "status"        => 200,
                'isAlreadyUsed' => $isAlreadyUsed,
            ]);
        }
    }



    /*
    |=====================================================================
    |   Validate Vendor Mobile Number For Uniqueness -- Ajax Reqeust
    |=====================================================================
    */
    public function validateUniqueMobile(Request $request)
    {
        $headers  = array('Accept' => 'application/json ');
        $body     = $request->all();
        $url      = config('app.url') . 'api/validate-unique-mobile';
        $response = \Unirest\Request::post($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            $isAlreadyUsed = $response->body->isAlreadyUsed;

            return response()->json([
                "status"        => 200,
                'isAlreadyUsed' => $isAlreadyUsed,
            ]);
        }
    }



    /*
    |============================================================
    |   Show The Form For Registering A New Vendor User.
    |============================================================
    */
    public function registerForm()
    {
        return view('auth.register');
    }



    /*
    |============================================================
    |  Register The New Vendor Using Signup Form
    |============================================================
    */
    public function registerVendor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => ['required', 'string', 'max:100'],
            'email'        => ['required', 'string', 'email', 'max:30'],
            'mobile'       => ['numeric'],
            'country_code'  => ['required', 'string'],
            'password'     => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        $headers  = array('Accept' => 'application/json ');
        $body     = $request->all();
        $url      = config('app.url') . 'api/vendor/register';

        // Send Account Verification Email To Vendor
        $email                     = $request->email;
        $confirmation_code         = Str::random(30);
        $body['confirmation_code'] = $confirmation_code;

        \Mail::to($email)->send(new sendVerifyMail($confirmation_code));

        $response = \Unirest\Request::post($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {

            session()->put('token', "Bearer" . $response->body->token);
            session()->put('user', $response->body->user);

            return redirect('vendor/profile/edit');
        }
        else {
            $errors = $response->body->errors;
            Session::flash('errors', $errors);
            return back()->with(['error' => 'Sorry, The Mobile or Email has already been taken.']);
        }
    }




    /*
    |============================================================
    |  Its for number verify by twillo
    |============================================================
    */
    protected function verifyPhone(Request $request)
    {
        $data = $request->validate([
            'mobile' => ['required', 'string', 'max:20'],
        ]);
        return redirect('/mobile/verify')->with(['mobile' => $data['mobile']]);


        $token = session()->get('token');
        /* Get credentials from .env */
        // $twilio_sid        = 'AC8c683d8d337b0abafc1b287d015abd94';
        // $token             = '6397c05881d33d017eb710c3ebab8123';
        // $twilio_verify_sid = 'VA8a8f2d480a9760607dfd72c50f92464f';
        $twilio            = new Client($twilio_sid, $token);

        $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create($data['mobile'], "sms");

        return redirect('/mobile/verify')->with(['mobile' => $data['mobile']]);
    }



    /*
    |============================================================
    | Get OTP Submission Page
    |============================================================
    */
    protected function confirmOTP()
    {
        return view('auth.verify');
    }



    /*
    |============================================================
    |  Verifying Phone number OTP
    |============================================================
    */
    protected function verifyOTP(Request $request)
    {
        // dd('yes');
        // dd($request->all());
        $data = $request->validate([

            'mobile_otp' => ['required', 'numeric'],
            'mobile'            => ['required', 'string'],
        ]);

        /* Get credentials from .env */
        // $twilio_sid        = 'AC8c683d8d337b0abafc1b287d015abd94';
        // $token             = '6397c05881d33d017eb710c3ebab8123';
        // $twilio_verify_sid = 'VA8a8f2d480a9760607dfd72c50f92464f';
        // $twilio            = new Client($twilio_sid, $token);
        // $verification      = $twilio->verify->v2->services($twilio_verify_sid)
        //     ->verificationChecks
        //     ->create($data['mobile_otp'], array('to' => $data['mobile']));

        //  dd($verification);

        // if ($verification->valid) {
        if (1 == 1) {
            $is_mobile_verified = 1;
            $token              = session()->get('token');
            $headers            = array('Accept' => 'application/json ', 'Authorization' => $token);
            $body               = $request->all();
            $url                = config('app.url') . 'api/verify/mobile';
            $response           = \Unirest\Request::post($url, $headers, $body);

            //  dd($response);
            if ($response->body->status == 200) {
                return redirect('vendor/profile/edit')->with('success', 'Your Phone number is verified Successfully !');
            } else {
                $errors = $response->body->error;
                Session::flash('errors', $errors);
                return redirect('vendor/profile/edit')->with('error', $errors);
            }
        }

        return back()->with(['mobile' => $data['mobile'], 'error' => 'Invalid  verification code entered!']);
    }



    /*
    |=====================================================================
    |  Send Email Verification Link to Vendor and Store It in DB
    |=====================================================================
    */
    protected function verifyEmail(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
        ]);

        $email                     = $request->email;
        $confirmation_code         = Str::random(30);
        $data['confirmation_code'] = $confirmation_code;

        // Send Email-Varificaion Link to Vendor
        \Mail::to($email)->send(new sendVerifyMail($confirmation_code));

        $token    = session()->get('token');
        $headers  = array('Accept' => 'application/json ', 'Authorization' => $token);
        $body     = $data;
        $url      = config('app.url') . 'api/verify/email';
        $response = \Unirest\Request::post($url, $headers, $body);

        // dd($response);

        $status = $response->body->status;
        if ($status == 200) {
            Session::flash('success', 'A verificaton link has been sent to your email account');
            return redirect('/vendor/profile/edit');
        }
        else {
            Session::flash('errors', 'Oops! Invalid Email , Try Again please');
            return redirect('/vendor/profile/edit');
        }

    }



    /*
    |=====================================================================
    |  Verify Confirmation-Code Sent To Vendor in Email
    |=====================================================================
    */
    public function confirmEmailCode($confirmationCode)
    {
        $code = $confirmationCode;
        if (!$code) {
            throw new InvalidConfirmationCodeException;
        }

        $headers  = array('Accept' => 'application/json');
        $body     = null;
        $url      = config('app.url') . 'api/code-verify/' . $code;
        $response = \Unirest\Request::get($url, $headers, $body);

        // dd($response);

        if ($response->body->status == 200) {
            session()->put('user', $response->body->user);
            Session::flash('success', 'You have successfully verified your Email');
            return redirect('/vendor/profile/edit');
        }
        if ($response->body->status == 100) {
            Session::flash('success', 'You have successfully verified your Email');
            return redirect('/vendor/profile/edit');
        }
    }



    /*
    |========================================================================
    |  Go To Reset-Password-With-Email Page -- Email -- Password-Reset
    |========================================================================
    */
    public function resetPasswordWithEmailPage()
    {
        return view('auth.passwords.password-reset-via-email');
    }



    /*
    |=========================================================================
    |  Send Password Reset Link in Email To Vendor -- Email -- Password-Reset
    |=========================================================================
    | Step-1
    | =>Check if email account already exists or not in database
    | =>If email already exists in db store email-reset-code in db.
    */
    protected function sendPasswordResetLink(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
        ]);

        $email                     = $request->email;
        $confirmation_code         = Str::random(30);
        $data['confirmation_code'] = $confirmation_code;

        $headers  = array('Accept' => 'application/json');
        $body     = $data;
        $url      = config('app.url') . 'api/password/reset/email/verify';
        $response = \Unirest\Request::post($url, $headers, $body);

        //  dd($response);

        if ($response->body->status == 200) {
            Mail::to($email)->send(new resetPassword($confirmation_code));
            Session::flash('success', 'Check Your Mailbox to Reset Password');
            return redirect('/password/reset/email');
        }
        else {
            Session::flash('error', 'Oops! Invalid Email , Try Again Please');
            return redirect()->back();
        }
    }



    /*
    |==========================================================================
    |  Match Email Confirmation Code With DB Code -- Email -- Password-Reset
    |==========================================================================
    | Step-2
    | =>Get Confirmation code from email link
    | =>Match This Confirmation code with the database code
    */
    public function matchResetPasswordCode($confirmationCode)
    {
        $code = $confirmationCode;
        if (!$code) {
            throw new InvalidConfirmationCodeException;
        }

        $headers  = array('Accept' => 'application/json');
        $body     = null;
        $url      = config('app.url') . "api/password/reset/email/confirm-email-code/$code";
        $response = \Unirest\Request::get($url, $headers, $body);

        //  dd($response);

        if ($response->body->status == 200) {
            $email = $response->body->email;
            return view('auth.passwords.reset-via-email', compact('email'));
        }

        if ($response->body->status == 100) {
            Session::flash('error', 'Oops! Try Again Please');
            return redirect('/password/reset/email');
        }
    }



    /*
    |==========================================================================
    |  Set New Password After Password Reset Link -- Email -- Password-Reset
    |==========================================================================
    */
    public function updatePasswordViaEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password'              => 'required|min:8|max:30',
            'password_confirmation' => 'required_with:password|same:password',
        ]);

        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        $headers  =  array('Accept' => 'Application/json');
        $body     = $request->all();
        $url      = config('app.url') . 'api/password/reset/email/update-password';
        $response = \Unirest\Request::post($url, $headers, $body);

        //  dd($response);

        if ($response->body->status == 200) {
            return redirect('/login')->with(['success' => $response->body->message]);
        }
    }




    /*
    |============================================================
    |   sendMessageOtpView ( FOR RESET PASSWORD VIA OTP)
    |============================================================
    */
    public function resetPasswordViaOtp()
    {
        return view('auth.passwords.sendMessageView');
    }



    /*
    |============================================================
    |   sendMessageOtp   ( FOR RESET PASSWORD VIA OTP)
    |============================================================
    */
    public function sendMessageOtp(Request $request)
    {
        //  dd($request->all());
        $validator = Validator::make($request->all(), [
            'mobile'       => ['numeric'],
            'countryCode'  => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }
        $mobile   = $request->countryCode . $request->mobile;

        $headers  =  array('Accept' => 'Application/json');
        $body     = $request->all();
        $url      = config('app.url') . 'api/validate-phone';
        $response = \Unirest\Request::post($url, $headers, $body);

        //  dd($response);

        if ($response->body->status == 200) {
            /* Get credentials from .env */
            $twilio_sid        = 'ACcae5a117abea4bfb6acea015e828301f';
            $token             = 'd25564ca3722544f02deb4f8383b206e';
            $twilio_verify_sid = 'VAb6cf5d02a081630337bbc92904945b78';
            $twilio            = new Client($twilio_sid, $token);

            $twilio->verify->v2->services($twilio_verify_sid)
                ->verifications
                ->create($mobile, "sms");

            return view('auth.passwords.confirm_otp')->with(['mobile' => $mobile]);
        } else {

            return back()->with(['error' => 'Invalid  Phone number entered!']);
        }
    }



    /*
    |============================================================
    |   verify OTP ( FOR RESET PASSWORD VIA OTP)
    |============================================================
    */
    public function verify_otp(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mobile_otp' => 'required|numeric',
            'mobile'     => 'required|string',
        ]);

        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        /* Get credentials from .env */
        // $twilio_sid        = 'ACcae5a117abea4bfb6acea015e828301f';
        // $token             = 'd25564ca3722544f02deb4f8383b206e';
        // $twilio_verify_sid = 'VAb6cf5d02a081630337bbc92904945b78';
        // $twilio            = new Client($twilio_sid, $token);
        // $verification      = $twilio->verify->v2->services($twilio_verify_sid)
        //     ->verificationChecks
        //     ->create($request->mobile_otp, array('to' => $request->phone));
        // dd($verification);
        // if ($verification->valid) {
        if (1 == 1) {
            $mobile = $request->mobile;
            Session::flash('success', 'OTP Verified Successfully ! Reset Your Password ');
            return view('auth.passwords.reset-via-otp', compact('mobile'));
        }

        return redirect('/password/reset/mobile')->with(['mobile' => $request->mobile, 'error' => 'Invalid verification code entered!']);
    }



    /*
    |============================================================
    |   Update Password ( FOR RESET PASSWORD VIA OTP)
    |============================================================
    */
    public function updatePassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'password'              => 'required|min:8|max:30',
            'password_confirmation' => 'required_with:password|same:password',
        ]);

        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            Session::flash('errors', $errors);
            return back();
        }

        $headers  =  array('Accept' => 'Application/json');
        $body     = $request->all();
        $url      = config('app.url') . 'api/reset-vendor-password';
        $response = \Unirest\Request::post($url, $headers, $body);

        // dd($response);

        if ($response->body->status == 200) {

            return redirect('/login')->with(['success' => $response->body->message]);
        }
    }



    /*
    |============================================================
    |   resetPasswordView  ( FOR RESET PASSWORD VIA OTP)
    |============================================================
    */
    public function customSMS(Request $request)
    {

        // dd($request->all());




        // use Twilio\Rest\Client;

        // Your Account SID and Auth Token from twilio.com/console
        $account_sid = 'ACcae5a117abea4bfb6acea015e828301f';
        $auth_token = 'd25564ca3722544f02deb4f8383b206e';
        // In production, these should be environment variables. E.g.:
        // $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

        // A Twilio number you own with SMS capabilities
        $twilio_number = "+18654128085";

        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
            // Where to send a text message (your cell phone?)
            $request->phone,
            array(
                'from' => $twilio_number,
                'body' => $request->message,
            )
        );

        return redirect()->back();
    }



    /*
    |============================================================
    | Logout user from system
    |============================================================
    */
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect('/');
    }


}
