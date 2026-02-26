<x-admin::layouts>
    <x-slot:title>
        @lang('admin::app.projects.create.title')
    </x-slot>

    <x-admin::form
        :action="route('admin.projects.store')"
        method="POST"
    >
        <div class="flex flex-col gap-4">
            <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
                <div class="flex flex-col gap-2">
                    <div class="text-xl font-bold dark:text-white">
                        @lang('admin::app.projects.create.title')
                    </div>
                </div>

                <div class="flex items-center gap-x-2.5">
                    <a
                        href="{{ route('admin.projects.index') }}"
                        class="transparent-button hover:bg-gray-200 dark:text-white dark:hover:bg-gray-800"
                    >
                        @lang('admin::app.projects.create.back-btn')
                    </a>

                    <button
                        type="submit"
                        class="primary-button"
                    >
                        @lang('admin::app.projects.create.save-btn')
                    </button>
                </div>
            </div>

            <div class="box-shadow rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900">
                <div class="flex gap-4">
                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label class="required">
                            @lang('admin::app.projects.create.name')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            id="name"
                            name="name"
                            rules="required"
                            :label="trans('admin::app.projects.create.name')"
                            :placeholder="trans('admin::app.projects.create.name')"
                        />

                        <x-admin::form.control-group.error control-name="name" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label>
                            @lang('admin::app.projects.create.project-type')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            id="project_type"
                            name="project_type"
                            :label="trans('admin::app.projects.create.project-type')"
                            :placeholder="trans('admin::app.projects.create.project-type')"
                        />

                        <x-admin::form.control-group.error control-name="project_type" />
                    </x-admin::form.control-group>
                </div>

                <x-admin::form.control-group>
                    <x-admin::form.control-group.label>
                        @lang('admin::app.projects.create.description')
                    </x-admin::form.control-group.label>

                    <x-admin::form.control-group.control
                        type="textarea"
                        id="description"
                        name="description"
                        :label="trans('admin::app.projects.create.description')"
                        :placeholder="trans('admin::app.projects.create.description')"
                    />

                    <x-admin::form.control-group.error control-name="description" />
                </x-admin::form.control-group>

                <div class="flex gap-4">
                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label>
                            @lang('admin::app.projects.create.client')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="select"
                            id="client_id"
                            name="client_id"
                            :label="trans('admin::app.projects.create.client')"
                        >
                            <option value="">Select Client</option>
                            @foreach ($persons as $person)
                                <option value="{{ $person->id }}">{{ $person->name }}</option>
                            @endforeach
                        </x-admin::form.control-group.control>

                        <x-admin::form.control-group.error control-name="client_id" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label class="required">
                            @lang('admin::app.projects.create.status')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="select"
                            id="status"
                            name="status"
                            rules="required"
                            :label="trans('admin::app.projects.create.status')"
                        >
                            <option value="not_started">Not Started</option>
                            <option value="in_progress">In Progress</option>
                            <option value="on_hold">On Hold</option>
                            <option value="completed">Completed</option>
                        </x-admin::form.control-group.control>

                        <x-admin::form.control-group.error control-name="status" />
                    </x-admin::form.control-group>
                </div>

                <div class="flex gap-4">
                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label>
                            @lang('admin::app.projects.create.start-date')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="date"
                            id="start_date"
                            name="start_date"
                            :label="trans('admin::app.projects.create.start-date')"
                        />

                        <x-admin::form.control-group.error control-name="start_date" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label>
                            @lang('admin::app.projects.create.end-date')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="date"
                            id="end_date"
                            name="end_date"
                            :label="trans('admin::app.projects.create.end-date')"
                        />

                        <x-admin::form.control-group.error control-name="end_date" />
                    </x-admin::form.control-group>
                </div>

                <div class="flex gap-4">
                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label>
                            @lang('admin::app.projects.create.expected-end-date')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="date"
                            id="expected_end_date"
                            name="expected_end_date"
                            :label="trans('admin::app.projects.create.expected-end-date')"
                        />

                        <x-admin::form.control-group.error control-name="expected_end_date" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label>
                            @lang('admin::app.projects.create.actual-end-date')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="date"
                            id="actual_end_date"
                            name="actual_end_date"
                            :label="trans('admin::app.projects.create.actual-end-date')"
                        />

                        <x-admin::form.control-group.error control-name="actual_end_date" />
                    </x-admin::form.control-group>
                </div>

                <div class="flex gap-4">
                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label>
                            @lang('admin::app.projects.create.manager')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="select"
                            id="manager_id"
                            name="manager_id"
                            :label="trans('admin::app.projects.create.manager')"
                        >
                            <option value="">Select Manager</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </x-admin::form.control-group.control>

                        <x-admin::form.control-group.error control-name="manager_id" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label>
                            @lang('admin::app.projects.create.owner')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="select"
                            id="owner_id"
                            name="owner_id"
                            :label="trans('admin::app.projects.create.owner')"
                        >
                            <option value="">Select Owner</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </x-admin::form.control-group.control>

                        <x-admin::form.control-group.error control-name="owner_id" />
                    </x-admin::form.control-group>
                </div>

                <div class="flex gap-4">
                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label>
                            @lang('admin::app.projects.create.priority')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="select"
                            id="priority"
                            name="priority"
                            :label="trans('admin::app.projects.create.priority')"
                        >
                            <option value="">Select Priority</option>
                            <option value="low">@lang('admin::app.projects.create.low')</option>
                            <option value="medium">@lang('admin::app.projects.create.medium')</option>
                            <option value="high">@lang('admin::app.projects.create.high')</option>
                        </x-admin::form.control-group.control>

                        <x-admin::form.control-group.error control-name="priority" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label>
                            @lang('admin::app.projects.create.team-type')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="select"
                            id="team_type"
                            name="team_type"
                            :label="trans('admin::app.projects.create.team-type')"
                        >
                            <option value="">Select Team</option>
                            <option value="internal">@lang('admin::app.projects.create.internal')</option>
                            <option value="external">@lang('admin::app.projects.create.external')</option>
                        </x-admin::form.control-group.control>

                        <x-admin::form.control-group.error control-name="team_type" />
                    </x-admin::form.control-group>
                </div>
            </div>
        </div>
    </x-admin::form>
</x-admin::layouts>
