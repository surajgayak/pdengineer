<div>
    <form wire:submit.prevent='store'>
        <div class="row">
            <div class="col-12 col-md-6">
                <x-component::form.prepend-input type='date' label='Project Start Date' name="start_date"
                    iconName="calendar" :required='true' wire:model.defer='start_date' />
            </div>

            <div class="col-12 col-md-6">
                <x-component::form.prepend-input type='text' label='Project Name' name="project_name"
                    iconName="marker" :required="true" wire:model.defer='project_name' />
            </div>
            <div class="col-12 col-md-6">
                <x-component::form.prepend-input type='text' label='Client Name' name="client_name" iconName="marker"
                    :required='true' wire:model.defer='client_name' />
            </div>
            <div class="col-12 col-md-6">
                <x-component::form.prepend-input type='date' label='Job Deadline Accomplish'
                    name="user_deadline_accomplish_date" iconName="calendar" :required='true'
                    wire:model.defer='user_deadline_accomplish_date' />
            </div>
            <div class="col-12 col-md-6">
                <x-component::form.prepend-input type='text' label='Job' name="job" iconName="calendar"
                    :required='true' wire:model.defer='job' />
            </div>
            <div class="col-12 col-md-6">
                <x-component::form.select label='Responsible' :required='true' name='user_id'
                    wire:model.lazy='user_id'>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->fname . ' ' . $user->lname }}</option>
                    @endforeach
                </x-component::form.select>
            </div>
            <div class="col-12 col-md-6">
                <x-component::form.prepend-input type='date' label='Project Deadline' name="deadline_date"
                    iconName="calendar" :required='true' wire:model.defer='deadline_date' />
            </div>


            <div class="col-12 col-md-12 mb-3">
                <button class="btn btn-primary float-right" type="button" wire:click="addForm()">
                    Add More
                </button>
            </div>
        </div>

        @foreach ($dynamicForm as $index => $form)
            <div class="row border mb-3 p-2 rounded">
                <div class="col-12 col-md-6">

                    <div class="form-group">
                        <label>Job Accomplish</span>
                            <span class="text-danger">*</span>
                            @error('dynamicForm.' . $index . '.user_deadline_accomplish_date')
                                <span class="font- text-danger ml-1" style="font-size: 12px;"> [ {{ $message }}
                                    ]</span>
                            @enderror
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar"></i>
                                </div>
                            </div>
                            <input wire:model='dynamicForm.{{ $index }}.user_deadline_accomplish_date'
                                type="date"
                                class="form-control @error('dynamicForm.' . $index . '.user_deadline_accomplish_date') is-invalid @enderror">
                        </div>
                    </div>


                </div>
                <div class="col-12 col-md-6">

                    <div class="form-group">
                        <label>Job</span>
                            <span class="text-danger">*</span>
                            @error('dynamicForm.' . $index . '.job')
                                <span class="font- text-danger ml-1" style="font-size: 12px;"> [ {{ $message }}
                                    ]</span>
                            @enderror
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar"></i>
                                </div>
                            </div>
                            <input wire:model='dynamicForm.{{ $index }}.job' type="text"
                                class="form-control @error('dynamicForm.' . $index . '.job') is-invalid @enderror">
                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-6">
                    <x-component::form.select label='Responsible' :required='true' name='user_id'
                        wire:model='dynamicForm.{{ $index }}.user_id'>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->fname . ' ' . $user->lname }}</option>
                        @endforeach

                    </x-component::form.select>
                    {{-- @error('dynamicForm.' . $index . '.user_id')
                        <span class="text-danger">

                            {{ $message }}
                        </span>
                    @enderror --}}
                </div>
                <div class="col-12 col-md-12">

                    <button wire:click='removeForm({{ $index }})' class="btn btn-danger float-right"
                        type="button" title="Remove">Remove</button>
                </div>
            </div>
        @endforeach
        <x-component::button btnType="success " name="submit" wire:loading.attr='disabled' />
    </form>

</div>
