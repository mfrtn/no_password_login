<?php

namespace App\Services;

use Kavenegar\KavenegarApi;

class KavehnegarSMS implements SMS
{
  public function __construct(protected KavenegarApi $sms)
  {
  }

  public function sendVerifySMS($receptor, $tokens, $template, $type = null)
  {
    $token1 = $tokens[0];
    $token2 = $tokens[1] ?? null;
    $token3 = $tokens[2] ?? null;

    return $this->sms->VerifyLookup($receptor, $token1, $token2, $token3, $template, $type);
  }

  public function sendSimpleSMS($sender, $receptor, $message)
  {
    return $this->sms->Send($sender, $receptor, $message);
  }
}
