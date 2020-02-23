<?php

namespace App\Http\Middleware;

use App\TwoFactorAuth;
use Carbon\Carbon;
use Closure;

class TwoFactor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
        if (auth()->check()) {
            $user_code = TwoFactorAuth::where('user_id', $user->id)->first();
            if (!empty($user_code->code) && $user_code->is_uesd == false) {
                if (Carbon::make($user_code->expire_at)->lt(now())) {
                    $user_code->delete();
                    auth()->logout();

                    return redirect()->route('login')
                        ->withMessage('The two factor code has expired. Please login again.');
                }

                if (!$request->is('verify*')) {
                    return redirect()->route('verify.index');
                }
            }
        }


        return $next($request);
    }

}
