<!DOCTYPE html>
<html lang="en">
@include('backend.include.head')

<body>
    @php
        $setting = \App\Models\Setting::first();
    @endphp
    @include('backend.include.toastr')
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            @include('backend.include.navbar')
            @include('backend.include.sidebar')

            <div class="main-content">
                <section class="section-body">
                    {{ $slot }}
                </section>
                {{-- @include('backend.include.sidebar-setting') --}}
            </div>
        </div>
    </div>



    @include('backend.include.script')


</body>

</html>
