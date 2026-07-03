<?= $this->extend('back/layout/dashboard') ?>
<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pengaturan Tema</h3>
                <p class="text-subtitle text-muted">Sesuaikan tampilan antarmuka panel admin sesuai kenyamanan Anda.</p>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <section class="section">
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="bi bi-palette-fill me-2 text-primary"></i>Mode Tampilan</h4>
                    </div>
                    <div class="card-body">
                        <p>Pilih mode gelap jika Anda bekerja di ruangan yang minim cahaya untuk mengurangi ketegangan pada mata.</p>

                        <div class="d-flex align-items-center justify-content-between p-3 border rounded">
                            <div class="d-flex align-items-center gap-3">
                                <!-- <i class="bi bi-moon-stars-fill fs-4 text-secondary" id="theme-icon-status"></i> -->
                                <div>
                                    <h6 class="mb-0">Mode Gelap (Dark Mode)</h6>
                                    <small class="text-muted" id="theme-text-status">Mengaktifkan tema gelap sistem</small>
                                </div>
                            </div>

                            <div class="form-check form-switch fs-4 mb-0">
                                <input class="form-check-input" type="checkbox" id="toggle-dark" style="cursor: pointer">
                                <label class="form-check-label"></label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>