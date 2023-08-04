<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIsAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()) {
            return response('Not authorized',400);
        }
        return $next($request);
    }
}
