<x-admin::layouts>
    <x-slot:title>
        Create Proposal
    </x-slot>

    {!! view_render_event('admin.it_sales.proposals.create.before') !!}

    <x-admin::form :action="route('admin.it_sales.proposals.store')">
        <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
            <div class="flex flex-col gap-2">
                <div class="flex items-center gap-2">
                    <p class="text-xl font-bold dark:text-white">
                        Create IT Proposal
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-x-2.5">
                <button type="submit" class="primary-button">
                    Save Proposal
                </button>
            </div>
        </div>

        <div class="mt-3.5 flex gap-4 max-xl:flex-wrap">
            <div class="flex flex-1 flex-col gap-2 max-xl:flex-auto">
                <div class="rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900">
                    <p class="mb-4 text-base font-semibold dark:text-white">
                        Proposal Details
                    </p>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">
                            Title
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            rules="required"
                            label="Title"
                            placeholder="Proposal Title"
                        />

                        <x-admin::form.control-group.error control-name="title" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Lead
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="select"
                            name="lead_id"
                            value="{{ old('lead_id') ?? $lead_id }}"
                            label="Lead"
                        >
                            <option value="">Select Lead</option>
                            @foreach(\Webkul\Lead\Models\Lead::all() as $lead)
                                <option value="{{ $lead->id }}" {{ (old('lead_id') ?? $lead_id) == $lead->id ? 'selected' : '' }}>
                                    {{ $lead->title }}
                                </option>
                            @endforeach
                        </x-admin::form.control-group.control>

                        <x-admin::form.control-group.error control-name="lead_id" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Executive Summary
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="textarea"
                            name="executive_summary"
                            value="{{ old('executive_summary') }}"
                            label="Executive Summary"
                            placeholder="Briefly describe the proposal..."
                        />

                        <x-admin::form.control-group.error control-name="executive_summary" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Scope of Work
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="textarea"
                            name="scope_of_work"
                            value="{{ old('scope_of_work') }}"
                            label="Scope of Work"
                            placeholder="Detailed scope..."
                        />

                        <x-admin::form.control-group.error control-name="scope_of_work" />
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
                            Timeline (Weeks)
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="timeline_weeks"
                            value="{{ old('timeline_weeks') }}"
                            label="Timeline Weeks"
                            placeholder="e.g. 4"
                        />

                        <x-admin::form.control-group.error control-name="timeline_weeks" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Valid Until
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="date"
                            name="valid_until"
                            value="{{ old('valid_until') }}"
                            label="Valid Until"
                        />

                        <x-admin::form.control-group.error control-name="valid_until" />
                    </x-admin::form.control-group>
                </div>
            </div>
        </div>
    </x-admin::form>

    {!! view_render_event('admin.it_sales.proposals.create.after') !!}
</x-admin::layouts>
