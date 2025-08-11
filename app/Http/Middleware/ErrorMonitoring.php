<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ErrorMonitoring
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);
        
        try {
            $response = $next($request);
            
            // Log successful requests
            if ($response->getStatusCode() === 200) {
                $duration = round((microtime(true) - $startTime) * 1000, 2);
                
                if ($duration > 5000) { // Log slow requests (>5s)
                    Log::warning('Slow request detected', [
                        'url' => $request->fullUrl(),
                        'method' => $request->method(),
                        'duration_ms' => $duration,
                        'ip' => $request->ip()
                    ]);
                }
            }
            
            return $response;
            
        } catch (\Exception $e) {
            // Log error dengan detail
            Log::error('Request error caught by middleware', [
                'url' => $request->fullUrl(),
                'method' => $request->method(),
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);
            
            // Return custom error response
            return response()->view('errors.500', [
                'error' => config('app.debug') ? $e->getMessage() : 'Terjadi kesalahan server'
            ], 500);
        }
    }
}