<x-admin::layouts>
    <x-slot:title>
        @lang('admin::app.timesheets.edit.title')
    </x-slot>

    <x-admin::form
        :action="route('admin.timesheets.update', $timesheet->id)"
        method="PUT"
    >
        <div class="flex flex-col gap-4">
            <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
                <div class="flex flex-col gap-2">
                    <div class="text-xl font-bold dark:text-white">
                        @lang('admin::app.timesheets.edit.title')
                    </div>
                </div>

                <div class="flex items-center gap-x-2.5">
                    <a href="{{ route('admin.timesheets.index') }}" class="transparent-button hover:bg-gray-200 dark:text-white dark:hover:bg-gray-800">
                        @lang('admin::app.timesheets.edit.back-btn')
                    </a>

                    <button type="submit" class="primary-button">
                        @lang('admin::app.timesheets.edit.save-btn')
                    </button>
                </div>
            </div>

            <div class="box-shadow rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900">
                <div class="flex gap-4">
                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label>
                            @lang('admin::app.timesheets.create.project')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="select"
                            id="project_id"
                            name="project_id"
                        >
                            <option value="">-- None --</option>
                            @foreach ($projects as $id => $name)
                                <option value="{{ $id }}" {{ $timesheet->project_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </x-admin::form.control-group.control>
                    </x-admin::form.control-group>

                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label>
                            @lang('admin::app.timesheets.create.task')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="select"
                            id="task_id"
                            name="task_id"
                        >
                            <option value="">-- None --</option>
                            @foreach ($tasks as $id => $title)
                                <option value="{{ $id }}" {{ $timesheet->task_id == $id ? 'selected' : '' }}>{{ $title }}</option>
                            @endforeach
                        </x-admin::form.control-group.control>
                    </x-admin::form.control-group>

                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label class="required">
                            @lang('admin::app.timesheets.create.user')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="select"
                            id="user_id"
                            name="user_id"
                            rules="required"
                        >
                            <option value="">-- Select User --</option>
                            @foreach ($users as $id => $name)
                                <option value="{{ $id }}" {{ $timesheet->user_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </x-admin::form.control-group.control>

                        <x-admin::form.control-group.error control-name="user_id" />
                    </x-admin::form.control-group>
                </div>

                <div class="flex gap-4">
                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label class="required">
                            @lang('admin::app.timesheets.create.date')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="date"
                            id="date"
                            name="date"
                            rules="required"
                            :value="$timesheet->date->format('Y-m-d')"
                        />

                        <x-admin::form.control-group.error control-name="date" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label class="required">
                            @lang('admin::app.timesheets.create.hours')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            id="hours"
                            name="hours"
                            rules="required"
                            :value="$timesheet->hours"
                        />

                        <x-admin::form.control-group.error control-name="hours" />
                    </x-admin::form.control-group>
                </div>

                <x-admin::form.control-group>
                    <x-admin::form.control-group.label>
                        @lang('admin::app.timesheets.create.description')
                    </x-admin::form.control-group.label>

                    <x-admin::form.control-group.control
                        type="textarea"
                        id="description"
                        name="description"
                        :value="$timesheet->description"
                    />
                </x-admin::form.control-group>
            </div>
        </div>
    </x-admin::form>
</x-admin::layouts>
