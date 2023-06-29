<script src="{{ asset('frontend/js/splide.js') }}"></script>
<script src="{{ asset('frontend/js/aos.js') }}"></script>
<script src="{{ asset('frontend/js/plugin.js') }}"></script>
{{-- <script src="//unpkg.com/alpinejs" defer></script> --}}

<script>
    AOS.init();

    document.addEventListener("DOMContentLoaded", function() {


        if (document.querySelector("#slider")) {
            new Splide("#slider", {
                type: "loop",
                perPage: 1,
                autoplay: true,
                interval: 5000,
                updateOnMove: true,
                pagination: false,
            }).mount();
        }

    });

    function removeTabClass(e) {
        document.querySelectorAll(".tab-btn").forEach((item) => {
            item.classList.remove("text-gray-600");
            item.classList.remove("text-purple-600");
            item.classList.add("text-gray-600");
        });
        e.classList.remove("text-gray-600");
        e.classList.add("text-purple-600");
        document.querySelectorAll(".tab-body").forEach((item) => {
            item.classList.add("hidden");
            if (e.getAttribute("data-ref") == item.getAttribute("data-id")) {
                item.classList.remove("hidden");
            }
        });
    }
</script>
@livewireScripts
