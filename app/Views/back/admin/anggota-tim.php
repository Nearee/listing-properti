<?= $this->extend('back/layout/dashboard') ?>
<?= $this->section('content') ?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Anggota Tim</h3>
                <p class="text-subtitle text-muted font-semibold">Kelola informasi anggota tim perusahaan Anda</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Anggota Tim</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <!-- Notifikasi Sukses -->
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Notifikasi Error Validasi -->
        <?php if (session()->getFlashdata('errors')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
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
                <h5 class="card-title mb-0">Daftar Anggota</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="bi bi-person-plus-fill"></i> Tambah Anggota
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive datatable-minimal">
                    <table class="table table-hover" id="table2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Sosial Media</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($anggota as $item) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <!-- Menampilkan foto dari URL -->
                                        <img src="<?= esc($item['foto_url']) ?>" alt="Foto" width="50" class="rounded-circle" style="aspect-ratio: 1/1; object-fit: cover;">
                                    </td>
                                    <td><?= esc($item['nama']) ?></td>
                                    <td><?= esc($item['jabatan']) ?></td>
                                    <td>
                                        <!-- Menampilkan icon sosmed jika link tersedia -->
                                        <?php if ($item['link_twitter']): ?><a href="<?= esc($item['link_twitter']) ?>" target="_blank" class="text-info me-2"><i class="bi bi-twitter"></i></a><?php endif; ?>
                                        <?php if ($item['link_facebook']): ?><a href="<?= esc($item['link_facebook']) ?>" target="_blank" class="text-primary me-2"><i class="bi bi-facebook"></i></a><?php endif; ?>
                                        <?php if ($item['link_linkedin']): ?><a href="<?= esc($item['link_linkedin']) ?>" target="_blank" class="text-primary me-2"><i class="bi bi-linkedin"></i></a><?php endif; ?>
                                        <?php if ($item['link_instagram']): ?><a href="<?= esc($item['link_instagram']) ?>" target="_blank" class="text-danger me-2"><i class="bi bi-instagram"></i></a><?php endif; ?>
                                    </td>
                                    <td>
                                        <!-- Tombol Modal Edit -->
                                        <button type="button" class="btn btn-sm btn-warning mb-1" data-bs-toggle="modal" data-bs-target="#editModal<?= $item['id'] ?>">Edit</button>

                                        <!-- Form Hapus -->
                                        <form action="<?= base_url('anggota-tim/delete/' . $item['id']) ?>" method="post" class="d-inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Apakah Anda yakin ingin menghapus data anggota ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- MODAL EDIT DATA -->
                                <div class="modal fade" id="editModal<?= $item['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $item['id'] ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel<?= $item['id'] ?>">Edit Anggota Tim</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="<?= base_url('anggota-tim/update/' . $item['id']) ?>" method="post">
                                                <?= csrf_field() ?>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label>Nama Lengkap</label>
                                                            <input type="text" class="form-control" name="nama" value="<?= esc($item['nama']) ?>" required maxlength="100">
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label>Jabatan</label>
                                                            <input type="text" class="form-control" name="jabatan" value="<?= esc($item['jabatan']) ?>" required maxlength="100">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label>Deskripsi Singkat</label>
                                                        <textarea class="form-control" name="deskripsi" rows="3" required><?= esc($item['deskripsi']) ?></textarea>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label>URL Foto (foto_url)</label>
                                                        <input type="text" class="form-control" name="foto_url" value="<?= esc($item['foto_url']) ?>" required placeholder="https://...">
                                                    </div>

                                                    <h6 class="mt-4 mb-3">Tautan Sosial Media (Opsional)</h6>
                                                    <div class="row">
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label>Link Twitter</label>
                                                            <input type="url" class="form-control" name="link_twitter" value="<?= esc($item['link_twitter']) ?>">
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label>Link Facebook</label>
                                                            <input type="url" class="form-control" name="link_facebook" value="<?= esc($item['link_facebook']) ?>">
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label>Link LinkedIn</label>
                                                            <input type="url" class="form-control" name="link_linkedin" value="<?= esc($item['link_linkedin']) ?>">
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <label>Link Instagram</label>
                                                            <input type="url" class="form-control" name="link_instagram" value="<?= esc($item['link_instagram']) ?>">
                                                        </div>
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

                            <?php if (empty($anggota)): ?>
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data anggota tim.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- MODAL TAMBAH DATA (Berada di luar tabel) -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Anggota Tim</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('anggota-tim/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" value="<?= old('nama') ?>" required maxlength="100" placeholder="Contoh: John Doe">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label>Jabatan</label>
                            <input type="text" class="form-control" name="jabatan" value="<?= old('jabatan') ?>" required maxlength="100" placeholder="Contoh: Marketing Manager">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label>Deskripsi Singkat</label>
                        <textarea class="form-control" name="deskripsi" rows="3" required placeholder="Tuliskan deskripsi mengenai anggota ini..."><?= old('deskripsi') ?></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>URL Foto (foto_url)</label>
                        <input type="text" class="form-control" name="foto_url" value="<?= old('foto_url') ?>" required placeholder="https://domain.com/foto.jpg">
                    </div>

                    <h6 class="mt-4 mb-3">Tautan Sosial Media (Opsional)</h6>
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label>Link Twitter</label>
                            <input type="url" class="form-control" name="link_twitter" value="<?= old('link_twitter') ?>" placeholder="https://twitter.com/...">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label>Link Facebook</label>
                            <input type="url" class="form-control" name="link_facebook" value="<?= old('link_facebook') ?>" placeholder="https://facebook.com/...">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label>Link LinkedIn</label>
                            <input type="url" class="form-control" name="link_linkedin" value="<?= old('link_linkedin') ?>" placeholder="https://linkedin.com/in/...">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label>Link Instagram</label>
                            <input type="url" class="form-control" name="link_instagram" value="<?= old('link_instagram') ?>" placeholder="https://instagram.com/...">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>