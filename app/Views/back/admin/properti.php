<?= $this->extend('back/layout/dashboard') ?>
<?= $this->section('content') ?>

<section class="section">
    <!-- Notifikasi Sukses -->
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible show fade">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Notifikasi Error Validasi -->
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
            <h5 class="card-title mb-0">Data Properti</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="bi bi-plus"></i> Tambah Properti
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive datatable-minimal">
                <table class="table table-hover" id="table2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Blok</th>
                            <th>Nama Properti</th>
                            <th>No Rumah</th>
                            <th>Harga</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($properti as $item) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <!-- Menampilkan thumbnail gambar di tabel -->
                                    <img src="<?= base_url($item['gambar_url']) ?>" alt="Thumbnail" class="rounded" width="60" height="40" style="object-fit: cover;">
                                </td>
                                <td><?= esc($item['nama_blok']) ?></td>
                                <td><?= esc($item['nama_properti']) ?></td>
                                <td><?= esc($item['nomor_rumah']) ?></td>
                                <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                                <td>
                                    <?php if ($item['kategori_tampil'] == 'populer') : ?>
                                        <span class="badge bg-success">Populer</span>
                                    <?php elseif ($item['kategori_tampil'] == 'unggulan') : ?>
                                        <span class="badge bg-primary">Unggulan</span>
                                    <?php else : ?>
                                        <span class="badge bg-secondary">Tidak Ada</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <!-- Tombol Edit Modal -->
                                    <button type="button" class="btn btn-sm btn-warning mb-1" data-bs-toggle="modal" data-bs-target="#editModal<?= $item['id'] ?>">
                                        Edit
                                    </button>

                                    <!-- Tombol Hapus -->
                                    <form action="<?= base_url('properti/delete/' . $item['id']) ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Apakah Anda yakin ingin menghapus properti ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- MODAL EDIT DATA (Di dalam perulangan) -->
                            <div class="modal fade" id="editModal<?= $item['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $item['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel<?= $item['id'] ?>">Edit Properti</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <!-- WAJIB TAMBAH ENCTYPE -->
                                        <form action="<?= base_url('properti/update/' . $item['id']) ?>" method="post" enctype="multipart/form-data">
                                            <?= csrf_field() ?>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6 form-group mb-3">
                                                        <label>Pilih Blok</label>
                                                        <select name="blok_id" class="form-select" required>
                                                            <option value="">-- Pilih Blok --</option>
                                                            <?php foreach ($blok as $blk) : ?>
                                                                <option value="<?= $blk['id'] ?>" <?= ($item['blok_id'] == $blk['id']) ? 'selected' : '' ?>>
                                                                    <?= esc($blk['nama_blok']) ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group mb-3">
                                                        <label>Kategori Tampil</label>
                                                        <select name="kategori_tampil" class="form-select" required>
                                                            <option value="tidak_ada" <?= ($item['kategori_tampil'] == 'tidak_ada') ? 'selected' : '' ?>>Tidak Ada</option>
                                                            <option value="populer" <?= ($item['kategori_tampil'] == 'populer') ? 'selected' : '' ?>>Populer</option>
                                                            <option value="unggulan" <?= ($item['kategori_tampil'] == 'unggulan') ? 'selected' : '' ?>>Unggulan</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-8 form-group mb-3">
                                                        <label>Nama Properti</label>
                                                        <input type="text" class="form-control" name="nama_properti" value="<?= esc($item['nama_properti']) ?>" required maxlength="150">
                                                    </div>
                                                    <div class="col-md-4 form-group mb-3">
                                                        <label>No Rumah</label>
                                                        <input type="text" class="form-control" name="nomor_rumah" value="<?= esc($item['nomor_rumah']) ?>" required maxlength="20">
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Harga Properti (Angka saja)</label>
                                                    <input type="number" class="form-control" name="harga" value="<?= esc($item['harga']) ?>" required min="0">
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 form-group mb-3">
                                                        <label>Jumlah Kamar Tidur</label>
                                                        <input type="number" class="form-control" name="kamar_tidur" value="<?= esc($item['kamar_tidur']) ?>" required min="0">
                                                    </div>
                                                    <div class="col-md-6 form-group mb-3">
                                                        <label>Jumlah Kamar Mandi</label>
                                                        <input type="number" class="form-control" name="kamar_mandi" value="<?= esc($item['kamar_mandi']) ?>" required min="0">
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Upload Gambar Baru (Maks 2MB, JPG/PNG)</label><br>
                                                    <img src="<?= base_url($item['gambar_url']) ?>" alt="Current Image" class="mb-2 rounded" width="120">
                                                    <!-- Ubah tipe jadi file dan hapus required -->
                                                    <input type="file" class="form-control" name="gambar_url" accept="image/png, image/jpeg">
                                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
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
                            <!-- Akhir Modal Edit -->

                        <?php endforeach; ?>

                        <?php if (empty($properti)): ?>
                            <tr>
                                <td colspan="8" class="text-center">Belum ada data properti.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- MODAL TAMBAH DATA -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Properti Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- WAJIB TAMBAH ENCTYPE -->
            <form action="<?= base_url('properti/store') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label>Pilih Blok</label>
                            <select name="blok_id" class="form-select" required>
                                <option value="">-- Pilih Blok --</option>
                                <?php foreach ($blok as $blk) : ?>
                                    <option value="<?= $blk['id'] ?>" <?= old('blok_id') == $blk['id'] ? 'selected' : '' ?>>
                                        <?= esc($blk['nama_blok']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label>Kategori Tampil</label>
                            <select name="kategori_tampil" class="form-select" required>
                                <option value="tidak_ada" <?= old('kategori_tampil') == 'tidak_ada' ? 'selected' : '' ?>>Tidak Ada</option>
                                <option value="populer" <?= old('kategori_tampil') == 'populer' ? 'selected' : '' ?>>Populer</option>
                                <option value="unggulan" <?= old('kategori_tampil') == 'unggulan' ? 'selected' : '' ?>>Unggulan</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 form-group mb-3">
                            <label>Nama Properti</label>
                            <input type="text" class="form-control" name="nama_properti" value="<?= old('nama_properti') ?>" placeholder="Misal: Tipe 36" required maxlength="150">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label>No Rumah</label>
                            <input type="text" class="form-control" name="nomor_rumah" value="<?= old('nomor_rumah') ?>" placeholder="Misal: A1-10" required maxlength="20">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label>Harga Properti (Angka saja, tanpa titik)</label>
                        <input type="number" class="form-control" name="harga" value="<?= old('harga') ?>" placeholder="Misal: 350000000" required min="0">
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label>Jumlah Kamar Tidur</label>
                            <input type="number" class="form-control" name="kamar_tidur" value="<?= old('kamar_tidur') ?>" required min="0">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label>Jumlah Kamar Mandi</label>
                            <input type="number" class="form-control" name="kamar_mandi" value="<?= old('kamar_mandi') ?>" required min="0">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label>Upload Gambar Properti (Maks 2MB, JPG/PNG)</label>
                        <!-- Ubah tipe jadi file dan tambahkan accept -->
                        <input type="file" class="form-control" name="gambar_url" accept="image/png, image/jpeg" required>
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