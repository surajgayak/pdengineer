<div>
    <form wire:submit.prevent='store'>
        <div class="row">
            <div class="col-12 col-md-6">
                <x-component::form.select label='Type' :required='true' name='type' wire:model.defer='type'>
                    @foreach (TrackingType::getAllTrackingType() as $key => $value)
                        <option value="{{ $value }}">{{ $key }}</option>
                    @endforeach
                </x-component::form.select>
            </div>


            <div class="col-12 col-md-6">
                <x-component::form.prepend-input type='date' label='Date' name="start_date" iconName="calendar"
                    :required='true' wire:model.defer='start_date' />
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
                <x-component::form.prepend-input type='number' label='Total amount' name="total_amount"
                    iconName="dollar-sign" :required='true' wire:model.defer='total_amount' />
            </div>

            <div class="col-12 col-md-6">
                <x-component::form.prepend-input type='number' label='Hold Amount' name="hold_name"
                    iconName="dollar-sign" :required='true' wire:model.defer='hold_amount' disabled
                    id="hold_amount_input" />
            </div>
            {{-- <div class="col-12 col-md-6">
                @if ($type == 'Retentaion' || $type == 'Custom margin')
                    <x-component::form.prepend-input type='number' label='Hold Amount' name="hold_name"
                        iconName="dollar-sign" :required='true' wire:model.defer='hold_amount' disabled />
                @else
                    <x-component::form.prepend-input type='number' label='Hold Amount' name="hold_name"
                        iconName="dollar-sign" :required='true' wire:model.defer='hold_amount' />
                @endif
            </div> --}}


            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('type').addEventListener('change', function() {
                        var holdAmountInput = document.getElementById('hold_amount_input');
                        var selectedOption = this.value;

                        if (selectedOption === 'Retention' || selectedOption === 'Custom margin') {
                            holdAmountInput.disabled = true;
                        } else {
                            holdAmountInput.disabled = false;
                        }
                    });
                });
            </script>



            <div class="col-12 col-md-6">
                <x-component::form.prepend-input type='text' label='Bank Name' name="bank_name" iconName="marker"
                    wire:model.defer='bank_name' />
            </div>
            <div class="col-12 col-md-6">
                <x-component::form.prepend-input type='date' label='Expiry Date' name="expiry_date"
                    iconName="calendar" :required='true' wire:model.defer='expiry_date' />
            </div>



        </div>
        <x-component::button btnType="success " name="submit" wire:loading.attr='disabled' />
        <span wire:loading wire:target="store" class="text-danger">
            Creating...
        </span>

    </form>
</div>
