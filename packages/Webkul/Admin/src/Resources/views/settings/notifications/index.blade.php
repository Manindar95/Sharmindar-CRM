<x-admin::layouts>
    <x-slot:title>
        @lang('admin::app.notifications.title')
    </x-slot>

    <div class="flex items-center justify-between gap-4 max-sm:flex-wrap">
        <p class="text-xl font-bold text-gray-800 dark:text-white">
            @lang('admin::app.notifications.title')
        </p>
    </div>

    <div class="mt-7">
        <v-notification-list></v-notification-list>
    </div>

    @pushOnce('scripts')
        <script
            type="text/x-template"
            id="v-notification-list-template"
        >
            <div class="grid gap-2">
                <template v-if="notifications.length">
                    <div
                        class="flex gap-4 border-b border-gray-200 bg-white p-4 last:border-0 dark:border-gray-800 dark:bg-gray-900"
                        v-for="notification in notifications"
                    >
                        <div class="flex-1">
                            <p class="font-bold text-gray-800 dark:text-white">
                                @{{ notification.data.title }}
                            </p>

                            <p class="text-gray-500">
                                @{{ notification.data.message }}
                            </p>

                            <p class="mt-1 text-xs text-gray-400">
                                @{{ notification.created_at_relative }}
                            </p>
                        </div>

                        <div class="flex items-center gap-2">
                            <span
                                class="h-2 w-2 rounded-full bg-brandColor"
                                v-if="!notification.read_at"
                            ></span>
                        </div>
                    </div>
                </template>

                <template v-else>
                    <div class="p-8 text-center text-gray-500 bg-white dark:bg-gray-900 rounded-lg">
                        @lang('admin::app.notifications.no-record')
                    </div>
                </template>
            </div>
        </script>

        <script type="module">
            app.component('v-notification-list', {
                template: '#v-notification-list-template',

                data() {
                    return {
                        notifications: [],
                    };
                },

                created() {
                    this.getNotifications();
                },

                methods: {
                    getNotifications() {
                    this.$axios.get("{{ route('admin.settings.notifications.get') }}", {
                        params: { limit: 5 }
                    })
                            .then(response => {
                                this.notifications = response.data.data.notifications;
                            })
                            .catch(error => {});
                    },
                },
            });
        </script>
    @endPushOnce
</x-admin::layouts>
