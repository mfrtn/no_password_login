<?php

namespace App\Services;

use Kavenegar\KavenegarApi;

class KavehnegarSMS implements SMS
{
  public function __construct(protected KavenegarApi $sms) //protected Kavenegar $sms
  {
  }

  public function sendVerifySMS($receptor, array $tokens, $template, $type = null)
  {
    return $this->sms->VerifyLookup($receptor, $tokens[0], $tokens[1], $tokens[2], $template, $type = null);
  }
}
