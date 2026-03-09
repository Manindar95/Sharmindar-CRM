<?php

namespace Sharmindar\Core\Setting\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class IpRestrictionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the comma-separated allowed IPs from core configuration
        $allowedIpsString = core()->getConfigData('company_settings.security.network.allowed_ips');

        // If no IPs are configured, restriction is disabled
        if (empty(trim($allowedIpsString))) {
            return $next($request);
        }

        $allowedIps = array_map('trim', explode(',', $allowedIpsString));
        $clientIp = $request->ip();

        if (!in_array($clientIp, $allowedIps) && !in_array('*', $allowedIps)) {
            Log::warning("IP Restriction triggered: Blocked access attempt from {$clientIp}");

            if ($request->expectsJson()) {
                return response()->json(['message' => 'Access denied from your IP address.'], Response::HTTP_FORBIDDEN);
            }

            abort(Response::HTTP_FORBIDDEN, 'Access denied from your IP address.');
        }

        return $next($request);
    }
}
