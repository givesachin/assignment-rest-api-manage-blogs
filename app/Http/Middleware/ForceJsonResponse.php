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
        'api/*',
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
        $flag = false;
        $path = $request->path();

        foreach ($this->except as $except) {
            $except = trim($except, '*');
            if (str_contains($path, $except)) {
                $flag = true;
            }
        }
        
        if ($flag) {
            if (($request->expectsJson() || $request->isJson()) && $request->wantsJson()) {
                return $next($request);
            }

            return response()->json([
                'error' => 'Only application/json requests are accepted'
            ], 406);
        } else {
            return $next($request);
        }
    }
}
