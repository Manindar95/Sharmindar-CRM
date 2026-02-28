<v-mega-search>
    <div class="relative flex w-[550px] max-w-[550px] items-center max-lg:w-[400px] ltr:ml-2.5 rtl:mr-2.5">
        <i class="icon-search absolute top-2 flex items-center text-2xl ltr:left-3 rtl:right-3"></i>

        <input
            type="text"
            class="block w-full rounded-3xl border bg-white px-10 py-1.5 leading-6 text-gray-600 transition-all hover:border-gray-400 focus:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300 dark:hover:border-gray-400 dark:focus:border-gray-400"
            placeholder="@lang('admin::app.components.layouts.header.mega-search.title')"
        >
    </div>
</v-mega-search>

@pushOnce('scripts')
    <script
        type="text/x-template"
        id="v-mega-search-template"
    >
        <div class="relative flex w-[550px] max-w-[550px] items-center max-lg:w-[400px] ltr:ml-2.5 rtl:mr-2.5">
            <i class="icon-search absolute top-2 flex items-center text-2xl ltr:left-3 rtl:right-3"></i>

            <input
                type="text"
                class="peer block w-full rounded-3xl border bg-white px-10 py-1.5 leading-6 text-gray-600 transition-all hover:border-gray-400 focus:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300 dark:hover:border-gray-400 dark:focus:border-gray-400"
                :class="{'border-gray-400': isDropdownOpen}"
                placeholder="@lang('admin::app.components.layouts.header.mega-search.title')"
                v-model.lazy="searchTerm"
                @click="searchTerm.length >= 2 ? isDropdownOpen = true : {}"
                v-debounce="500"
            >

            <div
                class="absolute top-10 z-10 w-full rounded-lg border bg-white shadow-[0px_0px_0px_0px_rgba(0,0,0,0.10),0px_1px_3px_0px_rgba(0,0,0,0.10),0px_5px_5px_0px_rgba(0,0,0,0.09),0px_12px_7px_0px_rgba(0,0,0,0.05),0px_22px_9px_0px_rgba(0,0,0,0.01),0px_34px_9px_0px_rgba(0,0,0,0.00)] dark:border-gray-800 dark:bg-gray-900"
                v-if="isDropdownOpen"
            >
                <!-- Search Tabs -->
                <div class="flex overflow-x-auto border-b text-sm text-gray-600 dark:border-gray-800 dark:text-gray-300">
                    <div
                        class="cursor-pointer p-4 hover:bg-gray-100 dark:hover:bg-gray-950"
                        :class="{ 'border-b-2 border-brandColor': activeTab == tab.key }"
                        v-for="tab in tabs"
                        @click="activeTab = tab.key; search();"
                    >
                        @{{ tab.title }}
                    </div>
                </div>

                <!-- Searched Results -->
                <template v-if="activeTab == 'products'">
                    <template v-if="isLoading">
                        <x-admin::shimmer.header.mega-search.products />
                    </template>

                    <template v-else>
                        <div class="grid max-h-[400px] overflow-y-auto">
                            <template v-for="product in searchedResults.products">
                                <a
                                    :href="'{{ route('admin.products.view', ':id') }}'.replace(':id', product.id)"
                                    class="flex cursor-pointer justify-between gap-2.5 border-b border-slate-300 p-4 last:border-b-0 hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-gray-950"
                                >
                                    <!-- Left Information -->
                                    <div class="flex gap-2.5">
                                        <!-- Details -->
                                        <div class="grid place-content-start gap-1.5">
                                            <p class="text-base font-semibold text-gray-600 dark:text-gray-300">
                                                @{{ product.name }}
                                            </p>

                                            <p class="text-gray-500">
                                                @{{ "@lang(':sku')".replace(':sku', product.sku) }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Right Information -->
                                    <div class="grid place-content-center gap-1 text-right">
                                        <!-- Formatted Price -->
                                        <p class="font-semibold text-gray-600 dark:text-gray-300">
                                            @{{ $admin.formatPrice(product.price) }}
                                        </p>
                                    </div>
                                </a>
                            </template>

                        </div>

                        <div class="flex border-t p-3 dark:border-gray-800">
                            <template v-if="searchedResults.products.length">
                                <a
                                    :href="'{{ route('admin.products.index') }}?search=:query'.replace(':query', searchTerm)"
                                    class="cursor-pointer text-xs font-semibold text-brandColor transition-all hover:underline"
                                >

                                    @{{ `@lang('admin::app.components.layouts.header.mega-search.explore-all-matching-products')`.replace(':query', searchTerm).replace(':count', searchedResults.products.length) }}
                                </a>
                            </template>

                            <template v-else>
                                <a
                                    href="{{ route('admin.products.index') }}"
                                    class="cursor-pointer text-xs font-semibold text-brandColor transition-all hover:underline"
                                >
                                    @lang('admin::app.components.layouts.header.mega-search.explore-all-products')
                                </a>
                            </template>
                        </div>
                    </template>
                </template>

                <template v-if="activeTab == 'leads'">
                    <template v-if="isLoading">
                        <x-admin::shimmer.header.mega-search.leads />
                    </template>

                    <template v-else>
                        <div class="grid max-h-[400px] overflow-y-auto">
                            <template v-for="lead in searchedResults.leads">
                                <a
                                    :href="'{{ route('admin.leads.view', ':id') }}'.replace(':id', lead.id)"
                                    class="flex cursor-pointer justify-between gap-2.5 border-b border-slate-300 p-4 last:border-b-0 hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-gray-950"
                                >
                                    <!-- Left Information -->
                                    <div class="flex gap-2.5">
                                        <!-- Details -->
                                        <div class="grid place-content-start gap-1.5">
                                            <p class="text-base font-semibold text-gray-600 dark:text-gray-300">
                                                @{{ lead.title }}
                                            </p>

                                            <p class="text-gray-500">
                                                @{{ lead.description }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Right Information -->
                                    <div class="grid place-content-center gap-1 text-right">
                                        <!-- Formatted Price -->
                                        <p class="font-semibold text-gray-600 dark:text-gray-300">
                                            @{{ $admin.formatPrice(lead.lead_value) }}
                                        </p>
                                    </div>
                                </a>
                            </template>
                        </div>

                        <div class="flex border-t p-3 dark:border-gray-800">
                            <template v-if="searchedResults.leads.length">
                                <a
                                    :href="'{{ route('admin.leads.index') }}?search=:query'.replace(':query', searchTerm)"
                                    class="cursor-pointer text-xs font-semibold text-brandColor transition-all hover:underline"
                                >
                                    @{{ `@lang('admin::app.components.layouts.header.mega-search.explore-all-matching-leads')`.replace(':query', searchTerm).replace(':count', searchedResults.leads.length) }}
                                </a>
                            </template>

                            <template v-else>
                                <a
                                    href="{{ route('admin.leads.index') }}"
                                    class="cursor-pointer text-xs font-semibold text-brandColor transition-all hover:underline"
                                >
                                    @lang('admin::app.components.layouts.header.mega-search.explore-all-leads')
                                </a>
                            </template>
                        </div>
                    </template>
                </template>

                <template v-if="activeTab == 'persons'">
                    <template v-if="isLoading">
                        <x-admin::shimmer.header.mega-search.persons />
                    </template>

                    <template v-else>
                        <div class="grid max-h-[400px] overflow-y-auto">
                            <template v-for="person in searchedResults.persons">
                                <a
                                    :href="'{{ route('admin.contacts.persons.view', ':id') }}'.replace(':id', person.id)"
                                    class="flex cursor-pointer justify-between gap-2.5 border-b border-slate-300 p-4 last:border-b-0 hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-gray-950"
                                >
                                    <!-- Left Information -->
                                    <div class="flex gap-2.5">
                                        <!-- Details -->
                                        <div class="grid place-content-start gap-1.5">
                                            <p class="text-base font-semibold text-gray-600 dark:text-gray-300">
                                                @{{ person.name }}
                                            </p>

                                            <p class="text-gray-500">
                                                @{{ person.emails.map((item) => `${item.value}(${item.label})`).join(', ') }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </template>
                        </div>

                        <div class="flex border-t p-3 dark:border-gray-800">
                            <template v-if="searchedResults.persons.length">
                                <a
                                    :href="'{{ route('admin.contacts.persons.index') }}?search=:query'.replace(':query', searchTerm)"
                                    class="cursor-pointer text-xs font-semibold text-brandColor transition-all hover:underline"
                                >
                                    @{{ `@lang('admin::app.components.layouts.header.mega-search.explore-all-matching-contacts')`.replace(':query', searchTerm).replace(':count', searchedResults.persons.length) }}
                                </a>
                            </template>

                            <template v-else>
                                <a
                                    href="{{ route('admin.contacts.persons.index') }}"
                                    class="cursor-pointer text-xs font-semibold text-brandColor transition-all hover:underline"
                                >
                                    @lang('admin::app.components.layouts.header.mega-search.explore-all-contacts')
                                </a>
                            </template>
                        </div>
                    </template>
                </template>

                <template v-if="activeTab == 'quotes'">
                    <template v-if="isLoading">
                        <x-admin::shimmer.header.mega-search.quotes />
                    </template>

                    <template v-else>
                        <div class="grid max-h-[400px] overflow-y-auto">
                            <template v-for="quote in searchedResults.quotes">
                                <a
                                    :href="'{{ route('admin.quotes.edit', ':id') }}'.replace(':id', quote.id)"
                                    class="flex cursor-pointer justify-between gap-2.5 border-b border-slate-300 p-4 last:border-b-0 hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-gray-950"
                                >
                                    <!-- Left Information -->
                                    <div class="flex gap-2.5">
                                        <!-- Details -->
                                        <div class="grid place-content-start gap-1.5">
                                            <p class="text-base font-semibold text-gray-600 dark:text-gray-300">
                                                @{{ quote.subject }}
                                            </p>

                                            <p class="text-gray-500">
                                                @{{ quote.description }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </template>
                        </div>

                        <div class="flex border-t p-3 dark:border-gray-800">
                            <template v-if="searchedResults.quotes.length">
                                <a
                                    :href="'{{ route('admin.quotes.index') }}?search=:query'.replace(':query', searchTerm)"
                                    class="cursor-pointer text-xs font-semibold text-brandColor transition-all hover:underline"
                                >
                                    @{{ `@lang('admin::app.components.layouts.header.mega-search.explore-all-matching-quotes')`.replace(':query', searchTerm).replace(':count', searchedResults.quotes.length) }}
                                </a>
                            </template>

                            <template v-else>
                                <a
                                    href="{{ route('admin.quotes.index') }}"
                                    class="cursor-pointer text-xs font-semibold text-brandColor transition-all hover:underline"
                                >
                                    @lang('admin::app.components.layouts.header.mega-search.explore-all-quotes')
                                </a>
                            </template>
                        </div>
                    </template>
                </template>

                <template v-if="activeTab == 'settings'">
                    <template v-if="isLoading">
                        <x-admin::shimmer.header.mega-search.settings />
                    </template>

                    <template v-else>
                        <div class="grid max-h-[400px] overflow-y-auto">
                            <template v-for="setting in searchedResults.settings">
                                <a
                                    :href="setting.url"
                                    class="flex cursor-pointer justify-between gap-2.5 border-b border-slate-300 p-4 last:border-b-0 hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-gray-950"
                                >
                                    <!-- Left Information -->
                                    <div class="flex gap-2.5">
                                        <!-- Details -->
                                        <div class="grid place-content-start gap-1.5">
                                            <p class="text-base font-semibold text-gray-600 dark:text-gray-300">
                                                @{{ setting.name }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </template>
                        </div>

                        <template v-if="! searchedResults.settings.length">
                            <div class="flex border-t p-3 dark:border-gray-800">
                                <a
                                    href="{{ route('admin.settings.index') }}"
                                    class="cursor-pointer text-xs font-semibold text-brandColor transition-all hover:underline"
                                >
                                    @lang('admin::app.components.layouts.header.mega-search.explore-all-settings')
                                </a>
                            </div>
                        </template>
                    </template>
                </template>

                <template v-if="activeTab == 'configurations'">
                    <template v-if="isLoading">
                        <x-admin::shimmer.header.mega-search.configurations />
                    </template>

                    <template v-else>
                        <div class="grid max-h-[400px] overflow-y-auto">
                            <template v-for="configuration in searchedResults.configurations">
                                <a
                                    :href="configuration.url"
                                    class="flex cursor-pointer justify-between gap-2.5 border-b border-slate-300 p-4 last:border-b-0 hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-gray-950"
                                >
                                    <div class="flex gap-2.5">
                                        <div class="grid place-content-start gap-1.5">
                                            <p class="text-base font-semibold text-gray-600 dark:text-gray-300">
                                                @{{ configuration.title }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </template>
                        </div>

                        <template v-if="! searchedResults.configurations.length">
                            <div class="flex border-t p-3 dark:border-gray-800">
                                <a
                                    href="{{ route('admin.configuration.index') }}"
                                    class="cursor-pointer text-xs font-semibold text-brandColor transition-all hover:underline"
                                >
                                    @lang('admin::app.components.layouts.header.mega-search.explore-all-configurations')
                                </a>
                            </div>
                        </template>
                    </template>
                </template>

                <!-- Users Tab -->
                <template v-if="activeTab == 'users'">
                    <template v-if="isLoading">
                        <div class="p-4 text-center text-gray-500">Loading...</div>
                    </template>
                    <template v-else>
                        <div class="grid max-h-[400px] overflow-y-auto">
                            <template v-for="user in searchedResults.users">
                                <div class="flex cursor-pointer justify-between gap-2.5 border-b border-slate-300 p-4 last:border-b-0 hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-gray-950">
                                    <div class="flex gap-2.5">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-brandColor/10 text-brandColor font-bold">
                                            @{{ user.name?.charAt(0).toUpperCase() }}
                                        </div>
                                        <div class="grid place-content-start gap-0.5">
                                            <p class="text-base font-semibold text-gray-600 dark:text-gray-300">@{{ user.name }}</p>
                                            <p class="text-gray-500 text-xs">@{{ user.email }}</p>
                                        </div>
                                    </div>
                                    <div class="grid place-content-center">
                                        <span :class="user.status ? 'text-green-600' : 'text-red-500'" class="text-xs font-semibold">
                                            @{{ user.status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div class="flex border-t p-3 dark:border-gray-800" v-if="! searchedResults.users.length">
                            <span class="text-xs text-gray-500">No users found matching your search.</span>
                        </div>
                    </template>
                </template>

                <!-- Projects Tab -->
                <template v-if="activeTab == 'projects'">
                    <template v-if="isLoading">
                        <div class="p-4 text-center text-gray-500">Loading...</div>
                    </template>
                    <template v-else>
                        <div class="grid max-h-[400px] overflow-y-auto">
                            <template v-for="project in searchedResults.projects">
                                <a
                                    :href="'{{ route('admin.projects.edit', ':id') }}'.replace(':id', project.id)"
                                    class="flex cursor-pointer justify-between gap-2.5 border-b border-slate-300 p-4 last:border-b-0 hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-gray-950"
                                >
                                    <div class="flex gap-2.5">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300">
                                            <i class="icon-projects text-xl"></i>
                                        </div>
                                        <div class="grid place-content-start gap-0.5">
                                            <p class="text-base font-semibold text-gray-600 dark:text-gray-300">@{{ project.name }}</p>
                                            <p class="text-gray-500 text-xs truncate max-w-[300px]">@{{ project.description || 'No description' }}</p>
                                        </div>
                                    </div>
                                    <div class="grid place-content-center">
                                        <span class="rounded-full px-2 py-0.5 text-xs font-semibold" :class="{
                                            'bg-green-100 text-green-700': project.status === 'completed',
                                            'bg-blue-100 text-blue-700': project.status === 'in_progress',
                                            'bg-yellow-100 text-yellow-700': project.status === 'on_hold',
                                            'bg-gray-100 text-gray-600': project.status === 'not_started',
                                        }">
                                            @{{ project.status?.replace('_', ' ') }}
                                        </span>
                                    </div>
                                </a>
                            </template>
                        </div>
                        <div class="flex border-t p-3 dark:border-gray-800">
                            <a href="{{ route('admin.projects.index') }}" class="cursor-pointer text-xs font-semibold text-brandColor transition-all hover:underline">
                                Explore All Projects
                            </a>
                        </div>
                    </template>
                </template>

                <!-- Tasks Tab -->
                <template v-if="activeTab == 'tasks'">
                    <template v-if="isLoading">
                        <div class="p-4 text-center text-gray-500">Loading...</div>
                    </template>
                    <template v-else>
                        <div class="grid max-h-[400px] overflow-y-auto">
                            <template v-for="task in searchedResults.tasks">
                                <a
                                    :href="'{{ route('admin.tasks.edit', ':id') }}'.replace(':id', task.id)"
                                    class="flex cursor-pointer justify-between gap-2.5 border-b border-slate-300 p-4 last:border-b-0 hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-gray-950"
                                >
                                    <div class="flex gap-2.5">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-purple-100 text-purple-600 dark:bg-purple-900 dark:text-purple-300">
                                            <i class="icon-activities text-xl"></i>
                                        </div>
                                        <div class="grid place-content-start gap-0.5">
                                            <p class="text-base font-semibold text-gray-600 dark:text-gray-300">@{{ task.title }}</p>
                                            <p class="text-gray-500 text-xs truncate max-w-[300px]">@{{ task.description || 'No description' }}</p>
                                        </div>
                                    </div>
                                    <div class="grid place-content-center gap-1">
                                        <span class="rounded-full px-2 py-0.5 text-xs font-semibold" :class="{
                                            'bg-green-100 text-green-700': task.status === 'completed',
                                            'bg-blue-100 text-blue-700': task.status === 'in_progress',
                                            'bg-yellow-100 text-yellow-700': task.status === 'pending',
                                        }">
                                            @{{ task.status?.replace('_', ' ') }}
                                        </span>
                                        <span class="text-xs text-gray-400 text-right">@{{ task.priority }}</span>
                                    </div>
                                </a>
                            </template>
                        </div>
                        <div class="flex border-t p-3 dark:border-gray-800">
                            <a href="{{ route('admin.tasks.index') }}" class="cursor-pointer text-xs font-semibold text-brandColor transition-all hover:underline">
                                Explore All Tasks
                            </a>
                        </div>
                    </template>
                </template>

                <!-- Clients Tab -->
                <template v-if="activeTab == 'clients'">
                    <template v-if="isLoading">
                        <div class="p-4 text-center text-gray-500">Loading...</div>
                    </template>
                    <template v-else>
                        <div class="grid max-h-[400px] overflow-y-auto">
                            <template v-for="client in searchedResults.clients">
                                <a
                                    :href="'{{ route('admin.contacts.organizations.edit', ':id') }}'.replace(':id', client.id)"
                                    class="flex cursor-pointer justify-between gap-2.5 border-b border-slate-300 p-4 last:border-b-0 hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-gray-950"
                                >
                                    <div class="flex gap-2.5">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 dark:bg-emerald-900 dark:text-emerald-300">
                                            <i class="icon-organization text-xl"></i>
                                        </div>
                                        <div class="grid place-content-start gap-0.5">
                                            <p class="text-base font-semibold text-gray-600 dark:text-gray-300">@{{ client.name }}</p>
                                            <p class="text-gray-500 text-xs truncate max-w-[300px]">@{{ client.address || 'No address' }}</p>
                                        </div>
                                    </div>
                                </a>
                            </template>
                        </div>
                        <div class="flex border-t p-3 dark:border-gray-800">
                            <a href="{{ route('admin.contacts.organizations.index') }}" class="cursor-pointer text-xs font-semibold text-brandColor transition-all hover:underline">
                                Explore All Clients
                            </a>
                        </div>
                    </template>
                </template>
            </div>
        </div>
    </script>

    <script type="module">
        app.component('v-mega-search', {
            template: '#v-mega-search-template',

            data() {
                return  {
                    activeTab: 'leads',

                    isDropdownOpen: false,

                    tabs: {
                        leads: {
                            key: 'leads',
                            title: '@lang('admin::app.components.layouts.header.mega-search.tabs.leads')',
                            is_active: true,
                            endpoint: '{{ route('admin.leads.search') }}',
                            query_params: [
                                {
                                    search: 'title',
                                    searchFields: 'title:like',
                                },
                                {
                                    search: 'user.name',
                                    searchFields: 'user.name:like',
                                },
                                {
                                    search: 'person.name',
                                    searchFields: 'person.name:like',
                                },
                            ],
                        },

                        quotes: {
                            key: 'quotes',
                            title: '@lang('admin::app.components.layouts.header.mega-search.tabs.quotes')',
                            is_active: false,
                            endpoint: '{{ route('admin.quotes.search') }}',
                            query_params: [
                                {
                                    search: 'subject',
                                    searchFields: 'subject:like',
                                },
                                {
                                    search: 'description',
                                    searchFields: 'description:like',
                                },
                                {
                                    search: 'user.name',
                                    searchFields: 'user.name:like',
                                },
                                {
                                    search: 'person.name',
                                    searchFields: 'person.name:like',
                                },
                            ],
                        },

                        products: {
                            key: 'products',
                            title: '@lang('admin::app.components.layouts.header.mega-search.tabs.products')',
                            is_active: false,
                            endpoint: '{{ route('admin.products.search') }}',
                            query_params: [
                                {
                                    search: 'name',
                                    searchFields: 'name:like',
                                },
                                {
                                    search: 'sku',
                                    searchFields: 'sku:like',
                                },
                                {
                                    search: 'description',
                                    searchFields: 'description:like',
                                },
                            ],
                        },

                        persons: {
                            key: 'persons',
                            title: '@lang('admin::app.components.layouts.header.mega-search.tabs.persons')',
                            is_active: false,
                            endpoint: '{{ route('admin.contacts.persons.search') }}',
                            query_params: [
                                {
                                    search: 'name',
                                    searchFields: 'name:like',
                                },
                                {
                                    search: 'job_title',
                                    searchFields: 'job_title:like',
                                },
                                {
                                    search: 'user.name',
                                    searchFields: 'user.name:like',
                                },
                                {
                                    search: 'organization.name',
                                    searchFields: 'organization.name:like',
                                },
                            ],
                        },

                        settings: {
                            key: 'settings',
                            title: '@lang('Settings')',
                            is_active: false,
                            endpoint: '{{ route('admin.settings.search') }}',
                            query: '',
                        },

                        configurations: {
                            key: 'configurations',
                            title: '@lang('Configurations')',
                            is_active: false,
                            endpoint: '{{ route('admin.configuration.search') }}',
                            query: '',
                        },

                        users: {
                            key: 'users',
                            title: 'Users',
                            is_active: false,
                            endpoint: '{{ route('admin.global_search.users') }}',
                            query: '',
                        },

                        projects: {
                            key: 'projects',
                            title: 'Projects',
                            is_active: false,
                            endpoint: '{{ route('admin.global_search.projects') }}',
                            query: '',
                        },

                        tasks: {
                            key: 'tasks',
                            title: 'Tasks',
                            is_active: false,
                            endpoint: '{{ route('admin.global_search.tasks') }}',
                            query: '',
                        },

                        clients: {
                            key: 'clients',
                            title: 'Clients',
                            is_active: false,
                            endpoint: '{{ route('admin.global_search.clients') }}',
                            query: '',
                        },
                    },

                    isLoading: false,

                    searchTerm: '',

                    searchedResults: {
                        leads: [],
                        quotes: [],
                        products: [],
                        persons: [],
                        settings: [],
                        configurations: [],
                        users: [],
                        projects: [],
                        tasks: [],
                        clients: [],
                    },

                    params: {
                        search: '',
                        searchFields: '',
                    },
                };
            },

            watch: {
                searchTerm: 'updateSearchParams',

                activeTab: 'updateSearchParams',
            },

            created() {
                window.addEventListener('click', this.handleFocusOut);
            },

            beforeDestroy() {
                window.removeEventListener('click', this.handleFocusOut);
            },

            methods: {
                search(endpoint = null) {
                    if (! endpoint) {
                        return;
                    }

                    if (this.searchTerm.length <= 1) {
                        this.searchedResults[this.activeTab] = [];

                        this.isDropdownOpen = false;

                        return;
                    }

                    this.isDropdownOpen = true;

                    this.$axios.get(endpoint, {
                            params: {
                                ...this.params,
                            },
                        })
                        .then((response) => {
                            this.searchedResults[this.activeTab] = response.data.data;
                        })
                        .catch((error) => {})
                        .finally(() => this.isLoading = false);
                },

                handleFocusOut(e) {
                    if (! this.$el.contains(e.target)) {
                        this.isDropdownOpen = false;
                    }
                },

                updateSearchParams() {
                    const newTerm = this.searchTerm;

                    this.params = {
                        search: '',
                        searchFields: '',
                    };

                    const tab = this.tabs[this.activeTab];

                    if (
                        tab.key === 'settings'
                        || tab.key === 'configurations'
                    ) {
                        this.params = null;

                        this.search(`${tab.endpoint}?query=${newTerm}`);

                        return;
                    }

                    if (
                        tab.key === 'users'
                        || tab.key === 'projects'
                        || tab.key === 'tasks'
                        || tab.key === 'clients'
                    ) {
                        this.params = null;

                        this.search(`${tab.endpoint}?search=${newTerm}`);

                        return;
                    }

                    this.params.search += tab.query_params.map((param) => `${param.search}:${newTerm};`).join('');

                    this.params.searchFields += tab.query_params.map((param) => `${param.searchFields};`).join('');

                    this.search(tab.endpoint);
                },
            },
        });
    </script>
@endPushOnce
