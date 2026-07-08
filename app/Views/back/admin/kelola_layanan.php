<?php $this->extend('back/layout/dashboard') ?>
<?php $this->section('content') ?>

<section class="section">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
            <div id="liveToast" class="toast shadow-lg border-start border-success border-5" role="alert"
                aria-live="assertive" aria-atomic="true">
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
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger alert-dismissible show fade">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Manajemen Layanan</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="bi bi-plus"></i> Tambah Layanan
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive datatable-minimal">
                <table class="table table-hover" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Icon</th>
                            <th>Judul</th>
                            <th>Halaman</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($layanan as $item): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <span class="<?= esc($item['icon_class']) ?> fs-4"></span>
                                </td>
                                <td><?= esc($item['judul']) ?></td>
                                <td><?= esc($item['halaman']) ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning mb-1" data-bs-toggle="modal"
                                        data-bs-target="#editModal<?= $item['id'] ?>">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>

                                    <form action="<?= base_url('admin/layanan/delete/' . $item['id']) ?>" method="post"
                                        class="d-inline">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-danger mb-1"
                                            onclick="return confirm('Yakin ingin menghapus layanan ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="editModal<?= $item['id'] ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <form action="<?= base_url('admin/layanan/update/' . $item['id']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Layanan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Judul Layanan</label>
                                                        <input type="text" class="form-control" name="judul"
                                                            value="<?= esc($item['judul']) ?>" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Halaman (Opsional)</label>
                                                        <input type="text" class="form-control" name="halaman"
                                                            value="<?= esc($item['halaman']) ?>">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">URL Link (Opsional)</label>
                                                        <input type="text" class="form-control" name="link_url"
                                                            value="<?= esc($item['link_url']) ?>">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Pilih Icon (Flaticon)</label>
                                                        <select class="form-select" name="icon_class" required>
                                                            <option value="flaticon-building"
                                                                <?= $item['icon_class'] == 'flaticon-building' ? 'selected' : '' ?>>🏢 flaticon-building</option>
                                                            <option value="flaticon-house"
                                                                <?= $item['icon_class'] == 'flaticon-house' ? 'selected' : '' ?>>🏠 flaticon-house</option>
                                                            <option value="flaticon-house-1"
                                                                <?= $item['icon_class'] == 'flaticon-house-1' ? 'selected' : '' ?>>🏡 flaticon-house-1</option>
                                                            <option value="flaticon-camera"
                                                                <?= $item['icon_class'] == 'flaticon-camera' ? 'selected' : '' ?>>📷 flaticon-camera</option>
                                                            <option value="flaticon-location"
                                                                <?= $item['icon_class'] == 'flaticon-location' ? 'selected' : '' ?>>📍 flaticon-location</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label class="form-label">Deskripsi</label>
                                                        <textarea class="form-control" name="deskripsi" rows="3"
                                                            required><?= esc($item['deskripsi']) ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <?php if (empty($layanan)): ?>
                            <tr>
                                <td colspan="5" class="text-center">Belum ada layanan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('admin/layanan/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Layanan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Judul Layanan</label>
                            <input type="text" class="form-control" name="judul" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Halaman (Opsional)</label>
                            <input type="text" class="form-control" name="halaman">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">URL Link (Opsional)</label>
                            <input type="text" class="form-control" name="link_url">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pilih Icon (Flaticon)</label>
                            <select class="form-select" name="icon_class" required>
                                <option value="">-- Pilih Icon --</option>
                                <option value="flaticon-building">🏢 flaticon-building</option>
                                <option value="flaticon-house">🏠 flaticon-house</option>
                                <option value="flaticon-house-1">🏡 flaticon-house-1</option>
                                <option value="flaticon-camera">📷 flaticon-camera</option>
                                <option value="flaticon-location">📍 flaticon-location</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="3" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Layanan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->endSection() ?>