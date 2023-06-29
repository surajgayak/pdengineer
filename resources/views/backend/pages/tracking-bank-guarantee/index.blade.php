<x-component::layout>
    <x-slot:title>
        Tracking Bank Guarantee & Retention Money
    </x-slot:title>
    <x-component::breadcrumb>
        <li>
            <span class="text-decoration-none">
                Home
            </span>
        </li>
        <li class=" mx-1">
            <i class="text-center
        fas fa-chevron-right" style="margin-top: 7px; font-size:10px;"></i>
        </li>
        <li>
            <a class="text-decoration-none" href="{{ route('tracking.index') }}">
                Tracking Bank Guarantee & Retention Money
            </a>
        </li>
    </x-component::breadcrumb>
    <div class="row">
        <div class="col-12 col-md-12">

            <x-component::card cardHeader="Tracking Bank Guarantee & Retention Money" :hasCreate='true' :route="route('tracking.create')"
                ability="bank_guarantee_retention_money_create">
                <div class="mb-2 flex">

                    <a href={{ route('tracking.export.excel') }} class="btn btn-success">Export Excel</a>
                    <br><br>
                    <p>Total Hold Amount : Rs.
                        {{ DB::table('tracking_bank_guarantees')->whereNull('deleted_at')->sum('hold_amount') }}
                    </p>

                </div>
                <x-component::table.table id="tracking-back-guarantee">
                    <x-component::table.head>
                        <x-component::table.heading name="No" />
                        <x-component::table.heading name="Type" />
                        <x-component::table.heading name="Start Date" />
                        <x-component::table.heading name="Project Name" />
                        <x-component::table.heading name="Client Name" />
                        <x-component::table.heading name="Total Amount" />
                        <x-component::table.heading name="Hold Amount" />
                        <x-component::table.heading name="Bank Name" />
                        <x-component::table.heading name="Expiry Date" />
                        @can('bank_guarantee_retention_money_update_status')
                            <x-component::table.heading name="Status" />
                        @endcan



                        @if (auth()->user()->can('bank_guarantee_retention_money_edit') ||
                                auth()->user()->can('bank_guarantee_retention_money_delete'))
                            <x-component::table.heading name="Action" />
                        @endif
                    </x-component::table.head>
                    <x-component::table.body>
                        @foreach ($trackings as $tracking)
                            <x-component::table.row>
                                <x-component::table.data :value='$loop->iteration' />
                                <x-component::table.data :hasMultiElement='true'>
                                    @foreach (TrackingType::getAllTrackingType() as $key => $value)
                                        @if ($value == $tracking->type)
                                            {{ $key }}
                                        @endif
                                    @endforeach
                                </x-component::table.data>
                                <x-component::table.data :value='$tracking->start_date' />
                                <x-component::table.data :value='$tracking->project_name' />
                                <x-component::table.data :value='$tracking->client_name' />
                                <x-component::table.data :value='$tracking->total_amount' />
                                <x-component::table.data :value='$tracking->hold_amount' />

                                <x-component::table.data :value='$tracking->bank_name' />


                                <x-component::table.data :value='$tracking->expiry_date' />
                                @can('bank_guarantee_retention_money_update_status')
                                    <x-component::table.data :hasMultiElement='true'>
                                        @livewire('tracking-bank-guarantee.tracking-bank-guarantee-status', ['trackingBankGuaranteeData' => $tracking], key('tracking_bank_' . $tracking->id))
                                    </x-component::table.data>
                                @endcan

                                @if (auth()->user()->can('bank_guarantee_retention_money_edit') ||
                                        auth()->user()->can('bank_guarantee_retention_money_delete'))
                                    <x-component::table.data :hasMultiElement='true'>
                                        @can('bank_guarantee_retention_money_edit')
                                            <x-component::table.edit :route="route('tracking.edit', ['tracking' => $tracking])" />
                                        @endcan
                                        @can('bank_guarantee_retention_money_delete')
                                            <x-component::table.trash :route="route('tracking.delete', ['tracking' => $tracking])" />
                                        @endcan
                                    </x-component::table.data>
                                @endif
                            </x-component::table.row>
                        @endforeach
                    </x-component::table.body>
                </x-component::table.table>
            </x-component::card>


        </div>
    </div>

</x-component::layout>
