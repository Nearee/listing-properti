<?= $this->extend('front/index') ?>
<?= $this->section('content') ?>

<div class="hero page-inner overlay" style="background-image: url('<?= base_url('assets/images/type40.jpg') ?>')">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-9 text-center mt-5">
                <h1 class="heading" data-aos="fade-up">Tentang Kami</h1>

                <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                    <ol class="breadcrumb text-center justify-content-center">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">
                            Tentang
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row text-left mb-5">
            <div class="col-12">
                <h2 class="font-weight-bold heading text-primary mb-4">Profil Perusahaan</h2>
            </div>

            <!-- DESKRIPSI TENTANG KAMI DINAMIS -->
            <div class="col-lg-12 mb-5">
                <p class="text-black-50">
                    <?= (esc($profil->deskripsi_tentang ?? 'Deskripsi perusahaan belum diisi.')) ?>
                </p>
            </div>

            <!-- VISI DINAMIS -->
            <div class="col-lg-6">
                <h4 class="text-primary font-weight-bold">VISI</h4>
                <p class="text-black-50">
                    <?= (esc($profil->teks_visi ?? 'Visi belum diisi.')) ?>
                </p>
            </div>

            <!-- MISI DINAMIS -->
            <div class="col-lg-6">
                <h4 class="text-primary font-weight-bold">MISI</h4>
                <p class="text-black-50">
                    <?= (esc($profil->teks_misi ?? 'Misi belum diisi.')) ?>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="section pt-0">
    <div class="container">
        <div class="row justify-content-between mb-5">
            <div class="col-lg-7 mb-5 mb-lg-0 order-lg-2">
                <div class="img-about dots">
                    <img src="<?= base_url('assets/images/type60-84.jpg') ?>" alt="Image" class="img-fluid" />
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex feature-h">
                    <span class="wrap-icon me-3">
                        <span class="icon-home2"></span>
                    </span>
                    <div class="feature-text">
                        <h3 class="heading">Quality properties</h3>
                        <p class="text-black-50">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum iste.
                        </p>
                    </div>
                </div>

                <div class="d-flex feature-h">
                    <span class="wrap-icon me-3">
                        <span class="icon-person"></span>
                    </span>
                    <div class="feature-text">
                        <h3 class="heading">Top rated agents</h3>
                        <p class="text-black-50">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum iste.
                        </p>
                    </div>
                </div>

                <div class="d-flex feature-h">
                    <span class="wrap-icon me-3">
                        <span class="icon-security"></span>
                    </span>
                    <div class="feature-text">
                        <h3 class="heading">Easy and safe</h3>
                        <p class="text-black-50">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum iste.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row section-counter mt-5">
            <div
                class="col-6 col-sm-6 col-md-6 col-lg-3"
                data-aos="fade-up"
                data-aos-delay="300">
                <div class="counter-wrap mb-5 mb-lg-0">
                    <span class="number"><span class="countup text-primary">2917</span></span>
                    <span class="caption text-black-50"># of Buy Properties</span>
                </div>
            </div>
            <div
                class="col-6 col-sm-6 col-md-6 col-lg-3"
                data-aos="fade-up"
                data-aos-delay="400">
                <div class="counter-wrap mb-5 mb-lg-0">
                    <span class="number"><span class="countup text-primary">3918</span></span>
                    <span class="caption text-black-50"># of Sell Properties</span>
                </div>
            </div>
            <div
                class="col-6 col-sm-6 col-md-6 col-lg-3"
                data-aos="fade-up"
                data-aos-delay="500">
                <div class="counter-wrap mb-5 mb-lg-0">
                    <span class="number"><span class="countup text-primary">38928</span></span>
                    <span class="caption text-black-50"># of All Properties</span>
                </div>
            </div>
            <div
                class="col-6 col-sm-6 col-md-6 col-lg-3"
                data-aos="fade-up"
                data-aos-delay="600">
                <div class="counter-wrap mb-5 mb-lg-0">
                    <span class="number"><span class="countup text-primary">1291</span></span>
                    <span class="caption text-black-50"># of Agents</span>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="section sec-testimonials bg-light">
    <div class="container">
        <div class="row mb-5 align-items-center">
            <div class="col-md-6">
                <h2 class="font-weight-bold heading text-primary mb-4 mb-md-0">
                    The Team
                </h2>
            </div>
            <div class="col-md-6 text-md-end">
                <div id="testimonial-nav">
                    <span class="prev" data-controls="prev">Prev</span>
                    <span class="next" data-controls="next">Next</span>
                </div>
            </div>
        </div>

        <div class="testimonial-slider-wrap">
            <div class="testimonial-slider">

                <!-- LOOPING DATA ANGGOTA TIM DINAMIS -->
                <?php if (!empty($anggota)) : ?>
                    <?php foreach ($anggota as $person) : ?>
                        <div class="item">
                            <div class="testimonial">
                                <img src="<?= esc($person['foto_url']) ?>" alt="Foto <?= esc($person['nama']) ?>" class="img-fluid rounded-circle w-25 mb-4" style="aspect-ratio: 1/1; object-fit: cover;" />
                                <h3 class="h5 text-primary"><?= esc($person['nama']) ?></h3>
                                <p class="text-black-50"><?= esc($person['jabatan']) ?></p>

                                <p><?= esc($person['deskripsi']) ?></p>

                                <ul class="social list-unstyled list-inline dark-hover">
                                    <?php if (!empty($person['link_twitter'])) : ?>
                                        <li class="list-inline-item">
                                            <a href="<?= esc($person['link_twitter']) ?>" target="_blank"><span class="icon-twitter"></span></a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if (!empty($person['link_facebook'])) : ?>
                                        <li class="list-inline-item">
                                            <a href="<?= esc($person['link_facebook']) ?>" target="_blank"><span class="icon-facebook"></span></a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if (!empty($person['link_linkedin'])) : ?>
                                        <li class="list-inline-item">
                                            <a href="<?= esc($person['link_linkedin']) ?>" target="_blank"><span class="icon-linkedin"></span></a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if (!empty($person['link_instagram'])) : ?>
                                        <li class="list-inline-item">
                                            <a href="<?= esc($person['link_instagram']) ?>" target="_blank"><span class="icon-instagram"></span></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="item">
                        <p class="text-center">Belum ada data anggota tim.</p>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>