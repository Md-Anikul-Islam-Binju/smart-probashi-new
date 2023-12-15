<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo;

    public function redirectTo()
    {
        if (Auth::user()->user_type == 'admin') {
            return 'admin/dashboard';
        }
        elseif (Auth::user()->user_type == 'recruiting-agency') {
            return 'recruiting-agency/dashboard';
        }
        elseif (Auth::user()->user_type == 'bmet') {
            return 'bmet/dashboard';

        }
        elseif (Auth::user()->user_type == 'foreign-ministry') {
            return 'foreign-ministry/dashboard';
        }
        else {
            return route('login');
        }
    }



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
