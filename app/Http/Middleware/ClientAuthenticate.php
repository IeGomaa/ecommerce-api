<?php

namespace App\Http\Middleware;

use App\Http\Traits\Api\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientAuthenticate
{
    use ApiResponseTrait;
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::guard('client_api')->check()) {
            return  $this->apiResponse(401, 'Must Login First');
        }
        return $next($request);
    }
}
