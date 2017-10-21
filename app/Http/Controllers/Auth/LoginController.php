<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        if (isset($request['page'])) {
            switch ($request['page']) {
                case 'InterChange':
                    $this->redirectTo = route('interout.map');
                    break;
                case 'InterAliance':
                    $this->redirectTo = route('interalliances.map');
                    break;
                case 'InterActions':
                    $this->redirectTo = '/html/opportunities.php';
                    break;
            }
        }
        $this->middleware('guest')->except('logout');
    }
}
