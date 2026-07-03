<nav class="elegant-navbar" id="elegantNavbar">
    <div class="container">
        <div class="elegant-navbar__inner">

            <a href="<?= base_url('/') ?>" class="elegant-navbar__logo">
                <span class="elegant-navbar__logo-mark">SR</span>
                <span class="elegant-navbar__logo-text">
                    Sidodadi<em>Residence</em>
                </span>
            </a>

            <?php $current = trim(uri_string(), '/'); ?>

            <ul class="elegant-navbar__menu d-none d-lg-flex">
                <li class="<?= $current === '' ? 'is-active' : '' ?>">
                    <a href="<?= base_url('/') ?>">Home</a>
                </li>
                <li class="<?= str_starts_with($current, 'about') ? 'is-active' : '' ?>">
                    <a href="<?= base_url('/about') ?>">Tentang</a>
                </li>
                <li class="<?= str_starts_with($current, 'properties') ? 'is-active' : '' ?>">
                    <a href="<?= base_url('/properties') ?>">Properti</a>
                </li>
                <li class="<?= str_starts_with($current, 'services') ? 'is-active' : '' ?>">
                    <a href="<?= base_url('/services') ?>">Services</a>
                </li>
                <li class="<?= str_starts_with($current, 'contact') ? 'is-active' : '' ?>">
                    <a href="<?= base_url('/contact') ?>">Kontak</a>
                </li>
            </ul>

            <!-- <div class="elegant-navbar__actions">
                <a href="<?= base_url('/contact') ?>" class="elegant-navbar__cta d-none d-lg-inline-flex">
                    Konsultasi
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>

                <button type="button" class="elegant-navbar__toggle d-lg-none" id="elegantNavbarToggle" aria-label="Buka menu" aria-expanded="false" aria-controls="elegantNavbarDrawer">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div> -->

        </div>
    </div>

    <!-- Mobile drawer -->
    <div class="elegant-navbar__backdrop" id="elegantNavbarBackdrop"></div>
    <aside class="elegant-navbar__drawer" id="elegantNavbarDrawer" aria-hidden="true">
        <div class="elegant-navbar__drawer-head">
            <span class="elegant-navbar__logo-text elegant-navbar__logo-text--dark">
                Sidodadi<em>Residence</em>
            </span>
            <button type="button" class="elegant-navbar__close" id="elegantNavbarClose" aria-label="Tutup menu">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>
        </div>

        <ul class="elegant-navbar__drawer-menu">
            <li class="<?= $current === '' ? 'is-active' : '' ?>">
                <a href="<?= base_url('/') ?>">Home</a>
            </li>
            <li class="<?= str_starts_with($current, 'about') ? 'is-active' : '' ?>">
                <a href="<?= base_url('/about') ?>">Tentang</a>
            </li>
            <li class="<?= str_starts_with($current, 'properties') ? 'is-active' : '' ?>">
                <a href="<?= base_url('/properties') ?>">Properti</a>
            </li>
            <li class="<?= str_starts_with($current, 'services') ? 'is-active' : '' ?>">
                <a href="<?= base_url('/services') ?>">Services</a>
            </li>
            <li class="<?= str_starts_with($current, 'contact') ? 'is-active' : '' ?>">
                <a href="<?= base_url('/contact') ?>">Kontak</a>
            </li>
        </ul>

        <a href="<?= base_url('/contact') ?>" class="elegant-navbar__cta elegant-navbar__cta--block">
            Konsultasi Sekarang
        </a>
    </aside>
</nav>

<script>
(function () {
    var navbar = document.getElementById('elegantNavbar');
    var toggle = document.getElementById('elegantNavbarToggle');
    var closeBtn = document.getElementById('elegantNavbarClose');
    var drawer = document.getElementById('elegantNavbarDrawer');
    var backdrop = document.getElementById('elegantNavbarBackdrop');

    function onScroll() {
        if (window.scrollY > 24) {
            navbar.classList.add('is-scrolled');
        } else {
            navbar.classList.remove('is-scrolled');
        }
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    function openDrawer() {
        drawer.classList.add('is-open');
        backdrop.classList.add('is-open');
        drawer.setAttribute('aria-hidden', 'false');
        toggle.setAttribute('aria-expanded', 'true');
        toggle.classList.add('is-active');
        document.body.style.overflow = 'hidden';
    }

    function closeDrawer() {
        drawer.classList.remove('is-open');
        backdrop.classList.remove('is-open');
        drawer.setAttribute('aria-hidden', 'true');
        toggle.setAttribute('aria-expanded', 'false');
        toggle.classList.remove('is-active');
        document.body.style.overflow = '';
    }

    toggle.addEventListener('click', function () {
        drawer.classList.contains('is-open') ? closeDrawer() : openDrawer();
    });
    closeBtn.addEventListener('click', closeDrawer);
    backdrop.addEventListener('click', closeDrawer);
})();
</script>