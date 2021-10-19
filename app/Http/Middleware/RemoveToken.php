<?php
namespace App\Http\Middleware;

use Closure;

class RemoveToken
{
    public function handle($request, Closure $next)
    {
        unset($request['_token']);

        return $next($request);
    }
}