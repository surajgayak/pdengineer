<x-component::layout>
    <x-slot:title>
        Projects
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
            <a class="text-decoration-none" href="{{ route('permissions.index') }}">
                Permissions
            </a>
        </li>
    </x-component::breadcrumb>


    <div class="row">
        <div class="col-12 col-md-12">

            <x-component::card cardHeader="Permissions" :hasCreate='true' :route="route('permissions.create')">
                <x-component::table.table>
                    <x-component::table.head>
                        <x-component::table.heading name="No" />
                        <x-component::table.heading name="Image" />
                        <x-component::table.heading name="Title" />
                        <x-component::table.heading name="Action" />
                    </x-component::table.head>
                    <x-component::table.body>
                        @foreach ($permissions as $permission)
                            <x-component::table.row>
                                <x-component::table.data :value='$loop->iteration' />
                                <x-component::table.data :hasMultiElement='true'>
                                    <img src="{{ \Storage::url($permission->image) }}" height="60" width="60" />
                                </x-component::table.data>

                                <x-component::table.data :value='$permission->title' />

                                <x-component::table.data :hasMultiElement='true'>
                                    <x-component::table.edit :route="route('permissions.edit', ['permission' => $permission])" />
                                    <x-component::table.trash :route="route('permissions.delete', ['permission' => $permission])" />
                                </x-component::table.data>
                            </x-component::table.row>
                        @endforeach
                    </x-component::table.body>
                </x-component::table.table>
            </x-component::card>
        </div>
    </div>

</x-component::layout>
