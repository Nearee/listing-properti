<?= $this->extend('front/index') ?>
<?= $this->section('content') ?>

<div class="hero page-inner overlay" style="background-image: url('<?= base_url('assets/images/hero_bg_1.jpg') ?>')">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-9 text-center mt-5">
                <h1 class="heading" data-aos="fade-up">Services</h1>
                <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                    <ol class="breadcrumb text-center justify-content-center">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">
                            Services
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="section bg-light">
    <div class="container">
        <div class="row">
            <?php if (!empty($layanan)): ?>
                <?php $delay = 300; ?>
                <?php foreach ($layanan as $item): ?>
                    <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                        <div class="box-feature mb-4">
                            <span class="<?= esc($item['icon_class']) ?> mb-4 d-block"></span>
                            <h3 class="text-black mb-3 font-weight-bold">
                                <?= esc($item['judul']) ?>
                            </h3>
                            <p class="text-black-50">
                                <?= esc($item['deskripsi']) ?>
                            </p>
                            <?php if (!empty($item['link_url'])): ?>
                                <p><a href="<?= esc($item['link_url']) ?>" class="learn-more">Read more</a></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php $delay += 100; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p>Belum ada layanan yang ditambahkan.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="section sec-testimonials">
    <div class="container">
        <div class="row mb-5 align-items-center">
            <div class="col-md-6">
                <h2 class="font-weight-bold heading text-primary mb-4 mb-md-0">
                    Customer Says
                </h2>
            </div>
            <div class="col-md-6 text-md-end">
                <div id="testimonial-nav">
                    <span class="prev" data-controls="prev">Prev</span>

                    <span class="next" data-controls="next">Next</span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4"></div>
        </div>
        <div class="testimonial-slider-wrap">
            <div class="testimonial-slider">
                <?php if (!empty($ulasan)): ?>
                    <?php foreach ($ulasan as $item): ?>
                        <div class="item">
                            <div class="testimonial">
                                <img src="<?= base_url('assets/images/pp.png') ?>" alt="Image"
                                    class="img-fluid rounded-circle w-25 mb-4" />
                                <div class="rate">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <span class="icon-star <?= $i <= $item['rating'] ? 'text-warning' : 'text-muted' ?>"></span>
                                    <?php endfor; ?>
                                </div>
                                <h3 class="h5 text-primary mb-4"><?= esc($item['nama_klien']) ?></h3>
                                <blockquote>
                                    <p>
                                        &ldquo;<?= esc($item['komentar']) ?>&rdquo;
                                    </p>
                                </blockquote>
                                <p class="text-black-50">Customer</p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="item">
                        <p class="text-center">Belum ada ulasan.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>