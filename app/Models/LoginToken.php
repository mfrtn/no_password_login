<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

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
            'token' =>  Str::random(50),
        ]);
    }

    public function send()
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
