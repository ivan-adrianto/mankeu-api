<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;

class JwtMiddleware
{
    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        try {
            $decoded = JWT::decode($token, env('JWT_SECRET'));
            $request->user = $decoded; // Attach the decoded user to the request
        } catch (\Exception $e) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}

