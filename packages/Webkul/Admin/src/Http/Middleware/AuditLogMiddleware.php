<?php

namespace Webkul\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Webkul\Admin\Models\AuditLog;

class AuditLogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only log state-changing methods
        if (in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            $user = auth()->guard('user')->user();

            if ($user) {
                $this->logAction($request, $user);
            }
        }

        return $response;
    }

    /**
     * Log the action.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Webkul\User\Models\User  $user
     * @return void
     */
    protected function logAction($request, $user)
    {
        $action = $this->resolveActionName($request);

        AuditLog::create([
            'user_id'    => $user->id,
            'user_name'  => $user->name,
            'action'     => $action,
            'method'     => $request->method(),
            'url'        => $request->fullUrl(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'payload'    => $this->filterPayload($request->all()),
        ]);
    }

    /**
     * Resolve a human-readable action name from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function resolveActionName($request)
    {
        $method = $request->method();
        $path = $request->path();

        // Simple mapping for common actions
        if (str_contains($path, 'leads')) {
            if ($method === 'POST') return 'Created Lead';
            if (in_array($method, ['PUT', 'PATCH'])) return 'Updated Lead';
            if ($method === 'DELETE') return 'Deleted Lead';
        }

        if (str_contains($path, 'proposals')) {
            if ($method === 'POST') return 'Created Proposal';
            if (in_array($method, ['PUT', 'PATCH'])) return 'Updated Proposal';
            if ($method === 'DELETE') return 'Deleted Proposal';
        }

        if (str_contains($path, 'projects')) {
            if ($method === 'POST') return 'Created Project';
            if (in_array($method, ['PUT', 'PATCH'])) return 'Updated Project';
            if ($method === 'DELETE') return 'Deleted Project';
        }

        // Fallback to method and path
        return "{$method} Action on " . last(explode('/', $path));
    }

    /**
     * Filter sensitive data from the payload.
     *
     * @param  array  $payload
     * @return array
     */
    protected function filterPayload($payload)
    {
        $sensitiveFields = ['password', 'password_confirmation', '_token', 'api_token'];

        return array_diff_key($payload, array_flip($sensitiveFields));
    }
}
