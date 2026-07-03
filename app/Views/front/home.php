<?php $this->extend('front/index') ?>
<?php $this->section('content') ?>

<div class="hero">
    <div class="hero-slide">
        <?php if (empty($galeri)): ?>
            <!-- Gambar Default/Fallback -->
            <div class="img overlay" style="background-image: url('<?= base_url('assets/images/type40.jpg') ?>')"></div>
            <div class="img overlay" style="background-image: url('<?= base_url('assets/images/bg1.jpeg') ?>')"></div>
        <?php else: ?>
            <!-- Looping Otomatis Gambar dari Galeri Admin -->
            <?php foreach ($galeri as $item): ?>
                <div class="img overlay" style="background-image: url('<?= base_url($item['gambar_url']) ?>')"></div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-8 text-center">
                <h1 class="heading text-white" data-aos="fade-up">
                    Temukan Hunian Nyaman untuk Masa Depan Anda
                </h1>
                <p class="lead text-white-50 mb-5" data-aos="fade-up" data-aos-delay="100">
                    Kami menyediakan berbagai pilihan properti terbaik yang disesuaikan dengan kebutuhan, kenyamanan, dan gaya hidup Anda.
                </p>
                <p data-aos="fade-up" data-aos-delay="200">
                    <a href="#properti-section" class="btn btn-primary py-3 px-5 fw-bold">Eksplorasi Properti</a>
                </p>
            </div>
        </div>
    </div>
</div>
<div class="section" id="properti-section">
    <div class="container">
        <div class="row mb-4 align-items-end" data-aos="fade-up">
            <div class="col-lg-6">
                <span class="pf-eyebrow">Rekomendasi Untuk Anda</span>
                <h2 class="pf-heading m-0">Properti Tersedia</h2>
            </div>
            <div class="col-lg-6 text-lg-end mt-3 mt-lg-0">
                <a href="<?= base_url('/properties') ?>" class="pf-btn-outline">
                    Lihat Semua Properti
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="pf-grid" id="propertyGrid">
                    <?php if (empty($properti)) : ?>
                        <div class="pf-empty w-100">
                            <p class="mb-0">Belum ada properti yang tersedia saat ini.</p>
                        </div>
                    <?php else : ?>
                        <?php foreach ($properti as $p) :
                            $namaRaw   = $p['nama_properti'] ?? 'Tanpa Nama';
                            $nama      = esc(is_string($namaRaw) ? $namaRaw : 'Tanpa Nama');
                            $tipeRaw   = $p['kategori_tampil'] ?? '-';
                            $tipe      = esc(is_string($tipeRaw) ? $tipeRaw : '-');
                            $kamarTdr  = (int) ($p['kamar_tidur'] ?? 0);
                            $kamarMdi  = (int) ($p['kamar_mandi'] ?? 0);
                            $hargaRaw  = (float) ($p['harga'] ?? 0);
                            $harga     = number_format($hargaRaw, 0, ',', '.');
                            $gambar    = !empty($p['gambar_url'])
                                ? base_url($p['gambar_url'])
                                : base_url('assets/images/no-image.jpg');
                            $detailUrl = base_url('property-single/' . $p['id']);
                        ?>
                            <a href="<?= $detailUrl ?>"
                                class="pf-card"
                                data-nama="<?= strtolower(is_string($namaRaw) ? $namaRaw : 'Tanpa Nama') ?>"
                                data-tipe="<?= strtolower(is_string($tipeRaw) ? $tipeRaw : '-') ?>"
                                data-kasur="<?= $kamarTdr ?>"
                                data-harga="<?= (int) $hargaRaw ?>">

                                <div class="pf-card-img">
                                    <img
                                        src="<?= esc($gambar) ?>"
                                        alt="<?= $nama ?>"
                                        loading="lazy"
                                        onerror="this.onerror=null;this.src='<?= base_url('assets/images/no-image.jpg') ?>';" />
                                    <span class="pf-badge"><?= $tipe ?></span>
                                </div>

                                <div class="pf-card-body">
                                    <div class="pf-price">Rp <?= $harga ?></div>
                                    <div class="pf-name"><?= $nama ?></div>

                                    <div class="pf-specs">
                                        <span class="pf-spec">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                                <path d="M3 18v-6a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                                <path d="M3 18v2M21 18v2M3 12V9a2 2 0 0 1 2-2h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                            </svg>
                                            <?= $kamarTdr ?> Kasur
                                        </span>
                                        <span class="pf-spec">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                                <path d="M4 12h16v3a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4v-3Z" stroke="currentColor" stroke-width="1.8" />
                                                <path d="M7 12V6a2 2 0 0 1 3-1.7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                            </svg>
                                            <?= $kamarMdi ?> Toilet
                                        </span>
                                    </div>

                                    <span class="pf-cta">Lihat Detail →</span>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div id="liveSearchNoResult" class="pf-empty d-none">
                    <p class="mb-0">Properti tidak ditemukan. Coba ubah kata kunci atau filter.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="features-1">
    <div class="container">
        <div class="row">
            <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="box-feature">
                    <span class="flaticon-house"></span>
                    <h3 class="mb-3">Our Properties</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Voluptates, accusamus.
                    </p>
                    <p><a href="#" class="learn-more">Learn More</a></p>
                </div>
            </div>
            <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
                <div class="box-feature">
                    <span class="flaticon-building"></span>
                    <h3 class="mb-3">Property for Sale</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Voluptates, accusamus.
                    </p>
                    <p><a href="#" class="learn-more">Learn More</a></p>
                </div>
            </div>
            <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                <div class="box-feature">
                    <span class="flaticon-house-3"></span>
                    <h3 class="mb-3">Real Estate Agent</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Voluptates, accusamus.
                    </p>
                    <p><a href="#" class="learn-more">Learn More</a></p>
                </div>
            </div>
            <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
                <div class="box-feature">
                    <span class="flaticon-house-1"></span>
                    <h3 class="mb-3">House for Sale</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Voluptates, accusamus.
                    </p>
                    <p><a href="#" class="learn-more">Learn More</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="section sec-testimonials">
    <div class="container">
        <div class="row mb-5 align-items-center" data-aos="fade-up">
            <div class="col-md-7">
                <h2 class="font-weight-bold heading text-primary mb-2">
                    Apa Kata Mereka?
                </h2>
                <p class="text-black-50 mb-4 mb-md-0">
                    Kenyamanan Anda adalah prioritas kami. Bagikan pengalaman Anda atau lihat ulasan pelanggan lainnya.
                </p>
            </div>
            <div class="col-md-5 d-flex justify-content-md-end align-items-center flex-wrap mt-3 mt-md-0">
                <!-- Tombol Menuju Halaman Ulasan -->
                <a href="<?= base_url('/beri-ulasan') ?>" class="btn btn-primary rounded-pill px-4 py-2 me-3 shadow-sm d-inline-flex align-items-center" style="transition: transform 0.2s; background: #005555; border: none;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-2">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                    Tulis Ulasan
                </a>

                <!-- Navigasi Slider Bawaan Template -->
                <div id="testimonial-nav" class="d-inline-flex">
                    <span class="prev me-2" data-controls="prev" style="cursor:pointer;"><i class="icon-arrow-left"></i></span>
                    <span class="next" data-controls="next" style="cursor:pointer;"><i class="icon-arrow-right"></i></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4"></div>
        </div>
        <div class="testimonial-slider-wrap">
            <div class="testimonial-slider">

                <?php if (empty($ulasan)): ?>
                    <div class="item">
                        <div class="testimonial text-center">
                            <p class="text-muted">Belum ada ulasan yang ditampilkan saat ini.</p>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($ulasan as $u): ?>
                        <div class="item">
                            <div class="testimonial">
                                <!-- Menampilkan Avatar (Jika null, pakai gambar default) -->
                                <img
                                    src="<?= !empty($u['avatar_url']) ? base_url($u['avatar_url']) : base_url('assets/images/pp.png') ?>"
                                    alt="Foto <?= esc($u['nama_klien']) ?>"
                                    class="img-fluid rounded-circle mb-4"
                                    style="width: 80px; height: 80px; object-fit: cover;" />

                                <!-- Menampilkan Rating Bintang Secara Dinamis -->
                                <div class="rate mb-3">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <span class="icon-star <?= $i <= $u['rating'] ? 'text-warning' : 'text-muted' ?>"></span>
                                    <?php endfor; ?>
                                </div>

                                <h3 class="h5 text-primary mb-4"><?= esc($u['nama_klien']) ?></h3>

                                <blockquote>
                                    <p>
                                        &ldquo;<?= esc($u['komentar']) ?>&rdquo;
                                    </p>
                                </blockquote>

                                <!-- Menampilkan Profesi (Jika null, tampilkan 'Pelanggan') -->
                                <p class="text-black-50">
                                    <?= !empty($u['profesi']) ? esc($u['profesi']) : 'Pelanggan' ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<div class="section section-4 bg-light">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-5">
                <h2 class="font-weight-bold heading text-primary mb-4">
                    Mari Temukan Rumah Impian Anda
                </h2>
                <p class="text-black-50">
                    Wujudkan hunian ideal untuk Anda dan keluarga. Kami menyediakan platform pencarian properti terlengkap dengan proses yang cepat, transparan, dan terpercaya.
                </p>
            </div>
        </div>
        <div class="row justify-content-between mb-5">
            <div class="col-lg-7 mb-5 mb-lg-0 order-lg-2">
                <div class="img-about dots">
                    <img src="<?= base_url('assets/images/hero_bg_3.jpg') ?>" alt="Image" class="img-fluid" />
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex feature-h">
                    <span class="wrap-icon me-3">
                        <span class="icon-home2"></span>
                    </span>
                    <div class="feature-text">
                        <h3 class="heading">Jutaan Properti Pilihan</h3>
                        <p class="text-black-50">
                            Eksplorasi jutaan daftar properti eksklusif di lokasi strategis yang disesuaikan dengan anggaran dan gaya hidup Anda.
                        </p>
                    </div>
                </div>

                <div class="d-flex feature-h">
                    <span class="wrap-icon me-3">
                        <span class="icon-person"></span>
                    </span>
                    <div class="feature-text">
                        <h3 class="heading">Agen Profesional Terbaik</h3>
                        <p class="text-black-50">
                            Didampingi oleh ahli dan agen properti bersertifikat dengan rating tertinggi yang siap memandu Anda di setiap langkah transaksi.
                        </p>
                    </div>
                </div>

                <div class="d-flex feature-h">
                    <span class="wrap-icon me-3">
                        <span class="icon-security"></span>
                    </span>
                    <div class="feature-text">
                        <h3 class="heading">Legalitas Terjamin & Aman</h3>
                        <p class="text-black-50">
                            Transaksi bebas khawatir. Setiap properti yang kami daftarkan telah melewati proses verifikasi legalitas yang ketat dan dijamin aman.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row section-counter mt-5">
            <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="counter-wrap mb-5 mb-lg-0">
                    <span class="number"><span class="countup text-primary">666</span></span>
                    <span class="caption text-black-50">Properti Dijual</span>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                <div class="counter-wrap mb-5 mb-lg-0">
                    <span class="number"><span class="countup text-primary">666</span></span>
                    <span class="caption text-black-50">Properti Disewakan</span>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
                <div class="counter-wrap mb-5 mb-lg-0">
                    <span class="number"><span class="countup text-primary">666</span></span>
                    <span class="caption text-black-50">Total Listing Properti</span>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
                <div class="counter-wrap mb-5 mb-lg-0">
                    <span class="number"><span class="countup text-primary">666</span></span>
                    <span class="caption text-black-50">Agen Terverifikasi</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="section">
    <div class="row justify-content-center footer-cta" data-aos="fade-up">
        <div class="col-lg-7 mx-auto text-center">
            <h2 class="mb-4">Be a part of our growing real state agents</h2>
            <p>
                <a href="#" target="_blank" class="btn btn-primary text-white py-3 px-4">Apply for Real Estate agent</a>
            </p>
        </div>
    </div>
</div>

<div class="section section-5 bg-light">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-6 mb-5">
                <h2 class="font-weight-bold heading text-primary mb-4">
                    Our Agents
                </h2>
                <p class="text-black-50">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam
                    enim pariatur similique debitis vel nisi qui reprehenderit totam?
                    Quod maiores.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0">
                <div class="h-100 person">
                    <img src="<?= base_url('assets/images/person_1-min.jpg') ?>" alt="Image" class="img-fluid" />
                    <div class="person-contents">
                        <h2 class="mb-0"><a href="#">James Doe</a></h2>
                        <span class="meta d-block mb-3">Real Estate Agent</span>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Facere officiis inventore cumque tenetur laboriosam, minus
                            culpa doloremque odio, neque molestias?
                        </p>
                        <ul class="social list-unstyled list-inline dark-hover">
                            <li class="list-inline-item"><a href="#"><span class="icon-twitter"></span></a></li>
                            <li class="list-inline-item"><a href="#"><span class="icon-facebook"></span></a></li>
                            <li class="list-inline-item"><a href="#"><span class="icon-linkedin"></span></a></li>
                            <li class="list-inline-item"><a href="#"><span class="icon-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0">
                <div class="h-100 person">
                    <img src="<?= base_url('assets/images/person_2-min.jpg') ?>" alt="Image" class="img-fluid" />
                    <div class="person-contents">
                        <h2 class="mb-0"><a href="#">Jean Smith</a></h2>
                        <span class="meta d-block mb-3">Real Estate Agent</span>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Facere officiis inventore cumque tenetur laboriosam, minus
                            culpa doloremque odio, neque molestias?
                        </p>
                        <ul class="social list-unstyled list-inline dark-hover">
                            <li class="list-inline-item"><a href="#"><span class="icon-twitter"></span></a></li>
                            <li class="list-inline-item"><a href="#"><span class="icon-facebook"></span></a></li>
                            <li class="list-inline-item"><a href="#"><span class="icon-linkedin"></span></a></li>
                            <li class="list-inline-item"><a href="#"><span class="icon-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0">
                <div class="h-100 person">
                    <img src="<?= base_url('assets/images/person_3-min.jpg') ?>" alt="Image" class="img-fluid" />
                    <div class="person-contents">
                        <h2 class="mb-0"><a href="#">Alicia Huston</a></h2>
                        <span class="meta d-block mb-3">Real Estate Agent</span>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Facere officiis inventore cumque tenetur laboriosam, minus
                            culpa doloremque odio, neque molestias?
                        </p>
                        <ul class="social list-unstyled list-inline dark-hover">
                            <li class="list-inline-item"><a href="#"><span class="icon-twitter"></span></a></li>
                            <li class="list-inline-item"><a href="#"><span class="icon-facebook"></span></a></li>
                            <li class="list-inline-item"><a href="#"><span class="icon-linkedin"></span></a></li>
                            <li class="list-inline-item"><a href="#"><span class="icon-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<script src="<?= base_url('assets/js/properti.js') ?>"></script>
<?php $this->endSection() ?>