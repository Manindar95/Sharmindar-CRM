<?php

namespace Sharmindar\Core\Setting\Http\Controllers;

use Illuminate\Http\Request;
use Webkul\Admin\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use PragmaRX\Google2FA\Google2FA;

class SecurityController extends Controller
{
    /**
     * Show the Security profile tab.
     */
    public function index()
    {
        $user = auth()->guard('user')->user();

        // Fetch Active Sessions
        $sessions = DB::table('sessions')
            ->where('user_id', $user->id)
            ->orderBy('last_activity', 'desc')
            ->get();

        $google2fa = app('pragmarx.google2fa');
        $qrCodeUrl = '';

        if (!$user->two_factor_secret) {
            $secret = $google2fa->generateSecretKey();
            session(['2fa_setup_secret' => $secret]);

            $qrCodeUrl = $google2fa->getQRCodeUrl(
                config('app.name'),
                $user->email,
                $secret
            );
        }

        return view('admin::security.index', compact('user', 'sessions', 'qrCodeUrl'));
    }

    /**
     * Enable 2FA.
     */
    public function enableTwoFactor(Request $request)
    {
        $request->validate(['code' => 'required']);
        $user = auth()->guard('user')->user();

        $secret = session('2fa_setup_secret');
        $google2fa = app('pragmarx.google2fa');

        if ($google2fa->verifyKey($secret, $request->code)) {
            $user->two_factor_secret = $secret;
            $user->two_factor_confirmed_at = now();
            $user->save();

            session()->forget('2fa_setup_secret');
            session()->flash('success', 'Two-Factor Authentication successfully enabled.');
        }
        else {
            session()->flash('error', 'Invalid Authenticator Code.');
        }

        return back();
    }

    /**
     * Disable 2FA.
     */
    public function disableTwoFactor()
    {
        $user = auth()->guard('user')->user();
        $user->two_factor_secret = null;
        $user->two_factor_confirmed_at = null;
        $user->two_factor_recovery_codes = null;
        $user->save();

        session()->flash('success', 'Two-Factor Authentication has been disabled.');
        return back();
    }

    /**
     * Revoke specific session.
     */
    public function revokeSession($id)
    {
        DB::table('sessions')
            ->where('id', $id)
            ->where('user_id', auth()->guard('user')->id())
            ->delete();

        session()->flash('success', 'Browser session successfully logged out.');
        return back();
    }

    /**
     * Revoke all other sessions.
     */
    public function revokeOtherSessions()
    {
        DB::table('sessions')
            ->where('user_id', auth()->guard('user')->id())
            ->where('id', '!=', session()->getId())
            ->delete();

        session()->flash('success', 'All other browser sessions have been logged out.');
        return back();
    }
}
