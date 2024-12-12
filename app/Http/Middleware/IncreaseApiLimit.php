<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class IncreaseApiLimit
{
    protected $limiter;

    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    public function handle(Request $request, Closure $next): Response
    {
        $key = 'api:' . $request->ip();
        
        if ($this->limiter->tooManyAttempts($key, 240)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Çox sayda sorğu göndərildi. Zəhmət olmasa bir az gözləyin.'
            ], 429);
        }

        $this->limiter->hit($key, 120);

        return $next($request);
    }
}