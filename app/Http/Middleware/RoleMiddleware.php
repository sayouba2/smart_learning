<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();
    
        // Si l'utilisateur n'est pas connecté, redirige vers la page de login
        if (!$user) {
            return redirect()->route('login');
        }
    
        // Si l'utilisateur n'a pas le bon rôle, redirige vers une page d'accès refusé
        if (!in_array($user->role, $roles)) {
            return redirect()->route('access.denied'); // Remplace par une route d'erreur spécifique si tu en as une
        }
    
        return $next($request);
    }
    
}