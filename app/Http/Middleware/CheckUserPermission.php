<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckUserPermission
{
    /**
     * Check user's permission
     *
     * @param Request $request
     * @param Closure $next
     * @param string $permission
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $permission): Response|RedirectResponse
    {
        if ( ! auth()->user()->hasPermissionAnyWay($permission)) {
            abort(404);
        }

        return $next($request);
    }
}
