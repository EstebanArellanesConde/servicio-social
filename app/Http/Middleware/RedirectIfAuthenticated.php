<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                /*
                 * si es jefe o alumno y quiere regresar al login sin haber
                 * cerrado sesión antes, se vuelve a redirigir a su respectivo
                 * dashboard
                 */
                $role = auth()->user()->hasRole('jefe') ? 'jefe' : 'alumno';
                return redirect(RouteServiceProvider::HOME . $role);
            }
        }

        return $next($request);
    }
}
