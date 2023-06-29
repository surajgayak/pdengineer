<div>
    @foreach ($dynamicForm as $index => $form)
        <div class="row border mb-3 p-2 rounded">
            <div class="col-12 col-md-6">
                <x-component::form.prepend-input type='date' label='Job Accomplish' name="user_deadline_accomplish_date"
                    iconName="calendar" :required='true'
                    wire:model='dynamicForm.{{ $index }}.user_deadline_accomplish_date' />
            </div>
            <div class="col-12 col-md-6">
                <x-component::form.prepend-input type='text' label='Job' name="job" iconName="calendar"
                    :required='true' wire:model='dynamicForm.{{ $index }}.job' />
            </div>
            <div class="col-12 col-md-6">
                <x-component::form.select label='Responsible' :required='true' name='user_id'
                    wire:model='dynamicForm.{{ $index }}.user_id'>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->fname . ' ' . $user->lname }}</option>
                    @endforeach
                </x-component::form.select>
            </div>
            <div class="col-12 col-md-12">

                <button wire:click='removeForm({{ $index }})' class="btn btn-danger float-right" type="button"
                    title="Remove">Remove</button>
            </div>
        </div>
    @endforeach

    <x-component::button btnType="success " name="submit" wire:loading.attr='disabled' />
</div>
