<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TwoFactorAuth extends Model
{
    protected $fillable = [
        "code",
        "user_id",
        "is_used",
        "expire_at",
    ];

    public function generateCode($user)
    {
        $code = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(6 / strlen($x)))), 1, 6);
        return $this->firstOrCreate([
            "code" => $code,
            "user_id" => $user->id,
            "expire_at" => now()->addMinutes(10)
        ]);
    }
}
