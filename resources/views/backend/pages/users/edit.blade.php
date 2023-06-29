<x-component::layout>
    <x-slot:title>
        Edit | User
    </x-slot:title>
    <x-component::breadcrumb>
        <li>
            <a class="text-decoration-none" href="{{route('users.index')}}">
                Users
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

                <x-component::card card_header="Edit user" :hasBack='true' :route="route('users.index')">
                    @livewire('users.user-edit', ['user_data' => $user])
                </x-component::card>
            </div>
        </div>
    </div>

</x-component::layout>
