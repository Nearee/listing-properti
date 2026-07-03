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
            <h5 class="card-title mb-0">Daftar Pesan Masuk</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive datatable-minimal">
                <table class="table table-hover" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Pengirim</th>
                            <th>Email</th>
                            <th>Subjek</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($pesan as $item) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= date('d M Y, H:i', strtotime($item['created_at'])) ?></td>
                                <td><?= esc($item['nama_pengirim']) ?></td>
                                <td>
                                    <a href="mailto:<?= esc($item['email']) ?>"><?= esc($item['email']) ?></a>
                                </td>
                                <td>
                                    <strong><?= esc($item['subjek']) ?></strong>
                                </td>
                                <td>
                                    <!-- Tombol Detail -->
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal<?= $item['id'] ?>">
                                        <i class="bi bi-eye"></i> Detail
                                    </button>

                                    <!-- Tombol Hapus -->
                                    <form action="<?= base_url('admin/pesan/delete/' . $item['id']) ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus pesan ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- MODAL DETAIL PESAN -->
                            <div class="modal fade" id="detailModal<?= $item['id'] ?>" tabindex="-1" aria-labelledby="detailModalLabel<?= $item['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailModalLabel<?= $item['id'] ?>">Detail Pesan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <small class="text-muted">Dari:</small><br>
                                                <strong><?= esc($item['nama_pengirim']) ?></strong>
                                                (<a href="mailto:<?= esc($item['email']) ?>"><?= esc($item['email']) ?></a>)
                                            </div>
                                            <div class="mb-3">
                                                <small class="text-muted">Tanggal:</small><br>
                                                <?= date('d F Y, H:i:s', strtotime($item['created_at'])) ?>
                                            </div>
                                            <div class="mb-3">
                                                <small class="text-muted">Subjek:</small><br>
                                                <strong><?= esc($item['subjek']) ?></strong>
                                            </div>
                                            <hr>
                                            <div class="mb-3">
                                                <small class="text-muted">Isi Pesan:</small><br>
                                                <p style="white-space: pre-wrap;"><?= esc($item['pesan']) ?></p>
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

                        <?php if (empty($pesan)): ?>
                            <tr>
                                <td colspan="6" class="text-center">Belum ada pesan masuk.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php $this->endSection() ?>