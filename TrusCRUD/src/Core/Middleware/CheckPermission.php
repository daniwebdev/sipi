<?php

namespace TrusCRUD\Core\Middleware;

use TrusCRUD\Helpers\Role;
use Closure;

class CheckPermission
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
        $routeName = explode('.', $request->route()->getName());

        
        if(isset($routeName[1])) {
            
            $data = [
                "store" => "create",
                "create" => "create",
                "edit" => "edit",
                "destroy" => "destroy",
                "show" => "show",
                "index" => "index",
            ];


            $hasRole = isset($data[$routeName[1]]) ? Role::isAllow($data[$routeName[1]]):1;

            if($hasRole) {
                return $next($request);
            } else {
                return redirect()->route('error', 403)->with('_method', 'GET');
            }
        } else {
            return $next($request);
        }
    }

}
