<div>

    @if ($trackingBankGuaranteeData->status == 0)
        <a data-toggle="modal" data-target="#bankGuarantee_status_{{ $trackingBankGuaranteeData->id }}"
            class="text-danger font-weight-bold" href="#">Expired To Be Refunded</a>
    @elseif($trackingBankGuaranteeData->status == 1)
        <a data-toggle="modal" data-target="#bankGuarantee_status_{{ $trackingBankGuaranteeData->id }}"
            class="font-weight-bold text-muted" href="#">Refunded</a>
    @else
        <a data-toggle="modal" data-target="#bankGuarantee_status_{{ $trackingBankGuaranteeData->id }}"
            class="text-success font-weight-bold" href="#">Active</a>
    @endif
        <x-component::modal id="bankGuarantee_status_{{ $trackingBankGuaranteeData->id }}" title="Tracking Bank Guarantee Status">
            <div class="row">
                <div class="col-12">
                    <form wire:submit.prevent='updateStatus'>
                        <x-component::form.select label="Status" name="status" :required='true' wire:model='status'>
                            @foreach (TrackingStatus::getAllTrackingStatus() as $key => $value)
                                <option value="{{ $value }}">{{ $key }}</option>
                            @endforeach
                        </x-component::form.select>
                        <x-component::button btnType="success" name="submit" wire:loading.attr='disabled' />
                        <span wire:loading wire:target="updateStatus" class="text-danger">Please wait...</span>
                    </form>

                </div>
            </div>
        </x-component::modal>
</div>
@push('scripts')
    <script>
        Livewire.on('hideModal', event => {
            $('.modal').modal('hide');
        });
    </script>
@endpush
