<?php

namespace App\Http\Middleware;

use App\Models\Enums\Role;
use Closure;
use Illuminate\Http\Request;

class IsEmployer
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
        if (auth('sanctum')->user()->role === Role::EMPLOYER) {
            return $next($request);
        }

        return response('Forbidden', 403);
    }
}
