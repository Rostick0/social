<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ParseRequestExtends
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $extends = mb_split(",", $request["extend"]);

        if (strlen($extends[0]) == 0) {
            $request["extend"] = [];
        } else {
            $request["extend"] =  $extends;
        }

        return $next($request);
    }
}
