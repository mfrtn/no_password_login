<?php

namespace App\Http\Controllers;

use App\AuthenticateUser;
use App\Models\LoginToken;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $auth;

    public function __construct(AuthenticateUser $auth)
    {
        $this->auth = $auth;
    }

    public function login()
    {
        return view('login');
    }

    public function postLogin()
    {

        $this->auth->invite();

        return 'go check email';
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function authenticate(LoginToken $token)
    {
        $this->auth->login($token);

        // return 'You are now signed in,' . auth()->user()->name;
        return redirect('/');
    }
}
