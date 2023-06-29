<x-component::layout>
    <x-slot:title>
        Users
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
            <a class="text-decoration-none" href="{{ route('users.index') }}">
                Users
            </a>
        </li>
    </x-component::breadcrumb>


    <div class="row">
        <div class="col-12 col-md-12">

            <x-component::card cardHeader="Users" :hasCreate='true' :route="route('users.create')" ability="user_create">
                <x-component::table.table id="users">
                    <x-component::table.head>
                        <x-component::table.heading name="No" />
                        <x-component::table.heading name="Name" />
                        <x-component::table.heading name="Email" />
                        <x-component::table.heading name="Position" />
                        @if (auth()->user()->can('user_edit') ||
                                auth()->user()->can('user_delete'))
                            <x-component::table.heading name="Action" />
                        @endif
                    </x-component::table.head>
                    <x-component::table.body>
                        @foreach ($users as $user)
                            <x-component::table.row>
                                <x-component::table.data :value='$loop->iteration' />
                                <x-component::table.data :value="$user->fname . ' ' . $user->lname ?? ' ' " />
                                <x-component::table.data :value='$user->email' />
                                <x-component::table.data :value='$user->position' />
                                @if (auth()->user()->can('user_edit') ||
                                        auth()->user()->can('user_delete'))
                                    <x-component::table.data :hasMultiElement='true'>
                                        @can('user_edit')
                                            <x-component::table.edit :route="route('users.edit', ['user' => $user])" />
                                        @endcan
                                        @can('user_delete')
                                            <x-component::table.trash :route="route('users.delete', ['user' => $user])" />
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


