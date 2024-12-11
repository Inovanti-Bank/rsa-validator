<?php

namespace InovantiBank\RSAValidator\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateRSAHeaders
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->hasHeader('client_id') || !$request->hasHeader('data')) {
            return response()->json(['error' => 'Missing required headers: client_id or data'], Response::HTTP_BAD_REQUEST);
        }

        return $next($request);
    }
}
