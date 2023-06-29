<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'PD')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('frontend/css/splide.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/aos.css') }}">

    <style>
        .description {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
            overflow: hidden;
        }

        .splide__arrow--prev,
        .splide__arrow--next {
            background-color: #fff !important;
        }

        .splide__arrow {
            /* top: 0; */
        }

        button.splide__arrow--prev {
            left: auto;
            right: 3rem;
            background-color: #f9fafb;
            padding: 0.2rem;
        }

        button.splide__arrow--next {
            right: 1rem;
            background-color: #f9fafb;
            padding: 0.2rem;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
