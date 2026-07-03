<?php $this->extend('back/layout/dashboard') ?>
<?php $this->section('content') ?>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
        <div id="liveToast" class="toast shadow-lg border-start border-success border-5" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-white">
                <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <rect width="100%" height="100%" fill="#28a745"></rect>
                </svg>
                <strong class="me-auto text-dark">Notifikasi</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body text-dark">
                <?= session()->getFlashdata('success') ?>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/js/notifikasi.js') ?>"></script>
<?php endif; ?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Slider Photo</h3>
                <p class="text-subtitle text-muted font-semibold">Manajemen gambar untuk halaman landing page. </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first d-flex justify-content-end align-items-center">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
                    <i class="bi bi-cloud-arrow-up"></i> Tambah Gambar
                </button>
            </div>
        </div>
    </div>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger mt-3 alert-dismissible show fade">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <section class="section mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Galeri Tersimpan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row gallery">
                            <?php if (empty($galeri)): ?>
                                <div class="col-12 text-center text-muted">
                                    <p>Belum ada gambar di dalam galeri.</p>
                                </div>
                            <?php else: ?>
                                <?php foreach ($galeri as $index => $item) : ?>
                                    <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-3 mb-2 position-relative">
                                        <!-- Thumbnail (Klik untuk melihat di Carousel) -->
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#galleryModal" onclick="document.querySelector('#Gallerycarousel').querySelector('[data-bs-slide-to=\'<?= $index ?>\']').click()">
                                            <img class="w-100 rounded" src="<?= base_url($item['gambar_url']) ?>" alt="Gallery Image <?= $index + 1 ?>" style="height: 200px; object-fit: cover;">
                                        </a>

                                        <!-- Tombol Hapus Gambar -->
                                        <form action="<?= base_url('admin/galeri/delete/' . $item['id']) ?>" method="post" class="position-absolute top-0 end-0 m-2">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-sm btn-danger shadow" onclick="return confirm('Apakah Anda yakin ingin menghapus gambar ini?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- MODAL UPLOAD GAMBAR -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload Gambar Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Pastikan form memiliki enctype="multipart/form-data" -->
            <form action="<?= base_url('admin/galeri/store') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="gambar">Pilih Gambar (Maks 2MB, JPG/PNG)</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" accept="image/png, image/jpeg" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="urutan">Urutan Tampil (Opsional)</label>
                        <input type="number" class="form-control" id="urutan" name="urutan" value="0">
                        <small class="text-muted">Makin kecil angka makin prioritas (awal).</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL CAROUSEL GALERI -->
<div class="modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-labelledby="galleryModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="galleryModalTitle">Pratinjau Galeri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-dark p-0">
                <div id="Gallerycarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <!-- Carousel Indicators -->
                    <div class="carousel-indicators">
                        <?php foreach ($galeri as $index => $item) : ?>
                            <button type="button" data-bs-target="#Gallerycarousel" data-bs-slide-to="<?= $index ?>" class="<?= $index == 0 ? 'active' : '' ?>" aria-current="<?= $index == 0 ? 'true' : 'false' ?>" aria-label="Slide <?= $index + 1 ?>"></button>
                        <?php endforeach; ?>
                    </div>

                    <!-- Carousel Images -->
                    <div class="carousel-inner">
                        <?php foreach ($galeri as $index => $item) : ?>
                            <div class="carousel-item <?= $index == 0 ? 'active' : '' ?>">
                                <img class="d-block w-100" src="<?= base_url($item['gambar_url']) ?>" alt="Slide <?= $index + 1 ?>" style="max-height: 70vh; object-fit: contain;">
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Carousel Controls -->
                    <a class="carousel-control-prev" href="#Gallerycarousel" role="button" type="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </a>
                    <a class="carousel-control-next" href="#Gallerycarousel" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection() ?>