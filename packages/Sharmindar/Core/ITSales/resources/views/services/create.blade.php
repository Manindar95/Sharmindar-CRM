<x-admin::layouts>
    <x-slot:title>
        {{ __('it_sales::app.services.create-title') }}
    </x-slot>

    {!! view_render_event('admin.it_sales.services.create.before') !!}

    <x-admin::form :action="route('admin.it_sales.services.store')">
        <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
            <div class="flex flex-col gap-2">
                <div class="flex items-center gap-2">
                    <p class="text-xl font-bold dark:text-white">
                        {{ __('it_sales::app.services.create-title') }}
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-x-2.5">
                <div class="flex items-center gap-x-2.5">
                    <button type="submit" class="primary-button">
                        {{ __('admin::app.save') }}
                    </button>
                </div>
            </div>
        </div>

        <div class="mt-3.5 flex gap-4 max-xl:flex-wrap">
            <div class="flex flex-1 flex-col gap-2 max-xl:flex-auto">
                <div class="rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900">
                    <p class="mb-4 text-base font-semibold dark:text-white">
                        General Information
                    </p>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">
                            Name
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            rules="required"
                            label="Name"
                            placeholder="Service Name"
                        />

                        <x-admin::form.control-group.error control-name="name" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">
                            Category
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="select"
                            name="category"
                            value="{{ old('category') }}"
                            rules="required"
                            label="Category"
                        >
                            <option value="development">Development</option>
                            <option value="design">Design</option>
                            <option value="consulting">Consulting</option>
                            <option value="maintenance">Maintenance</option>
                            <option value="testing">Testing</option>
                            <option value="devops">DevOps</option>
                        </x-admin::form.control-group.control>

                        <x-admin::form.control-group.error control-name="category" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">
                            Billing Type
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="select"
                            name="billing_type"
                            value="{{ old('billing_type') }}"
                            rules="required"
                            label="Billing Type"
                        >
                            <option value="fixed">Fixed Price</option>
                            <option value="hourly">Hourly</option>
                            <option value="monthly_retainer">Monthly Retainer</option>
                        </x-admin::form.control-group.control>

                        <x-admin::form.control-group.error control-name="billing_type" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Hourly Rate
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="hourly_rate"
                            value="{{ old('hourly_rate') }}"
                            label="Hourly Rate"
                            placeholder="0.00"
                        />

                        <x-admin::form.control-group.error control-name="hourly_rate" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Fixed Price
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="fixed_price"
                            value="{{ old('fixed_price') }}"
                            label="Fixed Price"
                            placeholder="0.00"
                        />

                        <x-admin::form.control-group.error control-name="fixed_price" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Description
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="textarea"
                            name="description"
                            value="{{ old('description') }}"
                            label="Description"
                            placeholder="Service Description"
                        />

                        <x-admin::form.control-group.error control-name="description" />
                    </x-admin::form.control-group>
                </div>
            </div>

            <div class="flex w-[360px] max-w-full flex-col gap-2 max-sm:w-full">
                <div class="rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900">
                    <p class="mb-4 text-base font-semibold dark:text-white">
                        Settings
                    </p>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Status
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="switch"
                            name="is_active"
                            value="1"
                            checked="{{ old('is_active') ?? true }}"
                            label="Status"
                        />

                        <x-admin::form.control-group.error control-name="is_active" />
                    </x-admin::form.control-group>
                </div>
            </div>
        </div>
    </x-admin::form>

    {!! view_render_event('admin.it_sales.services.create.after') !!}
</x-admin::layouts>
