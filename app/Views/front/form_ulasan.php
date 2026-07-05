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

<style>
    .star-rating {
        direction: rtl;
        /* Bintang diurutkan dari kanan ke kiri untuk efek hover */
        display: inline-flex;
    }

    .star-rating input[type="radio"] {
        display: none;
        /* Sembunyikan radio button asli */
    }

    .star-rating label {
        font-size: 2.5rem;
        color: #ddd;
        /* Warna bintang kosong */
        cursor: pointer;
        transition: color 0.2s;
        padding: 0 5px;
    }

    /* Efek hover dan saat dipilih (checked) */
    .star-rating input[type="radio"]:checked~label,
    .star-rating label:hover,
    .star-rating label:hover~label {
        color: #ffc107;
        /* Warna kuning emas */
    }
</style>

<div class="section pt-5 pb-5 bg-light">
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">

                <div class="text-center mb-5">
                    <h2 class="font-weight-bold text-primary heading">Bagikan Pengalaman Anda</h2>
                    <p class="text-black-50">Pendapat Anda sangat berharga untuk membantu kami memberikan layanan
                        terbaik.</p>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
                            <div id="liveToast" class="toast shadow-lg border-start border-success border-5" role="alert"
                                aria-live="assertive" aria-atomic="true">
                                <div class="toast-header bg-white">
                                    <svg class="bd-placeholder-img rounded me-2" width="20" height="20"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                        preserveAspectRatio="xMidYMid slice" focusable="false">
                                        <rect width="100%" height="100%" fill="#28a745"></rect>
                                    </svg>
                                    <strong class="me-auto text-dark">Berhasil</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast"
                                        aria-label="Close"></button>
                                </div>
                                <div class="toast-body text-dark">
                                                        <?= session()->getFlashdata('success') ?>
                                </div>
                            </div>
                        </div>
                        <script src="<?= base_url('assets/js/notifikasi.js') ?>"></script>
                                        <?php endif; ?>

                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('/simpan-ulasan') ?>" method="POST">
                        <?= csrf_field() ?>

                        <div class="form-group mb-4 text-center">
                            <label class="d-block mb-2 fw-bold">Seberapa puas Anda dengan pelayanan kami?</label>

                            <div class="star-rating">
                                <input type="radio" id="star5" name="rating" value="5" />
                                <label for="star5" title="5 Bintang">&#9733;</label>

                                <input type="radio" id="star4" name="rating" value="4" />
                                <label for="star4" title="4 Bintang">&#9733;</label>

                                <input type="radio" id="star3" name="rating" value="3" />
                                <label for="star3" title="3 Bintang">&#9733;</label>

                                <input type="radio" id="star2" name="rating" value="2" />
                                <label for="star2" title="2 Bintang">&#9733;</label>

                                <input type="radio" id="star1" name="rating" value="1" required />
                                <label for="star1" title="1 Bintang">&#9733;</label>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="nama_klien" class="fw-bold mb-2">Nama Lengkap</label>
                            <input type="text" class="form-control px-4 py-3 bg-light border-0" id="nama_klien"
                                name="nama_klien" value="<?= old('nama_klien') ?>" placeholder="Masukkan nama Anda"
                                required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="komentar" class="fw-bold mb-2">Ulasan / Komentar</label>
                            <textarea class="form-control px-4 py-3 bg-light border-0" id="komentar" name="komentar"
                                rows="5" placeholder="Ceritakan pengalaman Anda di sini..."
                                required><?= old('komentar') ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold">
                            Kirim Ulasan
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>