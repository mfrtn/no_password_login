<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoginToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'token',
    ];

    public function getRouteKeyName()
    {
        return 'token';
    }

    public static function generateFor(User $user)
    {
        return static::create([
            'user_id' => $user->id,
            // 'token' =>  Str::random(50),
            'token' =>  Str::random(10),

        ]);
    }


    // Send Email

    public function sendEmail()
    {
        $url = url('/auth/token', $this->token);
        // dd($url);
        Mail::raw(
            '<a href="' . $url . '">' . $url . '</a>',
            function ($message) {
                $message->to($this->user->email)
                    ->subject('Login to Laracast');
            }
        );
    }


    // Send SMS
    public function sendSMS($output, $request)
    {
        $url = url('/auth/token', $this->token);

        try {

            $receptor = $request->mobile;
            $tokens = [$url];
            $template = "accept-withdraw";
            $output->sendVerifySMS($receptor, $tokens, $template);

            // return $result;
        } catch (\Kavenegar\Exceptions\ApiException $e) {
            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
            return $e->errorMessage();
        } catch (\Kavenegar\Exceptions\HttpException $e) {
            // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
            return $e->errorMessage();
        }
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
