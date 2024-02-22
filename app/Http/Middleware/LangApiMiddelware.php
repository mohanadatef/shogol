<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\App;


class LangApiMiddelware
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
        $lang = $request->header('lang');
        if (!$lang) {
            $lang = $request->lang ?? null;
        }
        !$lang ?: App::setlocale($lang);
        return $next($request);
    }
}
