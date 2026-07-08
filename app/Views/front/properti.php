<?php $this->extend('front/index') ?>
<?php $this->section('content') ?>

<div class="hero page-inner overlay" style="background-image: url('<?= base_url('assets/images/hero_bg_1.jpg') ?>')">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-9 text-center mt-5">
                <h1 class="heading" data-aos="fade-up">Properti</h1>

                <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                    <ol class="breadcrumb text-center justify-content-center">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">
                            Properti
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="section" id="properti-section">
    <div class="container">

        <div class="row mb-4 align-items-end" data-aos="fade-up">
            <div class="col-lg-6">
                <span class="pf-eyebrow">Rekomendasi Untuk Anda</span>
                <h2 class="pf-heading m-0">Properti Populer</h2>
            </div>
        </div>

        <div class="pf-panel mb-5" data-aos="fade-up">

            <div class="pf-search">
                <svg class="pf-search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2" />
                    <path d="M20 20L16.65 16.65" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
                <label for="liveSearchInput" class="visually-hidden">Cari properti</label>
                <input type="text" id="liveSearchInput" name="q" class="pf-search-input"
                    placeholder="Cari nama perumahan atau tipe rumah..." autocomplete="off"
                    aria-label="Cari nama perumahan atau tipe rumah" />
                <button type="button" id="liveSearchBtn" class="pf-btn-primary">
                    Cari Rumah
                </button>
            </div>

            <div class="pf-filters">

                <div class="pf-filter-group">
                    <span class="pf-filter-label">Tipe</span>
                    <div class="pf-chip-row" data-group="tipe">
                        <button type="button" class="pf-chip is-active" data-value="all">Semua</button>
                        <button type="button" class="pf-chip" data-value="unggulan">Unggulan</button>
                        <button type="button" class="pf-chip" data-value="populer">Populer</button>
                    </div>
                </div>

                <div class="pf-filter-group">
                    <span class="pf-filter-label">Kamar Tidur</span>
                    <div class="pf-chip-row" data-group="kasur">
                        <button type="button" class="pf-chip is-active" data-value="all">Semua</button>
                        <button type="button" class="pf-chip" data-value="1">1+</button>
                        <button type="button" class="pf-chip" data-value="2">2+</button>
                        <button type="button" class="pf-chip" data-value="3">3+</button>
                        <button type="button" class="pf-chip" data-value="4">4+</button>
                    </div>
                </div>

                <div class="pf-filter-group">
                    <span class="pf-filter-label">Rentang Harga</span>
                    <div class="pf-chip-row" data-group="harga">
                        <button type="button" class="pf-chip is-active" data-value="all">Semua</button>
                        <button type="button" class="pf-chip" data-min="0" data-max="300000000">&lt; 300jt</button>
                        <button type="button" class="pf-chip" data-min="300000000"
                            data-max="500000000">300–500jt</button>
                        <button type="button" class="pf-chip" data-min="500000000"
                            data-max="1000000000">500jt–1M</button>
                        <button type="button" class="pf-chip" data-min="1000000000" data-max="999999999999">&gt;
                            1M</button>
                    </div>
                </div>

                <button type="button" id="pfResetBtn" class="pf-reset">Reset filter</button>
            </div>

            <div id="pfResultCount" class="pf-result-count"></div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="pf-grid" id="propertyGrid">
                    <?php if (empty($properti)): ?>
                        <div class="pf-empty w-100">
                            <p class="mb-0">Belum ada properti yang tersedia saat ini.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($properti as $p):
                            $namaRaw = $p['nama_properti'] ?? 'Tanpa Nama';
                            $nama = esc(is_string($namaRaw) ? $namaRaw : 'Tanpa Nama');
                            $tipeRaw = $p['kategori_tampil'] ?? '-';
                            $tipe = esc(is_string($tipeRaw) ? $tipeRaw : '-');
                            $kamarTdr = (int) ($p['kamar_tidur'] ?? 0);
                            $kamarMdi = (int) ($p['kamar_mandi'] ?? 0);
                            $hargaRaw = (float) ($p['harga'] ?? 0);
                            $harga = number_format($hargaRaw, 0, ',', '.');
                            $gambar = !empty($p['gambar_url'])
                                ? base_url($p['gambar_url'])
                                : base_url('assets/images/no-image.jpg');
                            $detailUrl = base_url('property-single/' . $p['id']);
                            ?>

                            <?php
                            $tipe = is_string($tipeRaw) ? strtolower($tipeRaw) : '-';
                            if ($tipe === 'tidak_ada' || $tipe === '-') {
                                $tipe = 'properti';
                            }
                            ?>

                            <a href="<?= $detailUrl ?>" class="pf-card"
                                data-nama="<?= strtolower(is_string($namaRaw) ? $namaRaw : 'Tanpa Nama') ?>"
                                data-tipe="<?= $tipe ?>" data-kasur="<?= $kamarTdr ?>" data-harga="<?= (int) $hargaRaw ?>">

                                <div class="pf-card-img">
                                    <img src="<?= esc($gambar) ?>" alt="<?= $nama ?>" loading="lazy"
                                        onerror="this.onerror=null;this.src='<?= base_url('assets/images/no-image.jpg') ?>';" />
                                    <span class="pf-badge"><?= $tipe ?></span>
                                </div>

                                <div class="pf-card-body">
                                    <div class="pf-price">Rp <?= $harga ?></div>
                                    <div class="pf-name"><?= $nama ?></div>

                                    <div class="pf-specs">
                                        <span class="pf-spec">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                                <path d="M3 18v-6a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v6" stroke="currentColor"
                                                    stroke-width="1.8" stroke-linecap="round" />
                                                <path d="M3 18v2M21 18v2M3 12V9a2 2 0 0 1 2-2h6" stroke="currentColor"
                                                    stroke-width="1.8" stroke-linecap="round" />
                                            </svg>
                                            <?= $kamarTdr ?> Kasur
                                        </span>
                                        <span class="pf-spec">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                                <path d="M4 12h16v3a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4v-3Z" stroke="currentColor"
                                                    stroke-width="1.8" />
                                                <path d="M7 12V6a2 2 0 0 1 3-1.7" stroke="currentColor" stroke-width="1.8"
                                                    stroke-linecap="round" />
                                            </svg>
                                            <?= $kamarMdi ?> Toilet
                                        </span>
                                    </div>

                                    <span class="pf-cta">Lihat Detail →</span>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div id="liveSearchNoResult" class="pf-empty d-none">
                    <p class="mb-0">Properti tidak ditemukan. Coba ubah kata kunci atau filter.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/properti.js') ?>"></script>
<?php $this->endSection() ?>