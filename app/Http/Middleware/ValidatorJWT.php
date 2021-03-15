<?php

namespace App\Http\Middleware;

use App\User;
use \Firebase\JWT\JWT;

use Closure;

class ValidatorJWT
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
        $key = env('SECRET_KEY');
        $time_now = strtotime(now());

        try {
            $decoded = JWT::decode($request->bearerToken(), $key, array('HS256'));
        } catch (\Throwable $th) {
            return redirect('error');
        }

        if( $decoded->iat+3600*10 < $time_now  ){
            return redirect('error');
        }

        return $next($request);
    }
}
