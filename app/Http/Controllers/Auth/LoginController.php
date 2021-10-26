<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

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
    protected function redirectTo()
    {
        $role = Auth()->user()->role;
        switch ($role) {
            case '1':
                return route('admin.dashboard');
                break;
            case '2':
                return route('buyer.dashboard');
                break;
            case '3':
                return route('seller.dashboard');
                break;
            default:
                return redirect()->back()->with('roleNotFound', 'Invalid Credentials');
                break;
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

    function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {

            if (auth()->user()->role == 1) {
                return redirect()->route('admin.dashboard');
            } elseif (auth()->user()->role == 2) {
                return redirect()->route('buyer.dashboard');
            } elseif (auth()->user()->role == 3) {
                return redirect()->route('seller.dashboard');
            }
        } else {
            return redirect()->route('login')->with('error', 'Email and Password are wrong');
        }
    }
}