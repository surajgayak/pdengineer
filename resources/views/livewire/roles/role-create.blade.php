<div>
    <form wire:submit.prevent='store'>
        <div class="row">
            <div class="col-12 col-md-12">
                <x-component::form.prepend-input type='text' label='Name' name="name" iconName="marker"
                    :required='true' wire:model.defer='name' />
            </div>


            <div class="col-lg-12">
                <div class="checkbox p-1 ">
                    <p>Assign Permissions
                        @error('role_permissions')
                            <span class="text-danger">
                                [ {{ $message }} ]
                            </span>
                        @enderror
                    </p>

                    @foreach ($permissions as $permission)
                        <x-component::form.checkbox :title="$permission->name" :value='$permission->id' wire:model='role_permissions' />
                    @endforeach
                </div>
            </div>
        </div>
        <x-component::button btnType="success " name="submit" wire:loading.attr='disabled' />
    </form>
</div>
