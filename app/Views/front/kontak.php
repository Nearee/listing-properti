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
            <div class="row mb-5 justify-content-center text-center" data-aos="fade-up">
                <div class="col-lg-6 mb-4">
                    <h2 class="font-weight-bold heading text-primary mb-3">Lokasi Kami</h2>
                    <p class="text-black-50">Kunjungi lokasi proyek dan kantor pemasaran kami. Dapatkan petunjuk arah secara
                        langsung melalui Google Maps.</p>
                </div>
            </div>

            <?php foreach ($lokasi as $loc): ?>
                <div class="row mb-5 align-items-stretch" data-aos="fade-up">

                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <div
                            class="p-4 p-lg-5 border rounded-3 shadow-sm h-100 bg-white d-flex flex-column justify-content-center">

                            <div class="d-flex align-items-start">

                                <div class="flex-shrink-0 me-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white shadow-sm"
                                        style="width: 50px; height: 50px; background-color: #0b2239;"> <i
                                            class="icon-room fs-4"></i>
                                    </div>
                                </div>

                                <div class="flex-grow-1 text-start">
                                    <h5 class="fw-bold mb-2 text-dark">
                                        <?= esc($loc['nama_lokasi']) ?>
                                    </h5>
                                    <p class="text-black-50 mb-0" style="line-height: 1.6; font-size: 0.95rem;">
                                        <?= nl2br(esc($loc['alamat_lengkap'])) ?>
                                    </p>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="col-lg-8">
                        <?php if (!empty($loc['link_gmaps'])): ?>
                            <div class="rounded-4 overflow-hidden shadow h-100 w-100 position-relative bg-light"
                                style="min-height: 400px;">
                                <iframe src="<?= esc($loc['link_gmaps']) ?>"
                                    style="border:0; position: absolute; top:0; left:0; width: 100%; height: 100%;"
                                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                                    title="Peta lokasi <?= esc($loc['nama_lokasi']) ?>">
                                </iframe>
                            </div>
                        <?php else: ?>
                            <div class="p-5 text-center bg-light rounded-4 h-100 d-flex flex-column align-items-center justify-content-center shadow-sm"
                                style="min-height: 400px; border: 2px dashed #dee2e6;">
                                <div class="rounded-circle d-flex align-items-center justify-content-center mb-3 bg-white shadow-sm"
                                    style="width: 70px; height: 70px;">
                                    <i class="icon-map-marker text-muted fs-2"></i>
                                </div>
                                <h5 class="fw-bold text-dark mb-2">Peta Belum Ditambahkan</h5>
                                <p class="text-muted small mb-0">Link sematan Google Maps untuk lokasi ini belum dikonfigurasi.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endforeach; ?>

        </div>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>