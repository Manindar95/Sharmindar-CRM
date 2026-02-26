<template v-if="isLoading">
    <x-admin::shimmer.datagrid.toolbar />
</template>

<template v-else>
    <div class="flex items-center justify-between gap-4 rounded-t-lg border border-b-0 border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300 max-md:flex-wrap">
        <!-- Left Toolbar -->
        <div class="toolbarLeft flex gap-x-1">
            {{ $toolbarLeftBefore }}
            
            <!-- Mass Actions Panel -->
            <transition-group
                tag='div'
                name="flash-group"
                enter-from-class="ltr:translate-y-full rtl:-translate-y-full"
                enter-active-class="transform transition duration-300 ease-[cubic-bezier(.4,0,.2,1)]"
                enter-to-class="ltr:translate-y-0 rtl:-translate-y-0"
                leave-from-class="ltr:translate-y-0 rtl:-translate-y-0"
                leave-active-class="transform transition duration-300 ease-[cubic-bezier(.4,0,.2,1)]"
                leave-to-class="ltr:translate-y-full rtl:-translate-y-full"
                class='fixed bottom-10 left-1/2 z-[10003] grid -translate-x-1/2 justify-items-end gap-2.5'
            >
                <div v-if="applied.massActions.indices.length">
                    <x-admin::datagrid.toolbar.mass-action>
                        <template #mass-action="{
                            available,
                            applied,
                            massActions,
                            validateMassAction,
                            performMassAction
                        }">
                            <slot
                                name="mass-action"
                                :available="available"
                                :applied="applied"
                                :mass-actions="massActions"
                                :validate-mass-action="validateMassAction"
                                :perform-mass-action="performMassAction"
                            >
                            </slot>
                        </template>
                    </x-admin::datagrid.toolbar.mass-action>
                </div>
            </transition-group>

            <!-- Search Panel -->
            <x-admin::datagrid.toolbar.search>
                <template #search="{
                    available,
                    applied,
                    search,
                    getSearchedValues,
                }">
                    <slot
                        name="search"
                        :available="available"
                        :applied="applied"
                        :search="search"
                        :get-searched-values="getSearchedValues"
                    >
                    </slot>
                </template>
            </x-admin::datagrid.toolbar.search>

            {{ $toolbarLeftAfter }}
        </div>

        <!-- Right Toolbar -->
        <div class="toolbarRight flex gap-x-4 items-center">
            {{ $toolbarRightBefore }}

            <!-- Export Dropdown -->
            <div class="relative" v-if="available?.records?.length">
                <button
                    type="button"
                    class="flex items-center gap-1.5 rounded-md border border-gray-200 bg-white px-2.5 py-1.5 text-sm font-medium text-gray-600 transition-all hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
                    @click="showExportDropdown = !showExportDropdown"
                >
                    <span class="icon-download text-lg"></span>
                    @lang('admin::app.export.export')
                    <span class="icon-down-arrow text-lg" :class="showExportDropdown ? 'rotate-180' : ''"></span>
                </button>

                <transition
                    enter-active-class="transition duration-200 ease-out"
                    enter-from-class="transform scale-95 opacity-0"
                    enter-to-class="transform scale-100 opacity-100"
                    leave-active-class="transition duration-150 ease-in"
                    leave-from-class="transform scale-100 opacity-100"
                    leave-to-class="transform scale-95 opacity-0"
                >
                    <div
                        v-if="showExportDropdown"
                        class="absolute right-0 top-full z-[100] mt-1 w-48 origin-top-right rounded-lg border border-gray-200 bg-white shadow-lg dark:border-gray-700 dark:bg-gray-800"
                    >
                        <div class="py-1">
                            <button
                                class="flex w-full items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700"
                                @click="exportData('csv')"
                            >
                                <span class="icon-download text-lg text-emerald-500"></span>
                                @lang('admin::app.export.csv')
                            </button>

                            <button
                                class="flex w-full items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700"
                                @click="exportData('xls')"
                            >
                                <span class="icon-download text-lg text-blue-500"></span>
                                @lang('admin::app.export.xls')
                            </button>

                            <button
                                class="flex w-full items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700"
                                @click="exportPDF()"
                            >
                                <span class="icon-download text-lg text-red-500"></span>
                                Export as PDF
                            </button>
                        </div>
                    </div>
                </transition>
            </div>

            <!-- Pagination Panel -->
            <x-admin::datagrid.toolbar.pagination>
                <template #pagination="{
                    available,
                    applied,
                    changePage,
                    changePerPageOption
                }">
                    <slot
                        name="pagination"
                        :available="available"
                        :applied="applied"
                        :change-page="changePage"
                        :change-per-page-option="changePerPageOption"
                    >
                    </slot>
                </template>
            </x-admin::datagrid.toolbar.pagination>

            {{ $toolbarRightAfter }}
        </div>
    </div>
</template>
