<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Traits\Authorization;
use Spatie\Permission\Traits\HasRoles;

class AdminMiddleware
{
    use Authorization, HasRoles;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $this->me($request);

        if($user->hasRole('admin')) {
            return $next($request);
        } else {
            return response(['message' => 'You cannot access page'], 404);
        }
    }
}
