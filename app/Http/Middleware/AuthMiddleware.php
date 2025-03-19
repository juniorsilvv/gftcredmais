<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Tenta obter o token do header Authorization
            $token = JWTAuth::parseToken();

            // Verifica se o token é válido
            $user = JWTAuth::authenticate($token);

            // Se o token não for válido, retorna um erro
            if (!$user)
                return response()->json(['message' => 'Token inválido'], 401);

        } catch (JWTException $e) {
            return response()->json(['message' => 'Token inválido'], 401);
            // Se ocorrer um erro ao tentar analisar o token
        }

        return $next($request);
    }
}
