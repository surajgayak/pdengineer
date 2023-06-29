<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ 'PD | ' . $title ?? 'PD' }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/app.min.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/custom.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('logo/favicon.ico') }}' />

    <link rel="stylesheet" href="{{ asset('backend/assets/bundles/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('backend/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">


    <link rel="stylesheet" href="{{ asset('backend/assets/bundles/prism/prism.css') }}">

    {{-- <link rel="stylesheet" href="{{asset('backend/assets/bundles/izitoast/css/iziToast.min.css')}}"> --}}
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}

    <link rel="stylesheet" href="{{ asset('backend/assets/bundles/summernote/summernote-bs4.css') }}">

    {{-- @if (url()->current() == route('trackingProject.index') || url()->current() == route('stock.management.index')) --}}
        <style>
            .buttons-excel {
                display: none !important;
            }

            .buttons-pdf {
                display: none !important;

            }
        </style>
    {{-- @else --}}
        {{-- <style>
            .buttons-excel {
                display: none !important;
            }

            .buttons-pdf {
                display: none !important;

            }
        </style> --}}
    {{-- @endif --}}




    @stack('css')




    @livewireStyles
    @vite(['resources/views/backend/css/app.css', 'resources/views/backend/js/app.js'])

</head>
