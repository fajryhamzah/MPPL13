<?php

namespace App\Http\Middleware;

use Closure;

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

        if($request->session()->exists('lang')){
          $lang = $request->session()->get("lang");

        }
        else{
          $lang = "en";
        }

        \App::setLocale($lang);
        return $next($request);
    }
}
