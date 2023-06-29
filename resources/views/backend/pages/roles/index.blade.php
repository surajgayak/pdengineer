<x-component::layout>
    <x-slot:title>
        Roles
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
            <a class="text-decoration-none" href="{{ route('roles.index') }}">
                Roles
            </a>
        </li>
    </x-component::breadcrumb>


    <div class="row">
        <div class="col-12 col-md-12">

            <x-component::card cardHeader="Roles" :hasCreate='true' :route="route('roles.create')">
                <x-component::table.table id="roles">
                    <x-component::table.head>
                        <x-component::table.heading name="No" />
                        <x-component::table.heading name="Name" />
                        <x-component::table.heading name="Permissions" />
                        <x-component::table.heading name="Action" />
                    </x-component::table.head>
                    <x-component::table.body>
                        @foreach ($roles as $role)
                            <x-component::table.row>
                                <x-component::table.data :value='$loop->iteration' />
                                <x-component::table.data :value='$role->name' />
                                <x-component::table.data :hasMultiElement='true'>
                                    @foreach ($role->permissions as $permission)
                                        <span class="badge badge-light m-1" style="font-size: 12px;">
                                            <i class="fas fa-unlock-alt text-success" style="font-size: 10px;"></i>
                                            {{ $permission->name }}</span>
                                    @endforeach
                                </x-component::table.data>

                                <x-component::table.data :hasMultiElement='true'>
                                    <x-component::table.edit :route="route('roles.edit', ['role' => $role])" />
                                    <x-component::table.trash :route="route('roles.delete', ['role' => $role])" />
                                </x-component::table.data>
                            </x-component::table.row>
                        @endforeach
                    </x-component::table.body>
                </x-component::table.table>
            </x-component::card>
        </div>
    </div>

</x-component::layout>
