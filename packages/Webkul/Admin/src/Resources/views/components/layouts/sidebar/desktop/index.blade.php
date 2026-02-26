<div
    ref="sidebar"
    class="duration-80 fixed top-[60px] z-[10002] h-full w-[200px] border-gray-200 bg-white pt-4 transition-all group-[.sidebar-collapsed]/container:w-[70px] dark:border-gray-800 dark:bg-gray-900 max-lg:hidden ltr:border-r rtl:border-l"
    @mouseover="handleMouseOver"
    @mouseleave="handleMouseLeave"
>
    <div class="journal-scroll h-[calc(100vh-100px)] overflow-hidden group-[.sidebar-collapsed]/container:overflow-visible">
        <nav class="sidebar-rounded grid w-full gap-2">
            <!-- Navigation Menu -->
            @foreach (menu()->getItems('admin') as $menuItem)
                <div class="px-4 group/item {{ $menuItem->isActive() ? 'active' : 'inactive' }}">
                    <a
                        class="flex gap-2 p-1.5 items-center cursor-pointer hover:rounded-lg {{ $menuItem->isActive() == 'active' ? 'bg-brandColor rounded-lg text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 hover:dark:bg-gray-950 px-4' }} peer"
                        href="{{ $menuItem->haveChildren() ? 'javascript:void(0)' : $menuItem->getUrl() }}"
                        @click="hoveringMenu = (hoveringMenu == '{{$menuItem->getKey()}}' ? '' : '{{$menuItem->getKey()}}'); isMenuActive = true"
                    >
                        <span class="{{ $menuItem->getIcon() }} text-2xl {{ $menuItem->isActive() ? 'text-white' : ''}}"></span>

                        <div class="flex-1 flex justify-between items-center text-gray-600 dark:text-gray-300 font-medium whitespace-nowrap group-[.sidebar-collapsed]/container:hidden {{ $menuItem->isActive() ? 'text-white' : ''}} group">
                            <p>{{ core()->getConfigData('general.settings.menu.'.$menuItem->getKey()) ?? $menuItem->getName() }}</p>
                        
                            @if ($menuItem->haveChildren())
                                <i class="text-2xl transition-transform duration-300 {{ $menuItem->isActive() ? 'text-white' : ''}}"
                                   :class="hoveringMenu == '{{$menuItem->getKey()}}' ? 'icon-arrow-up' : 'icon-arrow-down'"></i>
                            @endif
                        </div>
                    </a>

                    <!-- Submenu (Accordion) -->
                    @if ($menuItem->haveChildren())
                        <div
                            class="overflow-hidden transition-all duration-300 group-[.sidebar-collapsed]/container:hidden"
                            :class="hoveringMenu == '{{$menuItem->getKey()}}' ? 'max-h-[1000px] mt-1' : 'max-h-0'"
                        >
                            <nav class="grid w-full gap-1">
                                @foreach ($menuItem->getChildren() as $subMenuItem)
                                    <div class="group/item {{ $subMenuItem->isActive() ? 'active' : 'inactive' }}">
                                        <a
                                            href="{{ $subMenuItem->getUrl() }}"
                                            class="flex gap-2.5 p-2 pl-10 items-center cursor-pointer hover:rounded-lg {{ $subMenuItem->isActive() == 'active' ? 'bg-brandColor rounded-lg text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 hover:dark:bg-gray-950' }} peer"
                                        >
                                            <p class="font-medium whitespace-nowrap">
                                                {{ core()->getConfigData('general.settings.menu.'.$subMenuItem->getKey()) ?? $subMenuItem->getName() }}
                                            </p>
                                        </a>
                                    </div>
                                @endforeach
                            </nav>
                        </div>
                    @endif
                </div>
            @endforeach
        </nav>
    </div>
</div>