@extends('layouts.app')
@section('title', 'PD Engineering')
@section('content')



    <div class="mx-auto flex justify-center items-center mt-[25%] ">
        <div>
            <h1 class="text-5xl text-white first-letter:text-7xl first-letter:text-blue-900 tracking-wider">Welcome To
                PDE Engineering
            </h1>
            <a href="{{ route('login') }}" class="  text-white  shadow-md float-right px-4 py-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rotate-180 hover:scale-125 transition-all"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>


@endsection
