<x-admin::layouts>
    <x-slot:title>
        @lang('admin::app.proposals.create.title')
    </x-slot>

    <x-admin::form :action="route('admin.proposals.store')">
        <div class="flex flex-col gap-4">
            <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
                <div class="flex flex-col gap-2">
                    <div class="text-xl font-bold dark:text-white">
                        @lang('admin::app.proposals.create.title')
                    </div>
                </div>

                <div class="flex items-center gap-x-2.5">
                    <a
                        href="{{ route('admin.proposals.index') }}"
                        class="transparent-button hover:bg-gray-200 dark:text-white dark:hover:bg-gray-800"
                    >
                        @lang('admin::app.proposals.create.back-btn')
                    </a>

                    <button
                        type="submit"
                        class="primary-button"
                    >
                        @lang('admin::app.proposals.create.save-btn')
                    </button>
                </div>
            </div>

            <div class="box-shadow rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900">
                <div class="flex gap-4">
                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label class="required">
                            @lang('admin::app.proposals.create.proposal-id')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            id="proposal_id"
                            name="proposal_id"
                            rules="required"
                            :label="trans('admin::app.proposals.create.proposal-id')"
                            :placeholder="trans('admin::app.proposals.create.proposal-id')"
                        />

                        <x-admin::form.control-group.error control-name="proposal_id" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label class="required">
                            @lang('admin::app.proposals.create.project')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="select"
                            id="project_id"
                            name="project_id"
                            rules="required"
                            :label="trans('admin::app.proposals.create.project')"
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
                            @lang('admin::app.proposals.create.client')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="select"
                            id="person_id"
                            name="person_id"
                            rules="required"
                            :label="trans('admin::app.proposals.create.client')"
                        >
                            <option value="">Select Client</option>
                            @foreach ($persons as $person)
                                <option value="{{ $person->id }}">{{ $person->name }}</option>
                            @endforeach
                        </x-admin::form.control-group.control>

                        <x-admin::form.control-group.error control-name="person_id" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label class="required">
                            @lang('admin::app.proposals.create.project-owner')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="select"
                            id="user_id"
                            name="user_id"
                            rules="required"
                            :label="trans('admin::app.proposals.create.project-owner')"
                        >
                            <option value="">Select Owner</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </x-admin::form.control-group.control>

                        <x-admin::form.control-group.error control-name="user_id" />
                    </x-admin::form.control-group>
                </div>

                <div class="flex gap-4">
                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label class="required">
                            @lang('admin::app.proposals.create.proposal-date')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="date"
                            id="proposal_date"
                            name="proposal_date"
                            rules="required"
                            :label="trans('admin::app.proposals.create.proposal-date')"
                        />

                        <x-admin::form.control-group.error control-name="proposal_date" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label class="required">
                            @lang('admin::app.proposals.create.value')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            id="value"
                            name="value"
                            rules="required"
                            :label="trans('admin::app.proposals.create.value')"
                            :placeholder="trans('admin::app.proposals.create.value')"
                        />

                        <x-admin::form.control-group.error control-name="value" />
                    </x-admin::form.control-group>
                </div>

                <div class="flex gap-4">
                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label class="required">
                            @lang('admin::app.proposals.create.status')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="select"
                            id="status"
                            name="status"
                            rules="required"
                            :label="trans('admin::app.proposals.create.status')"
                        >
                            <option value="draft">Draft</option>
                            <option value="sent">Sent</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                            <option value="signed">Signed</option>
                        </x-admin::form.control-group.control>

                        <x-admin::form.control-group.error control-name="status" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label>
                            @lang('admin::app.proposals.create.ceo-approved-date')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="date"
                            id="ceo_approved_at"
                            name="ceo_approved_at"
                            :label="trans('admin::app.proposals.create.ceo-approved-date')"
                        />

                        <x-admin::form.control-group.error control-name="ceo_approved_at" />
                    </x-admin::form.control-group>
                </div>

                <div class="flex gap-4">
                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label>
                            @lang('admin::app.proposals.create.manager-approved-date')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="date"
                            id="manager_approved_at"
                            name="manager_approved_at"
                            :label="trans('admin::app.proposals.create.manager-approved-date')"
                        />

                        <x-admin::form.control-group.error control-name="manager_approved_at" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label>
                            @lang('admin::app.proposals.create.date-shared-with-client')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="date"
                            id="shared_with_client_at"
                            name="shared_with_client_at"
                            :label="trans('admin::app.proposals.create.date-shared-with-client')"
                        />

                        <x-admin::form.control-group.error control-name="shared_with_client_at" />
                    </x-admin::form.control-group>
                </div>

                <x-admin::form.control-group>
                    <x-admin::form.control-group.label>
                        @lang('admin::app.proposals.create.client-signed-date')
                    </x-admin::form.control-group.label>

                    <x-admin::form.control-group.control
                        type="date"
                        id="client_signed_at"
                        name="client_signed_at"
                        :label="trans('admin::app.proposals.create.client-signed-date')"
                    />

                    <x-admin::form.control-group.error control-name="client_signed_at" />
                </x-admin::form.control-group>
            </div>
        </div>
    </x-admin::form>
</x-admin::layouts>
