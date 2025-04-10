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
   // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function redirectTo()
    {
        if(auth::user()->status=='active'){
        $userType = Auth::user()->userType;
        switch ($userType) {
            case 'client':
                return '/client_dash';
                break;
            case 'key distributor':
                return '/key_distroDashboard';
                break;
            case 'RSP':
                return '/rspDashboard';
                break;
            case 'ROM':
                return '/romDashboard';
                break;
            case 'agent':
                    return '/agentDashboard';
                    break;
            case 'admin':
                    return '/adminDashboard';
                    break;
            default:
                return '/home';
                break;
        }
    }
    else{
        return '/home';
    }
    }



    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
