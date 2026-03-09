<?php

namespace Sharmindar\Core\Activity\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Sharmindar\Core\Activity\Models\LoginHistory;
use Illuminate\Support\Facades\Request;

class AuthenticationListener
{
    /**
     * Handle user login events.
     */
    public function onUserLogin($event)
    {
        LoginHistory::create([
            'user_id' => $event->user->id,
            'ip_address' => Request::ip(),
            'user_agent' => Request::header('User-Agent'),
            'login_at' => now(),
            'status' => 'success',
        ]);
    }

    /**
     * Handle user logout events.
     */
    public function onUserLogout($event)
    {
        // Update the most recent login record with logout time
        if ($event->user) {
            $lastLogin = LoginHistory::where('user_id', $event->user->id)
                ->whereNull('logout_at')
                ->latest('login_at')
                ->first();

            if ($lastLogin) {
                $lastLogin->update([
                    'logout_at' => now(),
                ]);
            }
        }
    }

    /**
     * Handle user failed login events.
     * Note: We don't have the user ID for sure on failures, but we can log IPs.
     */
    public function onUserFailedLogin($event)
    {
    // If we want to track failed logins, we can handle it here 
    // using the $event->credentials etc.
    }
}
