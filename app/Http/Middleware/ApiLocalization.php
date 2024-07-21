<?php

namespace App\Http\Middleware;

use Closure;

class ApiLocalization
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
        $local = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        app()->setLocale($local);
        return $next($request);
    }
}
