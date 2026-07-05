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
                        foreach ($pesan as $item): ?>
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
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                        data-bs-target="#detailModal<?= $item['id'] ?>">
                                        <i class="bi bi-eye"></i> Detail
                                    </button>

                                    <form action="<?= base_url('admin/pesan/delete/' . $item['id']) ?>" method="post"
                                        class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus pesan ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="detailModal<?= $item['id'] ?>" tabindex="-1"
                                aria-labelledby="detailModalLabel<?= $item['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailModalLabel<?= $item['id'] ?>">Detail Pesan
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
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
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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