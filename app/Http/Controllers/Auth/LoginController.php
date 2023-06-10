<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\LogRecord;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function showAdminLoginForm()
    {
        return view('auth.login', ['route' => route('admin.login-view'), 'title'=>'Admin']);
    }

    public function adminLogin(Request $request)
    {

        $this->validate($request, [
            'email'   => 'required',
            'password' => 'required',
//            'g-recaptcha-response' => 'required|captcha',
        ]);

        if (Auth::guard('admin')->attempt($request->only(['email','password']), $request->get('remember'))){

            return redirect()->intended('/admin/dashboard');
        }
        else
        {

            $adminUser = Admin::where('email',$request->email)
                ->first();

            if (isset($adminUser->id))
            {


                if ($adminUser->attempt == 4)
                {
                    Admin::where('email',$request->email)
                        ->update([
                            'suspend' => 1,
                            'suspend_time' => now()
                        ]);

                    return redirect()->route('admin.login')->with(['status' => 'Your account has been suspended for 1 hour!']);
                }
                else
                {



                    if(isset($adminUser->attempt_time)){
                        $then = Carbon::createFromFormat('Y-m-d H:i:s', $adminUser->attempt_time);
                        $now = new \DateTime('now');
                        $minutes = abs( $then->getTimestamp() - $now->getTimestamp() ) / 60;

                        if($minutes >5 ) {
                            //out of 5 minutes
                            Admin::where('email',$request->email)
                                ->update([
                                    'attempt' => 0,
                                    'attempt_time' => null
                                ]);
                            return redirect()->route('admin.login')->with(['status' => 'Invalid User Credentials!']);
                        }
                        else
                        {
                            //within 5 minutes
                            Admin::where('email',$request->email)
                                ->update([
                                    'attempt' => DB::raw('attempt + 1'),
                                    'attempt_time' => now()
                                ]);
                            // ->increment('column', 1);
                            return redirect()->route('admin.login')->with(['status' => 'Invalid User Credentials!']);
                        }
                    }
                    else
                    {
                        Admin::where('email',$request->email)
                            ->update([
                                'attempt' => 1,
                                'attempt_time' => now()
                            ]);
                        return redirect()->route('admin.login')->with(['status' => 'Invalid User Credentials!']);
                    }




                }

            }
            else
            {

            return redirect()->route('admin.login')->with(['status' => 'Invalid User Credentials!']);
                return back()->withInput($request->only('email', 'remember'));
            }







        }

    }


    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();

        return redirect('admin');
    }





    //-------------------------------------
//    public function login(Request $request)
//    {
//        //Get Cridential
//        $request->validate([
//            'username' => 'required',
//            'password' => 'required'
//        ]);
//
//        //Check User availability
//        $user =  DB::table('users')
//            ->select('users.*')
//            ->where('users.username', '=', $request->username)
//            ->first();
//
//        //Invalid User
//        if ($user == null) {
//            return redirect()->route('login')->with(['success' => 'Invalid
//User Credentials!']);
//        }
//
//        //Valid User
//        else {
//            //Account Suspened Status is suspended
//            if (($user->suspend_account) == 1) {
//                $suspend_datetime = strtotime($user->suspend_time);
//                $current_datetime = strtotime(now());
//
//                $dif = $current_datetime - $suspend_datetime;
//
//                //more than 24 hours
//                if ($dif > 86400) {
//                    if (Auth::attempt(['username' => $request->username,
//                        'password' => $request->password])) {
//                        DB::table('users')
//                            ->where('username', $user->username)
//                            ->update([
//                                'attemps' => 0,
//                                'suspend_account' => 0
//                            ]);
//                        return redirect()->route('home');
//                    }
//
//                    // Invalid Attemps
//                    else {
//                        if ($user->attemps <= 3) {
//                            $attemps = $user->attemps + 1;
//
//                            DB::table('users')
//                                ->where('username', $user->username)
//                                ->update([
//                                    'attemps' => $attemps,
//                                    'attemps_time' => now()
//                                ]);
//                            return redirect()->route('login')->with([
//                                'success' => 'No of remaining attemps!']);
//                        } else {
//                            DB::table('users')
//                                ->where('username', $user->username)
//                                ->update([
//                                    'suspend_account' => 1,
//                                    'suspend_time' => now()
//                                ]);
//                        }
//                        return redirect()->route('login')->with(['success'
//                        => 'Account has been suspended for 24 Hours!']);
//                    }
//                } else {
//                    return redirect()->route('login')->with(['success' => 'Your
//Account has been Blocked for 24 hours from '. $user->suspend_time .' !']);
//                }
//            } else {
//                if (Auth::attempt(['username' => $request->username,
//                    'password' => $request->password])) {
//                    DB::table('users')
//                        ->where('username', $user->username)
//                        ->update([
//                            'attemps' => 0,
//                            'suspend_account' => 0
//                        ]);
//                    return redirect()->route('home');
//                } else {
//                    if ($user->attemps <= 3) {
//                        $attemps = $user->attemps + 1;
//
//                        DB::table('users')
//                            ->where('username', $user->username)
//                            ->update([
//                                'attemps' => $attemps,
//                                'attemps_time' => now()
//                            ]);
//                        return redirect()->route('login')->with(['success'
//                        => 'Wrong Password!']);
//                    } else {
//                        DB::table('users')
//                            ->where('username', $user->username)
//                            ->update([
//                                'suspend_account' => 1,
//                                'suspend_time' => now()
//                            ]);
//                        return redirect()->route('login')->with(['success'
//                        => 'Account has been suspended for 24 Hours!']);
//                    }
//                }
//            }
//        }
//    }
}
