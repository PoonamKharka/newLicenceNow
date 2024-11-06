<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class corsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Define a list of allowed origins based on your logic
        $allowedOrigins = [
            'http://localhost:3000',
            'https://ready-set-driving-school.pwd.net.au/'
        ];
        
        $origin = $request->headers->get('Origin'); // Get the Origin from the request headers

        // Check if the request's origin is allowed
        if (in_array($origin, $allowedOrigins)) {
            return $next($request)
                ->header('Access-Control-Allow-Origin', $origin)
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization')
                ->header('Access-Control-Allow-Credentials', 'true')
                ->header('Content-Type', 'application/json');  // Set Content-Type header;
        }

        // Default if the origin is not allowed
        return $next($request)
            ->header('Access-Control-Allow-Origin', ''); // Block the request if the origin isn't allowed
    }
}
