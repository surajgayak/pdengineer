<x-component::layout>
    <x-slot:title>
        Bank Guarantee & Retention Money
    </x-slot:title>
    <x-component::breadcrumb>
        <li>
            <a class="text-decoration-none" href="{{ route('tracking.index') }}">
                Bank Guarantee & Retention Money
            </a>
        </li>
        <li class=" mx-1">
            <i class="text-center
        fas fa-chevron-right" style="margin-top: 8px; font-size:10px;"></i>
        </li>
        <li>

            <p class="text-decoration-none">
                Create
            </p>
        </li>
    </x-component::breadcrumb>
    <div class="section-body">

        <div class="row">
            <div class="col-12 col-md-12">

                <x-component::card card_header="Bank Guarantee & Retention Money" :hasBack='true' :route="route('tracking.index')">

                    @livewire('tracking-bank-guarantee.tracking-bank-guarantee-create')


                </x-component::card>

            </div>
        </div>
    </div>

</x-component::layout>
