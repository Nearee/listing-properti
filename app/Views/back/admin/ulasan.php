<?php $this->extend('back/layout/dashboard') ?>
<?php $this->section('content') ?>

<section class="section">
    <!-- Notifikasi Sukses/Error -->
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible show fade">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Daftar Ulasan Pengguna</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive datatable-minimal">
                <table class="table table-hover" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Klien</th>
                            <th>Rating</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($ulasan as $item) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($item['nama_klien']) ?></td>
                                <td>
                                    <!-- Menampilkan Bintang Emas -->
                                    <div class="text-warning">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <i class="bi bi-star<?= $i <= $item['rating'] ? '-fill' : '' ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                </td>
                                <td>
                                    <?php if ($item['status'] == 'approved') : ?>
                                        <span class="badge bg-success">Ditayangkan</span>
                                    <?php else : ?>
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <!-- Tombol Detail -->
                                    <button type="button" class="btn btn-sm btn-info mb-1" data-bs-toggle="modal" data-bs-target="#detailModal<?= $item['id'] ?>">
                                        <i class="bi bi-eye"></i> Detail
                                    </button>

                                    <?php if ($item['status'] == 'pending') : ?>
                                        <form action="<?= base_url('admin/ulasan/approve/' . $item['id']) ?>" method="post" class="d-inline">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-success mb-1" onclick="return confirm('Tampilkan ulasan ini di Landing Page?')">
                                                <i class="bi bi-check-circle"></i> Approve
                                            </button>
                                        </form>
                                    <?php endif; ?>

                                    <form action="<?= base_url('admin/ulasan/delete/' . $item['id']) ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Yakin ingin menghapus ulasan ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- MODAL DETAIL ULASAN -->
                            <div class="modal fade" id="detailModal<?= $item['id'] ?>" tabindex="-1" aria-labelledby="detailModalLabel<?= $item['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailModalLabel<?= $item['id'] ?>">Detail Ulasan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <small class="text-muted">Nama Klien:</small><br>
                                                <strong><?= esc($item['nama_klien']) ?></strong>
                                            </div>
                                            <div class="mb-3">
                                                <small class="text-muted">Rating:</small><br>
                                                <div class="text-warning fs-5">
                                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                                        <i class="bi bi-star<?= $i <= $item['rating'] ? '-fill' : '' ?>"></i>
                                                    <?php endfor; ?>
                                                    <span class="text-dark fs-6 ms-2">(<?= $item['rating'] ?>/5)</span>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <small class="text-muted">Status Tayang:</small><br>
                                                <?php if ($item['status'] == 'approved') : ?>
                                                    <span class="badge bg-success">Ditayangkan di Landing Page</span>
                                                <?php else : ?>
                                                    <span class="badge bg-warning text-dark">Menunggu Persetujuan Admin</span>
                                                <?php endif; ?>
                                            </div>
                                            <hr>
                                            <div class="mb-3">
                                                <small class="text-muted">Isi Komentar:</small><br>
                                                <p style="white-space: pre-wrap; font-style: italic;">"<?= esc($item['komentar']) ?>"</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END MODAL DETAIL -->
                        <?php endforeach; ?>

                        <?php if (empty($ulasan)): ?>
                            <tr>
                                <td colspan="5" class="text-center">Belum ada ulasan masuk.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php $this->endSection() ?>