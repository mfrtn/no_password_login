<?php

namespace App\Http\Controllers;

use App\Services\SMS;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    public function __invoke(SMS $output)
    {

        try {
            $receptor = "09212745038";
            $tokens = ['123', '456', '789'];
            $template = "invoice";

            $result = $output->sendVerifySMS($receptor, $tokens, $template);

            // dd($result);
            if ($result) {
                foreach ($result as $r) {
                    echo "messageid = $r->messageid<br />";
                    echo "message = $r->message<br />";
                    echo "status = $r->status<br />";
                    echo "statustext = $r->statustext<br />";
                    echo "sender = $r->sender<br />";
                    echo "receptor = $r->receptor<br />";
                    echo "date = $r->date<br />";
                    echo "cost = $r->cost<br />";
                }
            }
            return 'done';
        } catch (\Kavenegar\Exceptions\ApiException $e) {
            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
            return $e->errorMessage();
        } catch (\Kavenegar\Exceptions\HttpException $e) {
            // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
            return $e->errorMessage();
        }
    }
}
