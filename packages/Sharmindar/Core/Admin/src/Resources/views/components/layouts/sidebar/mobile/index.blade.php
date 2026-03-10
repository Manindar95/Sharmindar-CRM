<v-sidebar-drawer>
    <i class="icon-menu lg:hidden cursor-pointer rounded-md p-1.5 text-2xl hover:bg-gray-100 dark:hover:bg-gray-950 max-lg:block"></i>
</v-sidebar-drawer>

@pushOnce('scripts')
    <script
        type="text/x-template"
        id="v-sidebar-drawer-template"
    >
        <x-admin::drawer
            position="left"
            width="280px"
            class="lg:hidden [&>:nth-child(3)]:!m-0 [&>:nth-child(3)]:!rounded-l-none [&>:nth-child(3)]:max-sm:!w-[80%]"
        >
            <x-slot:toggle>
                <i class="icon-menu lg:hidden cursor-pointer rounded-md p-1.5 text-2xl hover:bg-gray-100 dark:hover:bg-gray-950 max-lg:block"></i>
            </x-slot>

            <x-slot:header>
                @if ($logo = core()->getConfigData('general.design.admin_logo.logo_image'))
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
            </x-slot>

            <x-slot:content class="p-4">
                <div class="journal-scroll h-[calc(100vh-100px)] overflow-auto">
                    <nav class="grid w-full gap-1">
                        @php
                            $lastGroup       = null;
                            $sysAdminGroups  = ['System Administration'];
                        @endphp

                        @foreach (menu()->getItems('admin') as $menuItem)
                            @php
                                $menuKey        = $menuItem->getKey();
                                /* Skip child items in the top-level loop to avoid double-rendering */
                                if (str_contains($menuKey, '.')) continue;

                                $hasActiveChild = $menuItem->haveChildren() && collect($menuItem->getChildren())->contains(fn($child) => $child->isActive());
                                $isMenuActive   = $menuItem->isActive() == 'active' || $hasActiveChild;
                                $currentGroup   = $menuItem->getGroup();
                                $isSysAdmin     = in_array($currentGroup, $sysAdminGroups);
                            @endphp

                            {{-- Separator before System Administration --}}
                            @if ($isSysAdmin && $lastGroup !== $currentGroup)
                                <div class="my-2 border-t border-gray-200 dark:border-gray-700"></div>
                            @endif

                            {{-- Department Group Label --}}
                            @if ($currentGroup && $currentGroup !== $lastGroup)
                                <div class="px-2 pb-1 pt-2">
                                    <p class="text-[10px] font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">
                                        {{ $currentGroup }}
                                    </p>
                                </div>
                                @php $lastGroup = $currentGroup; @endphp
                            @endif

                            <div
                                class="menu-item relative"
                                data-menu-key="{{ $menuKey }}"
                            >
                                <a
                                    href="{{ ! in_array($menuItem->getKey(), ['settings', 'configuration']) && $menuItem->haveChildren() ? 'javascript:void(0)' : $menuItem->getUrl() }}"
                                    class="menu-link flex items-center justify-between rounded-lg p-2 transition-colors duration-200"
                                    @if ($menuItem->haveChildren() && !in_array($menuKey, ['settings', 'configuration']))
                                        @click.prevent="toggleMenu('{{ $menuKey }}')"
                                    @endif
                                    :class="{ 'bg-brandColor text-white': activeMenu === '{{ $menuKey }}' || {{ $isMenuActive ? 'true' : 'false' }}, 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-950': !(activeMenu === '{{ $menuKey }}' || {{ $isMenuActive ? 'true' : 'false' }}) }"
                                >
                                    <div class="flex items-center gap-3">
                                        <span class="{{ $menuItem->getIcon() }} text-2xl"></span>

                                        <p class="whitespace-nowrap font-semibold">
                                            {{ core()->getConfigData('general.settings.menu.'.$menuKey) ?? $menuItem->getName() }}
                                        </p>
                                    </div>

                                    @if ($menuItem->haveChildren())
                                        <span
                                            class="transform text-lg transition-transform duration-300"
                                            :class="{ 'rotate-180': activeMenu === '{{ $menuKey }}' }"
                                        >
                                            <i class="icon-arrow-down"></i>
                                        </span>
                                    @endif
                                </a>

                                @if ($menuItem->haveChildren() && !in_array($menuKey, ['settings', 'configuration']))
                                    <div
                                        class="submenu ml-1 mt-1 overflow-hidden transition-all duration-300"
                                        :class="{ 'max-h-[800px] mb-2': activeMenu === '{{ $menuKey }}' || {{ $hasActiveChild ? 'true' : 'false' }}, 'max-h-0': activeMenu !== '{{ $menuKey }}' && !{{ $hasActiveChild ? 'true' : 'false' }} }"
                                    >
                                        <div class="ml-4 border-l-2 border-gray-200 pl-2 dark:border-gray-700">
                                            @foreach ($menuItem->getChildren() as $subMenuItem)
                                                @php
                                                    $subActive = $subMenuItem->isActive();
                                                    $subIcon   = $subMenuItem->getIcon();
                                                @endphp
                                                <a
                                                    href="{{ $subMenuItem->getUrl() }}"
                                                    class="submenu-link flex items-center gap-2 whitespace-nowrap rounded-lg p-2 text-sm transition-colors duration-200"
                                                    :class="{ 'bg-blue-50 text-brandColor font-semibold dark:bg-gray-800': '{{ $subActive }}' === '1', 'text-gray-600 dark:text-gray-400 hover:bg-gray-50': '{{ $subActive }}' !== '1' }">
                                                    
                                                    @if($subIcon)
                                                        <span class="{{ $subIcon }} text-lg opacity-70"></span>
                                                    @endif

                                                    <span>{{ core()->getConfigData('general.settings.menu.'.$subMenuItem->getKey()) ?? $subMenuItem->getName() }}</span>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </nav>
                </div>
            </x-slot>
        </x-admin::drawer>
    </script>

    <script type="module">
        app.component('v-sidebar-drawer', {
            template: '#v-sidebar-drawer-template',

            data() {
                return { activeMenu: null };
            },

            mounted() {
                const activeElement = document.querySelector('.menu-item .menu-link.bg-brandColor');

                if (activeElement) {
                    this.activeMenu = activeElement.closest('.menu-item').getAttribute('data-menu-key');
                }
            },

            methods: {
                toggleMenu(menuKey) {
                    this.activeMenu = this.activeMenu === menuKey ? null : menuKey;
                }
            },
        });
    </script>
@endPushOnce
