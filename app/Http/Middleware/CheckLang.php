<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Session;
use App\Models\Setting;

class CheckLang
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
        if ($lang = Session::get('lang')) {
            App::setlocale($lang);
        }
        else {
            $setting = Setting::first();
            $lang = $setting->default_lang;
            App::setlocale($lang);
        }
        return $next($request);
    }
}
