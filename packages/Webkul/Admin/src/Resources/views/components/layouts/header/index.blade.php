<header class="sticky top-0 z-[10001] flex items-center justify-between gap-1 border-b border-gray-200 bg-white px-4 py-2.5 transition-all dark:border-gray-800 dark:bg-gray-900">  
    <!-- logo -->
    <div class="flex items-center gap-1.5">
        <!-- Sidebar Menu -->
        <x-admin::layouts.sidebar.mobile />
        
        <a href="{{ route('admin.dashboard.index') }}">
            @if ($logo = core()->getConfigData('general.general.admin_logo.logo_image'))
                <img
                    class="h-10"
                    src="{{ Storage::url($logo) }}"
                    alt="{{ config('app.name') }}"
                />
            @else
                <img
                    class="h-10"
                    src="{{ asset('Sharmindar-CRM_logo-name.png') }}"
                    id="logo-image"
                    alt="{{ config('app.name') }}"
                />
            @endif
        </a>
    </div>

    <div class="flex items-center gap-1.5 max-md:hidden">
        <!-- Mega Search Bar -->
        @include('admin::components.layouts.header.desktop.mega-search')

        <!-- Quick Creation Bar -->
        @include('admin::components.layouts.header.quick-creation')
    </div>

    <div class="flex items-center gap-2.5">
        <div class="md:hidden">
            <!-- Mega Search Bar -->
            @include('admin::components.layouts.header.mobile.mega-search')
        </div>
        
        <!-- Notifications -->
        <v-notifications>
            <div class="flex">
                <span class="icon-notification p-1.5 rounded-md text-2xl cursor-pointer transition-all hover:bg-gray-100 dark:hover:bg-gray-950"></span>
            </div>
        </v-notifications>

        <!-- Dark mode -->
        <v-dark>
            <div class="flex">
                <span
                    class="{{ request()->cookie('dark_mode') ? 'icon-light' : 'icon-dark' }} p-1.5 rounded-md text-2xl cursor-pointer transition-all hover:bg-gray-100 dark:hover:bg-gray-950"
                ></span>
            </div>
        </v-dark>

        <div class="md:hidden">
            <!-- Quick Creation Bar -->
            @include('admin::components.layouts.header.quick-creation')
        </div>
        
        <!-- Admin profile -->
        <x-admin::dropdown position="bottom-{{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'left' : 'right' }}">
            <x-slot:toggle>
                @php($user = auth()->guard('user')->user())

                @if ($user->image)
                    <button class="flex h-9 w-9 cursor-pointer overflow-hidden rounded-full hover:opacity-80 focus:opacity-80">
                        <img
                            src="{{ $user->image_url }}"
                            class="h-full w-full object-cover"
                        />
                    </button>
                @else
                    <button class="flex h-9 w-9 cursor-pointer items-center justify-center rounded-full bg-pink-400 font-semibold leading-6 text-white">
                        {{ substr($user->name, 0, 1) }}
                    </button>
                @endif
            </x-slot>

            <!-- Admin Dropdown -->
            <x-slot:content class="mt-2 border-t-0 !p-0">
                <div class="flex items-center gap-1.5 border border-x-0 border-b-gray-300 px-5 py-2.5 dark:border-gray-800">
                    <img
                        src="{{ url('cache/logo.png') }}"
                        width="24"
                        height="24"
                    />

                    <!-- Version -->
                    <p class="text-gray-400">
                        @lang('admin::app.layouts.app-version', ['version' => core()->version()])
                    </p>
                </div>

                <div class="grid gap-1 pb-2.5">
                    <a
                        class="cursor-pointer px-5 py-2 text-base text-gray-800 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-950"
                        href="{{ route('admin.user.account.edit') }}"
                    >
                        @lang('admin::app.layouts.my-account')
                    </a>

                    <!--Admin logout-->
                    <x-admin::form
                        method="DELETE"
                        action="{{ route('admin.session.destroy') }}"
                        id="adminLogout"
                    >
                    </x-admin::form>

                    <a
                        class="cursor-pointer px-5 py-2 text-base text-gray-800 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-950"
                        href="{{ route('admin.session.destroy') }}"
                        onclick="event.preventDefault(); document.getElementById('adminLogout').submit();"
                    >
                        @lang('admin::app.layouts.sign-out')
                    </a>
                </div>
            </x-slot>
        </x-admin::dropdown>
    </div>
</header>

@pushOnce('scripts')
    <script
        type="text/x-template"
        id="v-dark-template"
    >
        <div class="flex">
            <span
                class="cursor-pointer rounded-md p-1.5 text-2xl transition-all hover:bg-gray-100 dark:hover:bg-gray-950"
                :class="[isDarkMode ? 'icon-light' : 'icon-dark']"
                @click="toggle"
            ></span>
        </div>
    </script>

    <script type="module">
    <script
        type="text/x-template"
        id="v-notifications-template"
    >
        <x-admin::dropdown position="bottom-{{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'left' : 'right' }}">
            <x-slot:toggle>
                <div class="flex relative">
                    <span
                        class="icon-notification p-1.5 rounded-md text-2xl cursor-pointer transition-all hover:bg-gray-100 dark:hover:bg-gray-950"
                    ></span>

                    <span
                        class="absolute top-1 right-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-600 text-[10px] text-white"
                        v-if="unreadCount"
                    >
                        @{{ unreadCount }}
                    </span>
                </div>
            </x-slot>

            <x-slot:content class="mt-2 border-t-0 !p-0 min-w-[300px]">
                <div class="flex items-center justify-between border-b border-gray-200 p-4 dark:border-gray-800">
                    <p class="text-sm font-bold text-gray-800 dark:text-white">
                        @lang('admin::app.notifications.title')
                    </p>

                    <span
                        class="cursor-pointer text-xs text-brandColor hover:underline"
                        v-if="unreadCount"
                        @click="markAllRead"
                    >
                        @lang('admin::app.notifications.mark-all-read')
                    </span>
                </div>

                <div class="grid max-h-[400px] overflow-y-auto">
                    <template v-if="notifications.length">
                        <div
                            class="flex flex-col gap-1 border-b border-gray-100 p-4 last:border-0 dark:border-gray-800 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-950"
                            v-for="notification in notifications"
                            @click="redirect(notification)"
                        >
                            <p class="text-xs font-bold text-gray-800 dark:text-white">
                                @{{ notification.data.title }}
                            </p>

                            <p class="text-xs text-gray-500">
                                @{{ notification.data.message }}
                            </p>

                            <p class="text-[10px] text-gray-400">
                                @{{ notification.created_at_relative }}
                            </p>
                        </div>
                    </template>

                    <template v-else>
                        <div class="p-8 text-center text-gray-500">
                            @lang('admin::app.notifications.no-record')
                        </div>
                    </template>
                </div>

                <div class="border-t border-gray-200 p-3 text-center dark:border-gray-800">
                    <a
                        :href="allNotificationUrl"
                        class="text-xs font-bold text-brandColor hover:underline"
                    >
                        @lang('admin::app.notifications.view-all')
                    </a>
                </div>
            </x-slot>
        </x-admin::dropdown>
    </script>

    <script type="module">
        app.component('v-notifications', {
            template: '#v-notifications-template',

            data() {
                return {
                    notifications: [],

                    unreadCount: 0,

                    allNotificationUrl: '',
                };
            },

            created() {
                this.getNotifications();

                // Poll every 30 seconds
                setInterval(() => {
                    this.getNotifications();
                }, 30000);
            },

            methods: {
                getNotifications() {
                    this.$axios.get("{{ route('admin.settings.notifications.get') }}", {
                        params: { limit: 5 }
                    })
                        .then(response => {
                            this.notifications = response.data.data.notifications;
                            this.unreadCount = response.data.data.unread_count;
                            this.allNotificationUrl = response.data.data.all_notification;
                        })
                        .catch(error => {});
                },

                markAllRead() {
                    this.$axios.post("{{ route('admin.settings.notifications.mark_all_read') }}")
                        .then(response => {
                            this.unreadCount = 0;
                            this.notifications.forEach(notification => {
                                notification.read_at = new Date().toISOString();
                            });
                        })
                        .catch(error => {});
                },

                redirect(notification) {
                    // Placeholder for redirect logic based on type
                    window.location.href = "{{ route('admin.settings.notifications.index') }}";
                }
            },
        });

        app.component('v-dark', {
            template: '#v-dark-template',

            data() {
                return {
                    isDarkMode: {{ request()->cookie('dark_mode') ?? 0 }},

                    logo: "{{ asset('Sharmindar-CRM_logo-name.png') }}",

                    dark_logo: "{{ asset('Sharmindar-CRM_logo-name.png') }}",
                };
            },

            methods: {
                toggle() {
                    this.isDarkMode = parseInt(this.isDarkModeCookie()) ? 0 : 1;

                    var expiryDate = new Date();

                    expiryDate.setMonth(expiryDate.getMonth() + 1);

                    document.cookie = 'dark_mode=' + this.isDarkMode + '; path=/; expires=' + expiryDate.toGMTString();

                    document.documentElement.classList.toggle('dark', this.isDarkMode === 1);

                    if (this.isDarkMode) {
                        this.$emitter.emit('change-theme', 'dark');

                        document.getElementById('logo-image').src = this.dark_logo;
                    } else {
                        this.$emitter.emit('change-theme', 'light');

                        document.getElementById('logo-image').src = this.logo;
                    }
                },

                isDarkModeCookie() {
                    const cookies = document.cookie.split(';');

                    for (const cookie of cookies) {
                        const [name, value] = cookie.trim().split('=');

                        if (name === 'dark_mode') {
                            return value;
                        }
                    }

                    return 0;
                },
            },
        });
    </script>
@endPushOnce
