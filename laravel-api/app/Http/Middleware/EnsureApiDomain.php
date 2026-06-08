<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureApiDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost(); // "api.local" ou "admin.local"

        // Si la requête arrive sur api.local → on laisse passer
        // Si elle arrive ailleurs → 404
        if ($host !== 'api.local') {
            abort(404);
        }

        return $next($request);
    }
}
