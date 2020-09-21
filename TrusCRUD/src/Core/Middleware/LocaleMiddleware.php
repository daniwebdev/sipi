<?php
namespace TrusCRUD\Core\Middleware;

use Closure;

class LocaleMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        // dd(session()->all());
        if ($request->session()->has('locale')  ) {
            $locale = $request->session()->get('locale');
            \App::setLocale($locale);
        }
        return $next($request);
    }
}