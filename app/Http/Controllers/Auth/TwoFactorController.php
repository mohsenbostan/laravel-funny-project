<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\SendCodeToUser;
use App\TwoFactorAuth;
use App\User;
use Illuminate\Http\Request;

class TwoFactorController extends Controller
{
    public function index()
    {
        return view('auth.twoFactor');
    }

    public function store(Request $request)
    {
        $request->validate([
            'two_factor_code' => 'required',
        ]);

        $user = auth()->user();
        $user_code = TwoFactorAuth::where('user_id', $user->id)->first();
        if ($request->input('two_factor_code') == $user_code->code) {
            $user_code->delete();

            return redirect()->route('home');
        }

        return redirect()->back()
            ->withErrors(['two_factor_code' =>
                'The two factor code you have entered does not match']);
    }

    public function resend()
    {
        $user = auth()->user();
        $code = new TwoFactorAuth();
        $user->notify(new SendCodeToUser($code->generateCode(User::find($user)->first())));

        return redirect()->back()->withMessage('The two factor code has been sent again');
    }
}
