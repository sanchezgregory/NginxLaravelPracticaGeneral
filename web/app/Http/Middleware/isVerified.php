<?php

namespace App\Http\Middleware;

use Closure;

class isVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $user = auth()->user();

        if ($user->registration_token != null) {

            return redirect()->route('home')->with('status', 'Debe verificar su cuenta por email');

        }

        return $next($request);

    }
}
