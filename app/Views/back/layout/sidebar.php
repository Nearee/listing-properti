<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="<?= base_url('admin/dashboard') ?>">
                        <h4 class="mb-0 text-primary"><i class="bi bi-building-fill me-2"></i>Dev Property</h4>
                    </a>
                </div>
                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide-xl d-block d-xl-none"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Utama</li>

                <li class="sidebar-item <?= url_is('/dashboard') ? 'active' : '' ?>">
                    <a href="<?= base_url('/dashboard') ?>" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-title">Manajemen Listing</li>

                <li class="sidebar-item has-sub <?= url_is('/lokasi*') || url_is('/blok*') || url_is('/properti*') ? 'active' : '' ?>">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-house-door-fill"></i>
                        <span>Katalog Properti</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item <?= url_is('/lokasi*') ? 'active' : '' ?>">
                            <a href="<?= base_url('/lokasi') ?>" class="submenu-link"><i class="bi bi-geo-alt-fill me-2"></i>Data Lokasi</a>
                        </li>
                        <li class="submenu-item <?= url_is('/blok*') ? 'active' : '' ?>">
                            <a href="<?= base_url('/blok') ?>" class="submenu-link"><i class="bi bi-grid-3x3-gap-fill me-2"></i>Data Blok</a>
                        </li>
                        <li class="submenu-item <?= url_is('/properti*') ? 'active' : '' ?>">
                            <a href="<?= base_url('/properti') ?>" class="submenu-link"><i class="bi bi-houses-fill me-2"></i>Unit Rumah</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-title">Konten & Marketing</li>

                <!-- <li class="sidebar-item <?= url_is('admin/layanan*') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/layanan') ?>" class='sidebar-link'>
                        <i class="bi bi-briefcase-fill"></i>
                        <span>Layanan Kami</span>
                    </a>
                </li> -->

                <li class="sidebar-item <?= url_is('admin/galeri*') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/galeri') ?>" class='sidebar-link'>
                        <i class="bi bi-images"></i>
                        <span>Slider Foto</span>
                    </a>
                </li>

                <li class="sidebar-item <?= url_is('admin/ulasan*') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/ulasan') ?>" class='sidebar-link'>
                        <i class="bi bi-chat-left-heart-fill"></i>
                        <span>Ulasan Klien</span>
                    </a>
                </li>

                <li class="sidebar-item <?= url_is('/anggota-tim*') ? 'active' : '' ?>">
                    <a href="<?= base_url('/anggota-tim') ?>" class='sidebar-link'>
                        <i class="bi bi-people-fill"></i>
                        <span>Anggota Tim</span>
                    </a>
                </li>

                <li class="sidebar-title">Komunikasi</li>

                <li class="sidebar-item <?= url_is('admin/pesan*') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/pesan') ?>" class='sidebar-link'>
                        <i class="bi bi-envelope-open-fill"></i>
                        <span>Pesan Masuk</span>
                    </a>
                </li>

                <li class="sidebar-title">Pengaturan Umum</li>

                <li class="sidebar-item <?= url_is('/profilperusahaan*') ? 'active' : '' ?>">
                    <a href="<?= base_url('/profilperusahaan') ?>" class='sidebar-link'>
                        <i class="bi bi-building-gear"></i>
                        <span>Profil Instansi</span>
                    </a>
                </li>

                <li class="sidebar-item <?= url_is('/pengaturan*') ? 'active' : '' ?>">
                    <a href="<?= base_url('/pengaturan') ?>" class='sidebar-link'>
                        <i class="bi bi-gear"></i>
                        <span>Pengaturan</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="<?= base_url('logout') ?>" class='sidebar-link text-danger'>
                        <i class="bi bi-box-arrow-right text-danger"></i>
                        <span>Keluar (Logout)</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>