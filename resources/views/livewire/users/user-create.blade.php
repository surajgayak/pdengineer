<div>
    <form wire:submit.prevent='store'>
        <div class="row">
            <div class="col-12">
                <div class="text-danger" wire:loading wire:target='avatar'>Uploading...</div>
                @if ($avatar)
                    <img class="img-responsive rounded mb-2" wire: src="{{ $avatar->temporaryUrl() }}" alt=""
                        width="60" height="60">
                @endif
            </div>

            <div class="col-12 col-md-6">
                <x-component::form.prepend-input type='file' label='Avatar (100 * 90)' name="avatar" iconName="image"
                    wire:model.defer='avatar' />

            </div>

            <div class="col-12 col-md-6">
                <x-component::form.select label="Roles" :required='true' name="role_id" wire:model='role_id'>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </x-component::form.select>
            </div>

            <div class="col-12 col-md-6">

                <x-component::form.prepend-input type='text' label='First Name' name="fname" iconName="marker"
                    :required='true' wire:model.defer='fname' />
            </div>
            <div class="col-12 col-md-6">
                <x-component::form.prepend-input type='text' label='Last Name' name="lname"
                    iconName="fire-extinguisher" wire:model.defer='lname' />
            </div>

            <div class="col-12 col-md-6">
                <x-component::form.prepend-input type='email' label='Email' name="email" iconName="envelope"
                    :required='true' wire:model.defer='email' />
            </div>

            <div class="col-12 col-md-6">
                <x-component::form.prepend-input type='tel' label='Phone No' name="phone_no" iconName="phone"
                    wire:model.defer='phone_no' />
            </div>
            <div class="col-12 col-md-6">
                @error('gender')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-check d-md-flex d-lg-flex">
                    @foreach (GenderType::getAllGenderType() as $key => $value)
                        <div class="custom-control custom-radio {{ $loop->iteration == 2 ? 'mx-md-4 mx-lg-4' : '' }}">
                            <input wire:model='gender' type="radio" id="customRadio{{ $value }}" name="gender"
                                class="custom-control-input" value="{{ $value }}">
                            <label class="custom-control-label"
                                for="customRadio{{ $value }}">{{ $key }}</label>
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="col-12 col-md-6">
                <x-component::form.prepend-input type='text' label='Position' name="position" iconName="user-tie"
                    :required='true' wire:model.defer='position' />
            </div>


        </div>

        <x-component::button btnType="success " name="submit" wire:loading.attr='disabled' />

        <div wire:loading.delay wire:target="store">
            <span class="text-danger">
                Please wait assiging permissions.
            </span>
        </div>

    </form>

</div>
