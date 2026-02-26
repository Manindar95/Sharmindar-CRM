<x-admin::layouts>
    <x-slot:title>
        @lang('admin::app.payments.create.title')
    </x-slot>

    <x-admin::form
        :action="route('admin.payments.store')"
        method="POST"
    >
        <div class="flex flex-col gap-4">
            <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
                <div class="flex flex-col gap-2">
                    <div class="text-xl font-bold dark:text-white">
                        @lang('admin::app.payments.create.title')
                    </div>
                </div>

                <div class="flex items-center gap-x-2.5">
                    <a
                        href="{{ route('admin.payments.index') }}"
                        class="transparent-button hover:bg-gray-200 dark:text-white dark:hover:bg-gray-800"
                    >
                        @lang('admin::app.payments.create.back-btn')
                    </a>

                    <button
                        type="submit"
                        class="primary-button"
                    >
                        @lang('admin::app.payments.create.save-btn')
                    </button>
                </div>
            </div>

            <div class="box-shadow rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900">
                <div class="flex gap-4">
                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label class="required">
                            @lang('admin::app.payments.create.invoice-id')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            id="invoice_id"
                            name="invoice_id"
                            rules="required"
                            :label="trans('admin::app.payments.create.invoice-id')"
                        />

                        <x-admin::form.control-group.error control-name="invoice_id" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label class="required">
                            @lang('admin::app.payments.create.project')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="select"
                            id="project_id"
                            name="project_id"
                            rules="required"
                            :label="trans('admin::app.payments.create.project')"
                        >
                            <option value="">Select Project</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </x-admin::form.control-group.control>

                        <x-admin::form.control-group.error control-name="project_id" />
                    </x-admin::form.control-group>
                </div>

                <div class="flex gap-4">
                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label class="required">
                            @lang('admin::app.payments.create.invoice-date')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="date"
                            id="invoice_date"
                            name="invoice_date"
                            rules="required"
                            :label="trans('admin::app.payments.create.invoice-date')"
                        />

                        <x-admin::form.control-group.error control-name="invoice_date" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label class="required">
                            @lang('admin::app.payments.create.invoice-amount')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            id="invoice_amount"
                            name="invoice_amount"
                            rules="required|decimal"
                            :label="trans('admin::app.payments.create.invoice-amount')"
                        />

                        <x-admin::form.control-group.error control-name="invoice_amount" />
                    </x-admin::form.control-group>
                </div>

                <div class="flex gap-4">
                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label>
                            @lang('admin::app.payments.create.due-date')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="date"
                            id="due_date"
                            name="due_date"
                            :label="trans('admin::app.payments.create.due-date')"
                        />

                        <x-admin::form.control-group.error control-name="due_date" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label class="required">
                            @lang('admin::app.payments.create.payment-status')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="select"
                            id="payment_status"
                            name="payment_status"
                            rules="required"
                            :label="trans('admin::app.payments.create.payment-status')"
                        >
                            <option value="pending">Pending</option>
                            <option value="received">Received</option>
                            <option value="refunded">Refunded</option>
                        </x-admin::form.control-group.control>

                        <x-admin::form.control-group.error control-name="payment_status" />
                    </x-admin::form.control-group>
                </div>

                <div class="flex gap-4">
                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label>
                            @lang('admin::app.payments.create.payment-received-date')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="date"
                            id="payment_received_date"
                            name="payment_received_date"
                            :label="trans('admin::app.payments.create.payment-received-date')"
                        />

                        <x-admin::form.control-group.error control-name="payment_received_date" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label>
                            @lang('admin::app.payments.create.followup-owner')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="select"
                            id="followup_owner_id"
                            name="followup_owner_id"
                            :label="trans('admin::app.payments.create.followup-owner')"
                        >
                            <option value="">Select Owner</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </x-admin::form.control-group.control>

                        <x-admin::form.control-group.error control-name="followup_owner_id" />
                    </x-admin::form.control-group>
                </div>
            </div>
        </div>
    </x-admin::form>
</x-admin::layouts>
