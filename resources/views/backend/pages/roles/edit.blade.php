<x-component::layout>
    <x-slot:title>
        Edit Role
    </x-slot:title>
    <x-component::breadcrumb>
        <li>
            <a class="text-decoration-none" href="{{route('roles.index')}}">
                Roles
            </a>
        </li>
        <li class=" mx-1">
            <i class="text-center
            fas fa-chevron-right" style="margin-top: 8px; font-size:10px;"></i>
        </li>
        <li>
            <p class="text-decoration-none">
                edit
            </p>
        </li>
    </x-component::breadcrumb>
    <div class="section-body">

        <div class="row">
            <div class="col-12 col-md-12">

                <x-component::card card_header="Edit role" :hasBack='true' :route="route('roles.index')">
                    @livewire('roles.role-edit', ['role_data' => $role])
                </x-component::card>
            </div>
        </div>
    </div>

</x-component::layout>
