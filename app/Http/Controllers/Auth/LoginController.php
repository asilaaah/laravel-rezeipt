<?php

namespace App\Http\Controllers\Auth;
use Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth as FacadesAuth;

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

    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
    protected $redirectTo;

    public function redirectTo()
    {
        $user = auth()->user();
        switch($user->role){
            case 0:
                $this->redirectTo = '/admin';
                return $this->redirectTo;

            case 1:
                $this->redirectTo =  "/manager";
                return $this->redirectTo;
            break;

            case 2:
                $this->redirectTo = "/cashier";
                return $this->redirectTo;
            break;

            default:
            $this->redirectTo = '/login';
            return $this->redirectTo;
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
}
