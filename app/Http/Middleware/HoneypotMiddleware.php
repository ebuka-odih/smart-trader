<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HoneypotMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only apply honeypot validation to auth routes
        if ($request->is('login', 'register')) {
            $userAgent = $request->userAgent();
            $ip = $request->ip();
            
            // For GET requests (viewing the form), only block obvious bots
            // Allow normal browsers to access the login/register pages
            if ($request->isMethod('GET')) {
                // Only block if user agent is completely missing or very obviously a bot
                // Allow normal browsers even if user agent is short
                if (empty($userAgent)) {
                    \Log::warning('Request without user agent blocked', [
                        'ip' => $ip,
                        'url' => $request->fullUrl(),
                        'timestamp' => now()
                    ]);
                    
                    return response()->json(['error' => 'Access denied'], 403);
                }
                
                // For GET requests, allow through - form validation will catch bots on submission
                return $next($request);
            }
            
            // For POST requests (form submissions), apply stricter checks
            // List of known bot user agents
            $botPatterns = [
                'bot', 'crawler', 'spider', 'scraper', 'curl', 'wget', 'python', 'java',
                'php', 'perl', 'ruby', 'go-http', 'okhttp', 'apache-httpclient'
            ];
            
            // Check if user agent contains bot patterns
            $isBot = false;
            foreach ($botPatterns as $pattern) {
                if (stripos($userAgent, $pattern) !== false) {
                    $isBot = true;
                    break;
                }
            }
            
            // Check for missing or suspicious user agent (only for POST)
            if (empty($userAgent) || strlen($userAgent) < 10) {
                $isBot = true;
            }
            
            // Check for rapid POST requests from same IP (basic rate limiting)
            // Only apply to POST requests to avoid blocking legitimate page views
            $cacheKey = 'honeypot_post_requests_' . $ip;
            $requestCount = cache()->get($cacheKey, 0);
            
            if ($requestCount > 10) { // More than 10 POST requests per minute
                $isBot = true;
            }
            
            // Increment request count only for POST requests
            cache()->put($cacheKey, $requestCount + 1, 60); // 1 minute cache
            
            if ($isBot) {
                \Log::warning('Bot detected by middleware', [
                    'ip' => $ip,
                    'user_agent' => $userAgent,
                    'url' => $request->fullUrl(),
                    'method' => $request->method(),
                    'timestamp' => now()
                ]);
                
                // Return a generic error response
                return response()->json(['error' => 'Access denied'], 403);
            }
        }
        
        return $next($request);
    }
}