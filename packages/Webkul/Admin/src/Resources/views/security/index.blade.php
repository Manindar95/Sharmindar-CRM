<x-admin::layouts>
    <x-slot:title>
        Security Settings
    </x-slot>

    <!-- Page Header -->
    <div class="flex items-center justify-between mt-4">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Security Settings</h1>
    </div>

    <!-- Body -->
    <div class="mt-8 flex gap-10 max-xl:flex-wrap">
        
        <!-- Left Column: 2FA Setup -->
        <div class="flex flex-1 flex-col gap-2">
            <div class="box-shadow rounded-lg bg-white p-6 dark:bg-gray-900">
                <p class="mb-4 text-lg font-semibold text-gray-800 dark:text-white">Two-Factor Authentication (2FA)</p>
                <p class="mb-6 text-sm text-gray-600 dark:text-gray-300">
                    Add additional security to your account using two-factor authentication.
                </p>

                @if ($user->two_factor_secret)
                    <div class="rounded-lg bg-green-50 p-4 mb-4 border border-green-200 dark:bg-gray-800 dark:border-green-900">
                        <p class="text-sm font-semibold text-green-800 dark:text-green-400">
                            Two-factor authentication is currently enabled.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('admin.user.security.2fa.disable') }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="secondary-button !border-red-500 !text-red-500 hover:!bg-red-50">
                            Disable 2FA
                        </button>
                    </form>
                @else
                    <div class="rounded-lg bg-gray-50 p-6 border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                        <p class="text-sm text-gray-800 dark:text-white mb-4">
                            You have not enabled two-factor authentication.
                            <br/><br/>
                            When two-factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application.
                        </p>

                        <div class="mb-4 bg-white p-4 inline-block rounded border">
                            {!! $qrCodeUrl !!}
                        </div>

                        <form method="POST" action="{{ route('admin.user.security.2fa.enable') }}" class="max-w-xs">
                            @csrf
                            <x-admin::form.control-group>
                                <x-admin::form.control-group.label class="required">
                                    Setup Key
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                    type="text"
                                    name="code"
                                    rules="required"
                                    placeholder="Enter 6-digit code"
                                />
                                <x-admin::form.control-group.error control-name="code" />
                            </x-admin::form.control-group>

                            <button type="submit" class="primary-button mt-2">
                                Enable 2FA
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Column: Browser Sessions -->
        <div class="flex flex-1 flex-col gap-2">
            <div class="box-shadow rounded-lg bg-white p-6 dark:bg-gray-900">
                <p class="mb-4 text-lg font-semibold text-gray-800 dark:text-white">Browser Sessions</p>
                <p class="mb-6 text-sm text-gray-600 dark:text-gray-300">
                    Manage and log out your active sessions on other browsers and devices.
                </p>

                <div class="flex flex-col gap-4">
                    @foreach ($sessions as $session)
                        <div class="flex items-center justify-between p-4 border rounded-lg {{ $session->id === request()->session()->getId() ? 'border-brandColor bg-gray-50 dark:bg-gray-800' : 'border-gray-200 dark:border-gray-700' }}">
                            <div>
                                <p class="text-sm font-semibold text-gray-800 dark:text-white">
                                    {{ $session->ip_address }}
                                    @if ($session->id === request()->session()->getId())
                                        <span class="ml-2 text-xs text-brandColor font-bold">(This Browser)</span>
                                    @endif
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    Last Active: {{ \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans() }}
                                </p>
                            </div>
                            
                            @if ($session->id !== request()->session()->getId())
                                <form method="POST" action="{{ route('admin.user.security.session.revoke', $session->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 text-sm font-semibold hover:underline">Revoke</button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>

                @if(count($sessions) > 1)
                    <div class="mt-6 pt-4 border-t dark:border-gray-700">
                        <form method="POST" action="{{ route('admin.user.security.session.revoke_others') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="secondary-button !border-red-500 !text-red-500 hover:!bg-red-50">
                                Log Out Other Browser Sessions
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

    </div>
</x-admin::layouts>
