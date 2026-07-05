<?= $this->extend('front/index') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
        <div id="liveToast" class="toast shadow-lg border-start border-success border-5" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-header bg-white">
                <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <rect width="100%" height="100%" fill="#28a745"></rect>
                </svg>
                <strong class="me-auto text-dark">Pesan Terkirim</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body text-dark">
                <?= session()->getFlashdata('success') ?>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/js/notifikasi.js') ?>"></script>
<?php endif; ?>

<div class="hero page-inner overlay" style="background-image: url('<?= base_url('assets/images/hero_bg_1.jpg') ?>')">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-9 text-center mt-5">
                <h1 class="heading" data-aos="fade-up">Kontak</h1>

                <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                    <ol class="breadcrumb text-center justify-content-center">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">
                            Contact
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
                <div class="contact-info">

                    <div class="address mt-2">
                        <i class="icon-room"></i>
                        <h4 class="mb-2">Location:</h4>
                        <p>
                            <?= esc($profil->alamat_kantor ?? 'Alamat belum tersedia') ?>
                        </p>
                    </div>

                    <div class="open-hours mt-4">
                        <i class="icon-clock-o"></i>
                        <h4 class="mb-2">Open Hours:</h4>
                        <p>
                            <?= esc($profil->jam_operasional ?? 'Jam operasional belum tersedia') ?>
                        </p>
                    </div>

                    <div class="email mt-4">
                        <i class="icon-envelope"></i>
                        <h4 class="mb-2">Email:</h4>
                        <p><?= esc($profil->email_kantor ?? 'Email belum tersedia') ?></p>
                    </div>

                    <div class="phone mt-4">
                        <i class="icon-phone"></i>
                        <h4 class="mb-2">Call:</h4>
                        <p><?= esc($profil->telepon_kantor ?? 'Telepon belum tersedia') ?></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('kontak/kirim') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <input type="text" name="nama_pengirim" class="form-control" placeholder="Your Name"
                                value="<?= old('nama_pengirim') ?>" required />
                        </div>
                        <div class="col-6 mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Your Email"
                                value="<?= old('email') ?>" required />
                        </div>
                        <div class="col-12 mb-3">
                            <input type="text" name="subjek" class="form-control" placeholder="Subject"
                                value="<?= old('subjek') ?>" required />
                        </div>
                        <div class="col-12 mb-3">
                            <textarea name="pesan" cols="30" rows="7" class="form-control" placeholder="Message"
                                required><?= old('pesan') ?></textarea>
                        </div>

                        <div class="col-12">
                            <input type="submit" value="Send Message" class="btn btn-primary" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($lokasi)): ?>
    <div class="section pt-0">
        <div class="container">
            <div class="row" data-aos="fade-up">
                <div class="col-12 mb-4">
                    <h2 class="font-weight-bold heading text-primary">Lokasi Kami</h2>
                    <p class="text-black-50">Temukan kami di lokasi berikut. Klik ikon untuk membuka di Google Maps.</p>
                </div>
            </div>

            <?php foreach ($lokasi as $loc): ?>
                <div class="row mb-5" data-aos="fade-up">
                    <div class="col-lg-4 mb-4 mb-lg-0 d-flex align-items-center">
                        <div class="p-4 border rounded-3 shadow-sm w-100 bg-white">
                            <h5 class="text-primary fw-bold mb-2">
                                <i class="icon-room me-2"></i><?= esc($loc['nama_lokasi']) ?>
                            </h5>
                            <p class="text-black-50 mb-3"><?= nl2br(esc($loc['alamat_lengkap'])) ?></p>
                            <?php if (!empty($loc['link_gmaps'])): ?>
                                <a href="<?= esc($loc['link_gmaps']) ?>" target="_blank" rel="noopener noreferrer"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="icon-room me-1"></i> Buka di Google Maps
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <?php if (!empty($loc['link_gmaps'])): ?>
                            <div class="rounded-3 overflow-hidden shadow-sm" style="height: 320px;">
                                <iframe src="<?= esc($loc['link_gmaps']) ?>" width="100%" height="100%" style="border:0;"
                                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                                    title="Peta lokasi <?= esc($loc['nama_lokasi']) ?>">
                                </iframe>
                            </div>
                        <?php else: ?>
                            <div
                                class="p-5 text-center bg-light rounded-3 h-100 d-flex align-items-center justify-content-center shadow-sm">
                                <p class="text-muted mb-0"><i class="icon-map-marker me-2"></i>Peta belum ditambahkan</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>