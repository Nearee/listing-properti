<?php $this->extend('back/layout/dashboard') ?>
<?php $this->section('content') ?>

<section class="section">
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible show fade">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
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
            <h5 class="card-title mb-0">Data Lokasi</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="bi bi-plus"></i> Tambah Lokasi
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive datatable-minimal">
                <table class="table table-hover" id="table2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lokasi</th>
                            <th>Alamat Lengkap</th>
                            <th>Link Google Maps</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($lokasi as $item) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($item['nama_lokasi']) ?></td>
                                <td><?= esc($item['alamat_lengkap']) ?></td>
                                <td>
                                    <a href="<?= esc($item['link_gmaps']) ?>" target="_blank" class="btn btn-sm btn-outline-info">Lihat Peta</a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $item['id'] ?>">
                                        Edit
                                    </button>

                                    <form action="<?= base_url('lokasi/delete/' . $item['id']) ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="editModal<?= $item['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $item['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel<?= $item['id'] ?>">Edit Lokasi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="<?= base_url('lokasi/update/' . $item['id']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <div class="modal-body">
                                                <div class="form-group mb-3">
                                                    <label for="nama_lokasi">Nama Lokasi</label>
                                                    <input type="text" class="form-control" name="nama_lokasi" value="<?= esc($item['nama_lokasi']) ?>" required minlength="3" maxlength="100">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="alamat_lengkap">Alamat Lengkap</label>
                                                    <textarea class="form-control" name="alamat_lengkap" rows="3" required><?= esc($item['alamat_lengkap']) ?></textarea>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="link_gmaps">Link Google Maps (URL)</label>
                                                    <input type="url" class="form-control" name="link_gmaps" value="<?= esc($item['link_gmaps']) ?>" required>
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

                        <?php if (empty($lokasi)): ?>
                            <tr>
                                <td colspan="5" class="text-center">Belum ada data lokasi.</td>
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
                <h5 class="modal-title" id="createModalLabel">Tambah Lokasi Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('lokasi/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="nama_lokasi">Nama Lokasi</label>
                        <input type="text" class="form-control" id="nama_lokasi" name="nama_lokasi" value="<?= old('nama_lokasi') ?>" placeholder="Masukkan nama lokasi" required minlength="3" maxlength="100">
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamat_lengkap">Alamat Lengkap</label>
                        <textarea class="form-control" id="alamat_lengkap" name="alamat_lengkap" rows="3" placeholder="Masukkan alamat lengkap" required><?= old('alamat_lengkap') ?></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="link_gmaps">Link Google Maps (URL)</label>
                        <input type="url" class="form-control" id="link_gmaps" name="link_gmaps" value="<?= old('link_gmaps') ?>" placeholder="https://maps.google.com/..." required>
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

<?php $this->endSection() ?>