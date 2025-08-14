<script src="/bs/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".swiper-container", {
        spaceBetween: 30,
        effect: "fade",
        loop: true,
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
    },
        pagination: {
            el: '.swiper-pagination',
        },
        // And if we need scrollbar
        scrollbar: {
            el: '.swiper-scrollbar',
        },
    });
</script>
<script>
        window.addEventListener("scroll", function() {
    var navbar = document.querySelector(".navbar");
    if (window.scrollY > 0) {
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
    });

    window.addEventListener('resize', function() {
    toggleDropdownPosition();
});

// Mengatur posisi dropdown berdasarkan ukuran layar
function toggleDropdownPosition() {
var dropdownMenu = document.querySelector('.dropdown-menu');

if (window.innerWidth < 992) {
    dropdownMenu.classList.remove('dropdown-menu-end');
    dropdownMenu.classList.add('dropdown-menu-start');
} else {
    dropdownMenu.classList.remove('dropdown-menu-start');
    dropdownMenu.classList.add('dropdown-menu-end');
}
}
toggleDropdownPosition();
</script>
{{-- @yield('script') --}}
@stack('script')
