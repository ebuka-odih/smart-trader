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

        $response = $next($request);

        // If this is an AJAX request and we're getting a redirect or HTML response,
        // convert it to a JSON error response
        if (($request->expectsJson() || $request->ajax()) && $response instanceof \Illuminate\Http\RedirectResponse) {
            return response()->json([
                'success' => false,
                'message' => 'Session expired or unauthorized. Please refresh the page.',
                'redirect' => $response->getTargetUrl()
            ], 401);
        }

        return $response;
    }
}
