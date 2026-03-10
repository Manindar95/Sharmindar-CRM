<x-admin::layouts.anonymous>
    <!-- Page Title -->
    <x-slot:title>
        Two-Factor Authentication
    </x-slot>

    <div class="flex h-[100vh] flex-col items-center justify-center gap-10" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('cover-image.png') }}') center/cover no-repeat;">
        <div class="flex flex-col items-center gap-5">
            <!-- Logo -->
            @if ($logo = core()->getConfigData('general.design.admin_logo.logo_image'))
                <img
                    class="h-10 w-[110px]"
                    src="{{ Storage::url($logo) }}"
                    alt="{{ config('app.name') }}"
                />
            @else
                <img
                    class="h-14 max-w-[200px] object-contain"
                    src="{{ asset('Sharmindar-CRM_logo-name.png') }}"
                    alt="{{ config('app.name') }}"
                />
            @endif

            <div class="box-shadow flex min-w-[300px] flex-col rounded-md bg-white dark:bg-gray-900">
                <!-- Challenge Form -->
                <x-admin::form :action="route('admin.2fa.verify')">
                    <p class="p-4 text-xl font-bold text-gray-800 dark:text-white">
                        Two-Factor Authentication
                    </p>
                    
                    <p class="px-4 text-sm text-gray-600 dark:text-gray-300">
                        Please enter the 6-digit code from your authenticator application.
                    </p>

                    <div class="border-y p-4 dark:border-gray-800 mt-2">
                        <!-- Code -->
                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label class="required">
                                Authentication Code
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="text"
                                class="w-[254px] max-w-full text-center tracking-widest text-lg font-mono"
                                id="code"
                                name="code"
                                rules="required|size:6"
                                placeholder="123456"
                                autocomplete="one-time-code"
                                autofocus
                            />

                            <x-admin::form.control-group.error control-name="code" />
                        </x-admin::form.control-group>
                    </div>

                    <div class="flex items-center justify-between p-4">
                        <a
                            class="cursor-pointer text-xs font-semibold leading-6 text-brandColor"
                            href="{{ route('admin.session.create') }}"
                        >
                            Return to Login
                        </a>

                        <button
                            class="primary-button"
                            aria-label="Verify Code"
                        >
                            Verify & Login
                        </button>
                    </div>
                </x-admin::form>
            </div>
        </div>
    </div>
</x-admin::layouts.anonymous>
