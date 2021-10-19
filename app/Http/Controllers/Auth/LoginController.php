<?php

namespace App\Http\Controllers\Auth;

use App\Forms\LoginForm;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Kris\LaravelFormBuilder\FormBuilder;
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

    protected function authenticated(Request $request, $user){
        if ($user->roles[0]->name == 'Enseignant'){
            return redirect()->route('agent_information');
        }

        return redirect('/home');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'name';
    }

    public function showLoginForm(FormBuilder $formBuilder)
    {

        return view('auth.login');
    }
}
