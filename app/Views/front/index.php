<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Untree.co" />
    <link rel="shortcut icon" href="<?= base_url('assets/favicon.png') ?>" />

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="<?= base_url('assets/fonts/icomoon/style.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/fonts/flaticon/font/flaticon.css') ?>" />

    <link rel="stylesheet" href="<?= base_url('assets/css/tiny-slider.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/aos.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/navbar.css') ?>" />

    <title>
        Perum &mdash; Sidodadi Residence
    </title>
</head>

<body>
    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close">
                <span class="icofont-close js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    <?= $this->include('layout/navbar') ?>

    <?= $this->renderSection('content') ?>
    
    <?= $this->include('layout/footer') ?>

    <div id="overlayer"></div>
    <div class="loader">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/tiny-slider.js') ?>"></script>
    <script src="<?= base_url('assets/js/aos.js') ?>"></script>
    <script src="<?= base_url('assets/js/navbar.js') ?>"></script>
    <script src="<?= base_url('assets/js/counter.js') ?>"></script>
    <script src="<?= base_url('assets/js/custom.js') ?>"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const searchForm = document.querySelector('.form-search');

            // Fungsi utama pencarian
            function filterProperties() {
                let filter = searchInput.value.toUpperCase();
                // Pada template property-1.0.0, pembungkusnya biasanya adalah .property-item
                let cards = document.querySelectorAll('.property-item');

                cards.forEach(card => {
                    // Mengambil teks dari judul h3 di dalam card
                    let title = card.querySelector('h3') ? card.querySelector('h3').innerText : "";
                    // Mengambil teks alamat/lokasi jika ada
                    let location = card.querySelector('.city') ? card.querySelector('.city').innerText : "";

                    if (title.toUpperCase().indexOf(filter) > -1 || location.toUpperCase().indexOf(filter) > -1) {
                        card.parentElement.style.display = ""; // Sembunyikan kolom (col-6/col-4) agar layout tidak berantakan
                    } else {
                        card.parentElement.style.display = "none";
                    }
                });
            }

            // Jalankan fungsi setiap kali mengetik (Real-time)
            searchInput.addEventListener('keyup', filterProperties);

            // Mencegah error "Cannot GET /searchForm" saat tombol diklik
            searchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                filterProperties();
            });
        });
    </script>
</body>

</html>