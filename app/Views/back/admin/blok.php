<?= $this->extend('back/layout/dashboard') ?>
<?= $this->section('content') ?>

<section class="section">
        <?php if (session()->getFlashdata('success')) : ?>
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
        <div id="liveToast" class="toast shadow-lg border-start border-success border-5" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-header bg-white">
                <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <rect width="100%" height="100%" fill="#28a745"></rect>
                </svg>
                <strong class="me-auto text-dark">Berhasil</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body text-dark">
                <?= session()->getFlashdata('success') ?>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/js/notifikasi.js') ?>"></script>
<?php endif; ?>

        <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger alert-dismissible show fade">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Data Blok Properti</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="bi bi-plus"></i> Tambah Blok
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive datatable-minimal">
                <table class="table table-hover" id="table2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lokasi</th>
                            <th>Nama Blok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($blok as $item) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                                                <td><?= esc($item['nama_lokasi']) ?></td>
                                <td><?= esc($item['nama_blok']) ?></td>
                                <td>
                                                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $item['id'] ?>">
                                        Edit
                                    </button>

                                                                        <form action="<?= base_url('blok/delete/' . $item['id']) ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data blok ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>

                                                        <div class="modal fade" id="editModal<?= $item['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $item['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel<?= $item['id'] ?>">Edit Blok</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="<?= base_url('blok/update/' . $item['id']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <div class="modal-body">

                                                <div class="form-group mb-3">
                                                    <label for="lokasi_id">Pilih Lokasi</label>
                                                    <select name="lokasi_id" class="form-select" required>
                                                        <option value="">-- Pilih Lokasi --</option>
                                                        <?php foreach ($lokasi as $loc) : ?>
                                                                                                                        <option value="<?= $loc['id'] ?>" <?= ($item['lokasi_id'] == $loc['id']) ? 'selected' : '' ?>>
                                                                <?= esc($loc['nama_lokasi']) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="nama_blok">Nama Blok</label>
                                                    <input type="text" class="form-control" name="nama_blok" value="<?= esc($item['nama_blok']) ?>" required maxlength="50">
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        <?php endforeach; ?>

                        <?php if (empty($blok)): ?>
                            <tr>
                                <td colspan="4" class="text-center">Belum ada data blok.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Blok Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('blok/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">

                    <div class="form-group mb-3">
                        <label for="lokasi_id">Pilih Lokasi</label>
                        <select name="lokasi_id" id="lokasi_id" class="form-select" required>
                            <option value="">-- Pilih Lokasi --</option>
                            <?php foreach ($lokasi as $loc) : ?>
                                <option value="<?= $loc['id'] ?>" <?= old('lokasi_id') == $loc['id'] ? 'selected' : '' ?>>
                                    <?= esc($loc['nama_lokasi']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="nama_blok">Nama Blok</label>
                        <input type="text" class="form-control" id="nama_blok" name="nama_blok" value="<?= old('nama_blok') ?>" placeholder="Contoh: Blok A1" required maxlength="50">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>