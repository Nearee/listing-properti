<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
            <span class="icon-close js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>

<nav class="site-nav">
    <div class="container">
        <div class="menu-bg-wrap">
            <div class="site-navigation">
                <a href="<?= base_url('/') ?>" class="logo m-0 float-start">Sidodadi Residence</a>

                <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">

                    <li class="<?= url_is('') || url_is('/') ? 'active' : '' ?>">
                        <a href="<?= base_url('/') ?>">Home</a>
                    </li>

                    <li class="<?= url_is('about') ? 'active' : '' ?>">
                        <a href="<?= base_url('/about') ?>">Tentang</a>
                    </li>

                    <li class="<?= url_is('properties') ? 'active' : '' ?>">
                        <a href="<?= base_url('/properties') ?>">Properti</a>
                    </li>

                    <li class="<?= url_is('services') ? 'active' : '' ?>">
                        <a href="<?= base_url('/services') ?>">Services</a>
                    </li>


                    <li class="<?= url_is('contact') ? 'active' : '' ?>">
                        <a href="<?= base_url('/contact') ?>">Kontak</a>
                    </li>

                </ul>

                <a href="#"
                    class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none">
                    <span></span>
                </a>
            </div>
        </div>
    </div>
</nav>