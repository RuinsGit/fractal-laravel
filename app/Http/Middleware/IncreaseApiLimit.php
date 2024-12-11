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
        // Varsayılan limiti 2x'e çıkar (60 -> 120)
        $key = 'api:' . $request->ip();
        
        if ($this->limiter->tooManyAttempts($key, 120)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Çox sayda sorğu göndərildi. Zəhmət olmasa bir az gözləyin.'
            ], 429);
        }

        $this->limiter->hit($key, 60); // 1 dakika süreyle

        return $next($request);
    }
}