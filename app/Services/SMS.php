<?php

namespace App\Services;

interface SMS
{
  public function sendVerifySMS(string $receptor, array $tokens, string $template, string $type = null);

  public function sendSimpleSMS(string $sender, string $receptor, string $message);
}
