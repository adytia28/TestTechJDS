<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PassportMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        $token_parts = explode('.', $token);

        if(isset($token_parts[1])) {
            return $next($request);
        } else {
            return response(['message' => 'Unauthorized'], 401);
        }

    }
}
