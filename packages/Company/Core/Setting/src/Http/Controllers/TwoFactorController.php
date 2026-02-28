<?php

namespace Company\Core\Setting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;
use Webkul\Admin\Http\Controllers\Controller;

class TwoFactorController extends Controller
{
    /**
     * Show the 2FA challenge form.
     */
    public function showChallengeForm()
    {
        if (!session()->has('2fa:user:id')) {
            return redirect()->route('admin.session.create');
        }

        return view('admin::security.2fa-challenge');
    }

    /**
     * Verify the 2FA code and securely login.
     */
    public function verifyChallenge(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $userId = session('2fa:user:id');

        if (!$userId) {
            return redirect()->route('admin.session.create');
        }

        // Technically we should fetch the user without full auth acting
        // For simplicity in this CRM context, we will login the user to auth()->user()
        // but restrict them via middleware if 2fa isn't complete. Let's do a direct lookup.
        $user = \Webkul\User\Models\User::find($userId);

        if (!$user) {
            return redirect()->route('admin.session.create');
        }

        $google2fa = app('pragmarx.google2fa');
        $valid = $google2fa->verifyKey($user->two_factor_secret, $request->code);

        if ($valid) {
            session()->forget('2fa:user:id');
            auth()->guard('user')->login($user, session('2fa:user:remember', false));

            session()->flash('success', 'Two-Factor Authentication verified successfully.');
            // Proceed to standard Webkul login routing flow mapping
            return redirect()->route('admin.dashboard.index');
        }

        return back()->with('error', 'The provided two-factor authentication code was invalid.');
    }
}
