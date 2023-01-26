<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckUserRole
{
    /**
     * Check user's role
     *
     * @param Request $request
     * @param Closure $next
     * @param string $role
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $role): Response|RedirectResponse
    {
        if (!auth()->user()->hasRole($role)) {
            abort(404);
        }

        return $next($request);
    }
}
