<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceJsonResponse
{
    /**
     * The URIs that should be excluded from JSON response enforcement.
     *
     * @var array
     */
    protected $except = [
        // 'api/*',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->expectsJson() || $request->isJson() || $request->wantsJson()) {
            return $next($request);
        }

        return response()->json([
            'error' => 'Only application/json requests are accepted'
        ], 406); // 406 Not Acceptable
    }
}
