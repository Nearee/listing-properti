<?php $this->extend('front/index') ?>
<?php $this->section('content') ?>

<div class="hero page-inner overlay" style="background-image: url('<?= base_url($properti['gambar_url']) ?>');">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-9 text-center mt-5 pt-5">
                <h1 class="heading text-white" data-aos="fade-up">
                    <?= esc($properti['nama_properti']) ?>
                </h1>
                <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                    <ol class="breadcrumb text-center justify-content-center bg-transparent p-0 mt-3">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>" class="text-white-50">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active text-white" aria-current="page">
                            Detail Properti
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row justify-content-between">

            <div class="col-lg-7 mb-5 mb-lg-0" data-aos="fade-up">
                <div class="img-property-slide-wrap mb-4">
                    <img src="<?= base_url($properti['gambar_url']) ?>"
                        alt="Gambar <?= esc($properti['nama_properti']) ?>" class="img-fluid rounded shadow-sm w-100"
                        style="max-height: 500px; object-fit: cover;" />
                </div>
                <h2 class="heading text-primary mb-3"><?= esc($properti['nama_properti']) ?></h2>
                <p class="meta text-muted mb-4">
                    Nomor Rumah: <strong><?= esc($properti['nomor_rumah']) ?></strong> |
                    Tipe: <strong><?= esc($properti['kategori_tampil']) ?></strong>
                </p>

                <h4 class="text-dark mb-3">Deskripsi Singkat</h4>
                <p class="text-black-50" style="white-space: pre-line;">
                    <?= esc($properti['deskripsi'] ?? 'Deskripsi properti belum ditambahkan.') ?>
                </p>
            </div>

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow p-4 rounded-4 position-sticky" style="top: 100px;">
                    <h3 class="heading text-primary mb-4 pb-2 border-bottom">Informasi Utama</h3>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-black-50"><i class="icon-money me-2"></i> Harga</span>
                        <strong class="text-success fs-5">Rp
                            <?= number_format($properti['harga'], 0, ',', '.') ?></strong>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-black-50"><i class="icon-bed me-2"></i> Kamar Tidur</span>
                        <strong class="text-dark"><?= esc($properti['kamar_tidur']) ?> Ruangan</strong>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                        <span class="text-black-50"><i class="icon-bath me-2"></i> Kamar Mandi</span>
                        <strong class="text-dark"><?= esc($properti['kamar_mandi']) ?> Ruangan</strong>
                    </div>

                    <a href="<?= base_url('/') ?>" class="btn btn-outline-secondary w-100 py-3 rounded-pill fw-bold">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<?php $this->endSection() ?>