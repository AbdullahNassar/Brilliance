<?php

namespace App\Http\Middleware;

use Closure;

class SetLang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->is('admin*'))
            return $next($request);

        if ($request->is('register*'))
            return $next($request);

        if ($request->is('login*'))
            return $next($request);

        if ($request->is('logout*'))
            return $next($request);

        if ($request->is('password*'))
            return $next($request);

        if ($request->is('sitelogout*'))
            return $next($request);

        if ($request->is('auth*'))
            return $next($request);


        $urlLang = $request->segment(1);
        if (!in_array($urlLang, ['ar', 'en']))
            return is_null($urlLang) ? redirect($request->url() . '/ar') :
                redirect(preg_replace('/' . $request->segment(1) . '/', 'ar/' . $request->segment(1), strtolower($request->url()), 1));

        session()->flash('lang', $urlLang);
        app()->setLocale($urlLang);
        view()->share('lang', $urlLang);

        return $next($request);
    }
}