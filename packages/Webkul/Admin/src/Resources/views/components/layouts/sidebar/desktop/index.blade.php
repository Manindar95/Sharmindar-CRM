{{--
    Desktop Sidebar — Inline Accordion Sub-menus
    Expanded:  icon + label, sub-items accordion-expand below parent with chevron
    Collapsed: icon-only, flyout tooltip panel on hover
--}}

<script>
    /* ── Sidebar toggle (collapse/expand) ──────────────────────── */
    function sidebarToggle() {
        const sidebar = document.getElementById('desktop-sidebar');
        const content = document.getElementById('main-content');
        const chevron = document.getElementById('sidebar-chevron');
        const labels  = sidebar.querySelectorAll('.sidebar-item-label, .sidebar-label');
        const isNowCollapsed = sidebar.classList.toggle('is-collapsed');

        if (isNowCollapsed) {
            labels.forEach(el => { el.style.opacity = '0'; el.style.pointerEvents = 'none'; });
            
            /* Force all sub-menus to close visually when collapsing */
            sidebar.querySelectorAll('[id^="sub-"]').forEach(p => {
                p.style.maxHeight = '0px';
                p.style.opacity   = '0';
            });
            sidebar.querySelectorAll('[id^="chev-"]').forEach(c => {
                c.style.transform = 'rotate(0deg)';
            });

            setTimeout(() => { 
                sidebar.style.width = '64px'; 
                content.style.marginLeft = '64px'; 
            }, 20);
        } else {
            sidebar.style.width = '220px'; content.style.marginLeft = '220px';
            
            /* Re-open the active sub-menu if one exists */
            setTimeout(() => {
                labels.forEach(el => { el.style.opacity = '1'; el.style.pointerEvents = ''; });
                
                const activeSub = sidebar.querySelector('.sub-menu-container .active-sub-item');
                if (activeSub) {
                    const panel = activeSub.closest('[id^="sub-"]');
                    if (panel) {
                        panel.style.maxHeight = panel.scrollHeight + 'px';
                        panel.style.opacity = '1';
                        const key = panel.id.replace('sub-', '');
                        const chev = document.getElementById('chev-' + key);
                        if (chev) chev.style.transform = 'rotate(180deg)';
                    }
                }
            }, 280);
        }

        chevron.style.transform = isNowCollapsed ? 'rotate(180deg)' : 'rotate(0deg)';
        const exp = new Date(); exp.setMonth(exp.getMonth() + 1);
        document.cookie = 'sidebar_collapsed=' + (isNowCollapsed ? '1' : '') + '; path=/; expires=' + exp.toGMTString();
    }

    function toggleSubMenu(key) {
        const sidebar = document.getElementById('desktop-sidebar');
        if (sidebar && sidebar.classList.contains('is-collapsed')) {
            /* If sidebar is collapsed, clicking an icon shouldn't trigger accordion. 
               It rely on hover flyouts instead. */
            return;
        }

        const panel   = document.getElementById('sub-' + key);
        const chevron = document.getElementById('chev-' + key);
        if (!panel) return;

        const isOpen = panel.style.maxHeight && panel.style.maxHeight !== '0px';

        if (isOpen) {
            panel.style.maxHeight = '0px';
            panel.style.opacity   = '0';
            if (chevron) chevron.style.transform = 'rotate(0deg)';
        } else {
            panel.style.maxHeight = panel.scrollHeight + 'px';
            panel.style.opacity   = '1';
            if (chevron) chevron.style.transform = 'rotate(180deg)';
        }
    }
</script>

@php
    $startCollapsed = request()->cookie('sidebar_collapsed');
    $startWidth     = $startCollapsed ? '64px' : '220px';
    $startMargin    = $startCollapsed ? '64px' : '220px';
@endphp

<style>
    /* Definitive fix: Hide all inline accordion sub-menus when the sidebar is collapsed */
    #desktop-sidebar.is-collapsed [id^="sub-"] {
        display: none !important;
    }
</style>

{{-- Push updated margin to layout --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const c = document.getElementById('main-content');
        if (c) c.style.marginLeft = '{{ $startMargin }}';
        @if($startCollapsed)
            const s = document.getElementById('desktop-sidebar');
            if (s) s.classList.add('is-collapsed');
        @endif
    });
</script>

<div
    id="desktop-sidebar"
    class="fixed top-[60px] z-[10002] h-full bg-white dark:bg-gray-900 max-lg:hidden"
    style="width: {{ $startWidth }};
           border-right: 1px solid #e5e7eb;
           transition: width 300ms cubic-bezier(0.4,0,0.2,1);"
    @mouseleave="!isMenuActive ? hoveringMenu = '' : {}"
>

    {{-- ── Floating toggle button ──────────────────────────────── --}}
    <button
        id="sidebar-toggle-btn"
        onclick="sidebarToggle()"
        title="Toggle sidebar"
        style="position:absolute; top:52px; right:-13px; z-index:10003;
               width:26px; height:26px; border-radius:50%;
               background:#fff; border:1.5px solid #e5e7eb;
               box-shadow:0 2px 8px rgba(0,0,0,.12),0 0 0 1px rgba(0,0,0,.04);
               display:flex; align-items:center; justify-content:center;
               cursor:pointer; transition:box-shadow .15s,background .15s;"
        onmouseover="this.style.boxShadow='0 4px 14px rgba(0,0,0,.18)';this.style.background='#f9fafb';"
        onmouseout="this.style.boxShadow='0 2px 8px rgba(0,0,0,.12),0 0 0 1px rgba(0,0,0,.04)';this.style.background='#fff';"
    >
        <span
            id="sidebar-chevron"
            class="icon-left-arrow"
            style="font-size:9px;color:#6b7280;transition:transform 300ms ease;{{ $startCollapsed ? 'transform:rotate(180deg);' : '' }}"
        ></span>
    </button>

    {{-- ── Scrollable nav ───────────────────────────────────────── --}}
    <div class="journal-scroll h-[calc(100vh-62px)] overflow-y-auto overflow-x-hidden pt-3">
        <nav style="display:grid; width:100%; gap:1px;">

            @php
                $adminMenuItems = menu()->getItems('admin');
                $lastGroup      = null;
                $sysAdminGroups = ['System Administration'];
            @endphp

            @foreach ($adminMenuItems as $menuItem)
                @php
                    $menuKey      = $menuItem->getKey();
                    /* Skip child items in the top-level loop to avoid double-rendering */
                    if (str_contains($menuKey, '.')) continue;

                    $currentGroup = $menuItem->getGroup();
                    $isSysAdmin   = in_array($currentGroup, $sysAdminGroups);
                    $hasChildren  = ! in_array($menuKey, ['settings', 'configuration']) && $menuItem->haveChildren();
                    $isActive     = $menuItem->isActive();
                @endphp

                {{-- System Administration separator --}}
                @if ($isSysAdmin && $lastGroup !== $currentGroup)
                    <div class="sidebar-label" style="margin:6px 12px; border-top:1px solid #e5e7eb; {{ $startCollapsed ? 'display:none' : '' }}"></div>
                @endif

                {{-- Department group label --}}
                @if ($currentGroup && $currentGroup !== $lastGroup)
                    <div class="sidebar-label" style="padding:8px 16px 2px; overflow:hidden; white-space:nowrap; {{ $startCollapsed ? 'display:none;opacity:0;' : '' }}">
                        <p style="font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:#9ca3af;">
                            {{ $currentGroup }}
                        </p>
                    </div>
                    @php $lastGroup = $currentGroup; @endphp
                @endif

                {{-- ── Parent menu item ──────────────────────────── --}}
                <div style="padding:0 8px;" class="group/item">

                    {{-- Row: icon + label + chevron --}}
                    <a
                        href="{{ $hasChildren ? 'javascript:void(0)' : $menuItem->getUrl() }}"
                        @if($hasChildren) onclick="toggleSubMenu('{{ $menuItem->getKey() }}')" @endif
                        title="{{ $menuItem->getName() }}"
                        style="display:flex; align-items:center; gap:10px;
                               padding:7px 10px; border-radius:8px; cursor:pointer;
                               text-decoration:none; transition:background .15s;
                               {{ $isActive ? 'background:var(--brand-color,#0E90D9);' : '' }}"
                        onmouseover="{{ !$isActive ? "this.style.background='#f3f4f6'" : '' }}"
                        onmouseout="{{ !$isActive ? "this.style.background=''" : '' }}"
                        @if(!$hasChildren)
                            @mouseover="hoveringMenu='{{ $menuItem->getKey() }}'"
                        @endif
                    >
                        {{-- Icon --}}
                        <span
                            class="{{ $menuItem->getIcon() }}"
                            style="font-size:18px; flex-shrink:0; {{ $isActive ? 'color:#fff;' : 'color:#6b7280;' }}"
                        ></span>

                        {{-- Label --}}
                        <span
                            class="sidebar-item-label"
                            style="flex:1; font-size:13px; font-weight:500; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;
                                   transition:opacity .2s;
                                   {{ $isActive ? 'color:#fff;' : 'color:#374151;' }}
                                   {{ $startCollapsed ? 'opacity:0;pointer-events:none;' : 'opacity:1;' }}"
                        >
                            {{ core()->getConfigData('general.settings.menu.'.$menuItem->getKey()) ?? $menuItem->getName() }}
                        </span>

                        {{-- Expand chevron (only for items with children, only in expanded sidebar) --}}
                        @if ($hasChildren)
                            <span
                                id="chev-{{ $menuItem->getKey() }}"
                                class="sidebar-item-label icon-down-arrow"
                                style="font-size:9px; flex-shrink:0; transition:transform .25s ease;
                                       {{ $isActive ? 'color:rgba(255,255,255,.8);' : 'color:#9ca3af;' }}
                                       {{ $startCollapsed ? 'opacity:0;pointer-events:none;' : 'opacity:1;' }}"
                            ></span>
                        @endif
                    </a>

                    {{-- ── Inline sub-menu accordion ─────────────── --}}
                    @if ($hasChildren)
                        <div
                            id="sub-{{ $menuItem->getKey() }}"
                            style="max-height:0; opacity:0; overflow:hidden;
                                   transition:max-height .3s cubic-bezier(0.4,0,0.2,1), opacity .2s;
                                   margin-top:2px;"
                        >
                            {{-- Container for sub-items — using a subtle background block as per Bedimcode --}}
                            <div style="margin:0 4px 6px 16px; padding:4px 0 4px 10px; border-left:2px solid #e5e7eb; border-radius:0 0 8px 8px;" class="sub-menu-container">
                                @foreach ($menuItem->getChildren() as $subMenuItem)
                                    @php
                                        $subActive = $subMenuItem->isActive();
                                        $subIcon   = $subMenuItem->getIcon();
                                    @endphp
                                    <a
                                        href="{{ $subMenuItem->getUrl() }}"
                                        title="{{ $subMenuItem->getName() }}"
                                        class="{{ $subActive ? 'active-sub-item' : '' }}"
                                        style="display:flex; align-items:center; gap:8px; padding:6px 10px; border-radius:6px;
                                               text-decoration:none; margin-bottom:1px; transition:all .15s;
                                               {{ $subActive
                                                    ? 'background:rgba(14, 144, 217, 0.1); color:var(--brand-color,#0E90D9);'
                                                    : 'color:#4b5563;' }}"
                                        onmouseover="{{ !$subActive ? "this.style.background='#f3f4f6'; this.style.color='#111827';" : '' }}"
                                        onmouseout="{{ !$subActive ? "this.style.background=''; this.style.color='#4b5563';" : '' }}"
                                    >
                                        {{-- Sub-item Icon (Bedimcode style) --}}
                                        @if($subIcon)
                                            <span class="{{ $subIcon }}" style="font-size:14px; opacity:0.7; {{ $subActive ? 'color:var(--brand-color,#0E90D9); opacity:1;' : '' }}"></span>
                                        @endif

                                        <span class="sidebar-item-label" style="font-size:12.5px; font-weight:{{ $subActive ? '600' : '500' }}; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; transition:opacity .2s; {{ $startCollapsed ? 'opacity:0;' : 'opacity:1;' }}">
                                            {{ core()->getConfigData('general.settings.menu.'.$subMenuItem->getKey()) ?? $subMenuItem->getName() }}
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        {{-- Open active sub-menu on page load (if not collapsed) --}}
                        @if ($isActive)
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const s = document.getElementById('desktop-sidebar');
                                    if (s && s.classList.contains('is-collapsed')) return;

                                    const p = document.getElementById('sub-{{ $menuItem->getKey() }}');
                                    const c = document.getElementById('chev-{{ $menuItem->getKey() }}');
                                    if (p) { p.style.maxHeight = p.scrollHeight + 'px'; p.style.opacity = '1'; }
                                    if (c) c.style.transform = 'rotate(180deg)';
                                });
                            </script>
                        @endif

                        {{-- Flyout panel for collapsed (icon-only) mode --}}
                        <div
                            class="absolute top-0 ltr:left-[64px] rtl:right-[64px] hidden flex-col"
                            :class="[isMenuActive && (hoveringMenu == '{{ $menuItem->getKey() }}') ? '!flex' : 'hidden']"
                        >
                            <div style="position:fixed; z-index:1000; background:#fff; border:1px solid #e5e7eb;
                                        border-radius:8px; box-shadow:0 4px 20px rgba(0,0,0,.12);
                                        min-width:160px; max-height:calc(100vh - 80px); overflow-y:auto; padding:6px;"
                                 class="dark:bg-gray-900 dark:border-gray-700">
                                <p style="padding:8px 12px 4px; font-size:10px; font-weight:700;
                                          text-transform:uppercase; letter-spacing:.08em; color:#9ca3af;">
                                    {{ $menuItem->getName() }}
                                </p>
                                @foreach ($menuItem->getChildren() as $subMenuItem)
                                    @php $subActive = $subMenuItem->isActive(); @endphp
                                    <a
                                        href="{{ $subMenuItem->getUrl() }}"
                                        style="display:block; padding:7px 12px; border-radius:6px;
                                               font-size:13px; font-weight:{{ $subActive ? '600' : '400' }};
                                               text-decoration:none; transition:background .12s;
                                               {{ $subActive ? 'background:var(--brand-color,#0E90D9); color:#fff;' : 'color:#374151;' }}"
                                        onmouseover="{{ !$subActive ? "this.style.background='#f3f4f6';" : '' }}"
                                        onmouseout="{{ !$subActive ? "this.style.background='';" : '' }}"
                                    >
                                        {{ core()->getConfigData('general.settings.menu.'.$subMenuItem->getKey()) ?? $subMenuItem->getName() }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach

        </nav>
    </div>
</div>