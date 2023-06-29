<!--👇 BREADCRUMB SECTION 👇-->
<nav aria-label="Bread crumb">
    <div class="mx-auto max-w-screen-xl px-4 py-4">
        <ul class="flex items-center gap-x-6">
            <li>
                <a href="{{route('welcome')}}" class="cursor-pointer hover:text-purple-600 font-medium text-sm">Home</a>
            </li>
            {{ $slot }}
        </ul>
    </div>
</nav>
<!-- ********************** -->
