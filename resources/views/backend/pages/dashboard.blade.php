<x-component::layout>
    <x-slot:title>
        Dashboard
    </x-slot:title>

    @if (auth()->user()->user_type == 1)
        @include('backend.include.dashboard-content')
    @endif
</x-component::layout>
