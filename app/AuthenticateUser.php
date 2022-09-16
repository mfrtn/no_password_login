<?php

namespace App;

use App\Models\User;
use App\Models\LoginToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AuthenticateUser
{
  use ValidatesRequests;

  protected $request;


  public function __construct(Request $request)
  {
    $this->request = $request;
  }

  public function invite()
  {
    // apurdy@example.net
    $this->validateRequest()
      ->createToken()
      ->send();
  }

  public function login(LoginToken $token)
  {
    Auth::login($token->user);
    $token->delete();
  }

  protected function validateRequest()
  {
    $this->validate($this->request, [
      'email' => 'required|email|exists:users'
    ]);

    return $this;
  }

  protected function createToken()
  {
    $user = User::byEmail($this->request->email);

    return LoginToken::generateFor($user);
  }
}
