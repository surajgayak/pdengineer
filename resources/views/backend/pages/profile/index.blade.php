<x-component::layout>
    <x-slot:title>
        Products
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
            <a class="text-decoration-none" href="{{ route('profile.index') }}">
                Profile
            </a>
        </li>
    </x-component::breadcrumb>


    {{-- <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-4"> --}}
                @livewire('profile')
        {{-- </div>
    </div> --}}

</x-component::layout>
