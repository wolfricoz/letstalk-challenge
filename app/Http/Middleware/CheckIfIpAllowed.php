<?php

namespace App\Http\Middleware;

use App\Models\IpTable;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfIpAllowed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!IpTable::check($request->ip())){
            abort(401);
        }

        return $next($request);
    }
}
