<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceJsonResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Force JSON response for AJAX requests
        if ($request->expectsJson() || $request->ajax()) {
            $request->headers->set('Accept', 'application/json');
        }

        try {
            $response = $next($request);

            // If this is an AJAX request and we're getting a redirect or HTML response,
            // convert it to a JSON error response
            if ($request->expectsJson() || $request->ajax()) {
                if ($response instanceof \Illuminate\Http\RedirectResponse) {
                    \Log::info('Converting redirect to JSON for AJAX request', [
                        'original_url' => $response->getTargetUrl(),
                        'request_url' => $request->fullUrl()
                    ]);
                    
                    return response()->json([
                        'success' => false,
                        'message' => 'Session expired or unauthorized. Please refresh the page.',
                        'redirect' => $response->getTargetUrl()
                    ], 401);
                }

                // Check if we're getting an HTML response for AJAX requests
                $contentType = $response->headers->get('content-type', '');
                if (strpos($contentType, 'text/html') !== false) {
                    \Log::warning('HTML response detected for AJAX request', [
                        'request_url' => $request->fullUrl(),
                        'content_type' => $contentType,
                        'status' => $response->getStatusCode()
                    ]);
                    
                    return response()->json([
                        'success' => false,
                        'message' => 'Server error occurred. Please refresh the page and try again.'
                    ], 500);
                }
            }

            return $response;
            
        } catch (\Exception $e) {
            \Log::error('Middleware error in ForceJsonResponse', [
                'error' => $e->getMessage(),
                'request_url' => $request->fullUrl()
            ]);
            
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An unexpected error occurred. Please try again.'
                ], 500);
            }
            
            throw $e;
        }
    }
}
