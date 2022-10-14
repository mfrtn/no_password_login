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

  public function invite($output)
  {
    // apurdy@example.net
    // $this->validateRequest()
    //   ->createToken()
    //   ->sendEmail();

    // 09381970033
    $this->validateRequest()
      ->createToken()
      ->sendSMS($output, $this->request);
  }

  public function login(LoginToken $token)
  {
    Auth::login($token->user);
    $token->delete();
  }

  protected function validateRequest()
  {
    // $this->validate($this->request, [
    //   'email' => 'required|email|exists:users'
    // ]);

    $this->validate($this->request, [
      'mobile' => 'required|exists:users'
    ]);

    return $this;
  }

  protected function createToken()
  {
    // $user = User::byEmail($this->request->email);

    $user = User::byMobile($this->request->mobile);

    return LoginToken::generateFor($user);
  }
}
