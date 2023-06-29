<x-component::layout>
    <x-slot:title>
        Tracking Project
    </x-slot:title>
    <x-component::breadcrumb>
        <li class="border-top">
            <span class="text-decoration-none">
                Home
            </span>
        </li>
        <li class=" mx-1">
            <i class="text-center
        fas fa-chevron-right" style="margin-top: 7px; font-size:10px;"></i>
        </li>
        <li>
            <a class="text-decoration-none" href="{{ route('trackingProject.index') }}">
                Tracking Project
            </a>
        </li>
    </x-component::breadcrumb>
    {{-- <ul class="row list-unstyled d-flex justify-content-center alignitems-center">

        <i data-feather="circle"></i>
        <li class="border-top col-2 col-md-2">

            Lorem ipsum dolor sit amet.
        </li>
        <li class="border-top col-2 col-md-2">

            Lorem ipsum dolor sit amet.
        </li>
        <li class="border-top col-2 col-md-2">

            Lorem ipsum dolor sit amet.
        </li>
        <li class="border-top col-2 col-md-2">

            Lorem ipsum dolor sit amet.
        </li>
        <li class="border-top col-2 col-md-2">

            Lorem ipsum dolor sit amet.
        </li>

    </ul> --}}
    @livewire('tracking-project.tracking-project-timeline')

</x-component::layout>
