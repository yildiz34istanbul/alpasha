<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\NotifiMail;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;



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
        $this->middleware('guest')->except('logout','confirm');
    }

    protected function redirectTo()
    {

//        dd(auth()->user());
        $user = auth()->user();

        if(auth()->user()->is_confirmed == 0) {
            $code = random_int(1000, 9999);
            \auth()->user()->confirm_code = $code;
            \auth()->user()->save();

            Mail::to($user->email)->send(new NotifiMail(' رمز التأكيد الخاص بك هو  ' . $code));

            return '/confirm-form';
        }
        return '/dashboard';
    }
    public function confirm(Request $request){

        $user = auth()->user();
        if ($request->code==$user->confirm_code) {
            auth()->user()->is_confirmed=1;
            auth()->user()->confirm_code=0;
            auth()->user()->save();

                return redirect()->route('dashboard');
        }else{
            \session()->put('code','الرمز غير مطابق');
            return redirect()->back()->withErrors(['code'=>'الرمز غير مطابق']);
        }
    }
}
