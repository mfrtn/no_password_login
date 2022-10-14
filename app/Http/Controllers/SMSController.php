<?php

namespace App\Http\Controllers;

use App\Services\KavehnegarSMS;
use App\Services\SMS;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    public function __invoke(SMS $output)
    {

        try {

            $sender = "10007700044000";
            $receptor = "09212745038";
            $receptors = "09212745038,09125003001";

            // $tokens = ['asda', 'ali',];
            $tokens = ['test'];
            $template = "accept-withdraw";

            $message = "تست ارسال پیام ساده";

            $result = $output->sendVerifySMS($receptor, $tokens, $template);
            // $result = $output->sendSimpleSMS($sender, $receptor, $message);

            return $result;
        } catch (\Kavenegar\Exceptions\ApiException $e) {
            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
            return $e->errorMessage();
        } catch (\Kavenegar\Exceptions\HttpException $e) {
            // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
            return $e->errorMessage();
        }
    }
}
