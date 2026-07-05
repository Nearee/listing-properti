<?php $this->extend('back/layout/dashboard') ?>
<?php $this->section('content') ?>

<div class="page-heading">
    <h3>Dashboard Utama</h3>
    <p class="text-subtitle text-muted">Ringkasan data landing page listing properti Anda.</p>
</div>

<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon blue mb-2">
                                        <i class="bi bi-house-door-fill text-white fs-3"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total Properti</h6>
                                    <h6 class="font-extrabold mb-0"><?= $total_properti ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon green mb-2">
                                        <i class="bi bi-envelope-fill text-white fs-3"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Pesan Masuk</h6>
                                    <h6 class="font-extrabold mb-0"><?= $total_pesan ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon purple mb-2">
                                        <i class="bi bi-geo-alt-fill text-white fs-3"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Titik Lokasi</h6>
                                    <h6 class="font-extrabold mb-0"><?= $total_lokasi ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon red mb-2">
                                        <i class="bi bi-star-fill text-white fs-3"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total Ulasan</h6>
                                    <h6 class="font-extrabold mb-0"><?= $total_ulasan ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-xl-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">5 Pesan Masuk Terbaru</h5>
                            <a href="<?= base_url('admin/pesan') ?>" class="btn btn-sm btn-outline-primary">Lihat
                                Semua</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless mb-0">
                                    <thead>
                                        <tr>
                                            <th>Pengirim</th>
                                            <th>Subjek</th>
                                            <th>Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($pesan_terbaru)): ?>
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">Belum ada pesan.</td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($pesan_terbaru as $pesan): ?>
                                                <tr>
                                                    <td class="text-bold-500"><?= esc($pesan['nama_pengirim']) ?></td>
                                                    <td><?= esc($pesan['subjek']) ?></td>
                                                    <td class="text-muted">
                                                        <small><?= date('d M, H:i', strtotime($pesan['created_at'])) ?></small>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">5 Properti Terbaru</h5>
                            <a href="<?= base_url('/properti') ?>" class="btn btn-sm btn-outline-primary">Lihat
                                Semua</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nama Properti</th>
                                            <th>Harga</th>
                                            <th>Kategori</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($properti_terbaru)): ?>
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">Belum ada properti.</td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($properti_terbaru as $prop): ?>
                                                <tr>
                                                    <td class="text-bold-500"><?= esc($prop['nama_properti']) ?></td>
                                                    <td class="text-success fw-bold">Rp
                                                        <?= number_format($prop['harga'], 0, ',', '.') ?>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge bg-light-primary"><?= esc($prop['kategori_tampil']) ?></span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">5 Ulasan Pengguna Terbaru</h5>
                            <a href="<?= base_url('admin/ulasan') ?>" class="btn btn-sm btn-outline-primary">Lihat
                                Semua</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nama Klien</th>
                                            <th>Rating</th>
                                            <th>Komentar</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($ulasan_terbaru)): ?>
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">Belum ada ulasan.</td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($ulasan_terbaru as $u): ?>
                                                <tr>
                                                    <td class="text-bold-500"><?= esc($u['nama_klien']) ?></td>
                                                    <td>
                                                        <div class="text-warning">
                                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                                <i class="bi bi-star<?= $i <= $u['rating'] ? '-fill' : '' ?>"></i>
                                                            <?php endfor; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="d-inline-block text-truncate" style="max-width: 300px;">
                                                            <?= esc($u['komentar']) ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <?php if (isset($u['status']) && $u['status'] == 'approved'): ?>
                                                            <span class="badge bg-light-success">Ditayangkan</span>
                                                        <?php else: ?>
                                                            <span class="badge bg-light-warning">Menunggu</span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<?php $this->endSection() ?>