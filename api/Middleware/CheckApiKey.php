<?php
namespace Api\MIddleware;

use Closure;
use TrusCRUD\Core\Models\UserApiKey;

class CheckApiKey {
        /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        $key = $request->header('X-API-KEY');


        if($key == '') {
            return resJSON([
                'status' => false,
                'message' => 'Empty X-API-KEY',
            ], 401);
        }

        try {

            $getOne = UserApiKey::where('key', $key)->firstOrFail();

            $getOne->hits += 1;

            $getOne->save();

        } catch (\Throwable $th) {
            return resJSON([
                'status' => false,
                'message' => 'Invalid X-API-KEY',
            ], 401);
        }

        return $next($request);
    }
}