<?php

namespace App\Http\Middleware;

use Closure;
use function Faker\Provider\pt_BR\check_digit;
use Illuminate\Http\Request;

class ConfirmMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user=auth('client')->check()?auth('client')->user():auth()->user();
        if ((auth()->check()||auth('client')->check())&&$user->is_confirmed == 1)
        return $next($request);

        if(auth('client')->check())
        return redirect()->route('client.confirm.form');
        return redirect()->route('confirm.form');

    }
}
