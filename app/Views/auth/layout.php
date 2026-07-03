<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= $title ?? 'Auth' ?> &mdash; Perum Sidodadi Residence</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ── RESET & ROOT VARIABLES ── */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --primary: #005454;
            --primary-dk: #019494;
            --accent: #019494;
            --dark: #1a1a2e;
            --text: #3d3d3d;
            --muted: #8a94a6;
            --border: #dde3ec;
            --bg: #f4f6fb;
            --white: #ffffff;
            --red: #c0392b;
            --green: #2d7a4f;
            --radius: 10px;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.12);
        }

        html,
        body {
            height: 100%;
            font-family: 'Work Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
        }

        .page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 500px;
        }

        /* ── PANEL KIRI DENGAN BACKGROUND GAMBAR & OPACITY GELAP ── */
        .panel-left {
            /* Menggunakan linear-gradient hitam dengan opacity 75% menumpuk di atas gambar */
            background: linear-gradient(rgba(26, 26, 46, 0.75), rgba(26, 26, 46, 0.85)),
                url('https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&q=80&w=1200') center/cover no-repeat;
            color: var(--white);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px;
            position: relative;
        }

        .brand {
            text-decoration: none;
            color: var(--white);
            margin-bottom: 40px;
        }

        .brand-name {
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .panel-hero h1 {
            font-size: 3.2rem;
            margin-bottom: 20px;
            line-height: 1.2;
            font-weight: 700;
        }

        .panel-hero em {
            color: var(--accent);
            font-style: normal;
        }

        .panel-hero p {
            font-size: 1.15rem;
            opacity: 0.85;
            line-height: 1.6;
            max-width: 500px;
        }

        .panel-footer {
            margin-top: auto;
            font-size: 0.85rem;
            opacity: 0.6;
        }

        /* Panel Kanan - Container Form */
        .panel-right {
            background: var(--white);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 50px;
            box-shadow: -10px 0 30px rgba(0, 0, 0, 0.03);
        }

        .auth-box {
            width: 100%;
            max-width: 380px;
            margin: 0 auto;
        }

        /* ── TAB BAR COMPONENT ── */
        .tab-bar {
            display: flex;
            background: var(--bg);
            padding: 5px;
            border-radius: var(--radius);
            margin-bottom: 30px;
        }

        .tab-btn {
            flex: 1;
            text-align: center;
            padding: 10px 0;
            text-decoration: none;
            color: var(--muted);
            font-weight: 600;
            font-size: 0.95rem;
            border-radius: calc(var(--radius) - 2px);
            transition: all 0.25s ease;
        }

        .tab-btn:hover {
            color: var(--primary);
        }

        .tab-btn.active {
            background: var(--white);
            color: var(--primary);
            box-shadow: var(--shadow-sm);
        }

        /* ── STRUKTUR KONTEN & FORM ── */
        .form-panel h2 {
            font-size: 1.8rem;
            color: var(--dark);
            margin-bottom: 6px;
            font-weight: 700;
        }

        .subtitle {
            font-size: 0.95rem;
            color: var(--muted);
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .field {
            margin-bottom: 20px;
        }

        .field label {
            display: block;
            font-size: 0.88rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text);
        }

        /* ── CSS UNTUK INPUT DENGAN IKON ── */
        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        /* Ikon di sisi kiri */
        .input-icon {
            position: absolute;
            left: 14px;
            color: var(--muted);
            font-size: 1.1rem;
            transition: color 0.3s;
        }

        .input-wrap input {
            width: 100%;
            padding: 12px 16px 12px 42px;
            /* Padding kiri ditambah (42px) agar teks tidak menabrak ikon */
            border: 1px solid var(--border);
            border-radius: var(--radius);
            font-family: inherit;
            font-size: 0.95rem;
            color: var(--text);
            background: var(--bg);
            transition: all 0.2s ease;
        }

        /* Warna ikon berubah saat input fokus */
        .input-wrap input:focus {
            outline: none;
            border-color: var(--primary);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(59, 89, 152, 0.1);
        }

        .input-wrap input:focus+.input-icon,
        .input-wrap input:focus~.input-icon {
            color: var(--primary);
        }

        .btn-eye {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--muted);
            cursor: pointer;
        }

        .btn-eye:hover {
            color: var(--primary);
        }

        /* ── TOMBOL SUBMIT DLL ── */
        .btn-submit {
            width: 100%;
            padding: 14px;
            background: var(--primary);
            color: var(--white);
            border: none;
            border-radius: var(--radius);
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(59, 89, 152, 0.2);
        }

        .btn-submit:hover {
            background: var(--primary-dk);
            transform: translateY(-1px);
        }

        .switch-link {
            text-align: center;
            margin-top: 25px;
            font-size: 0.9rem;
            color: var(--muted);
        }

        .switch-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .alert-error-box {
            background: #fde8e8;
            border-left: 4px solid var(--red);
            color: var(--red);
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 6px;
            font-size: 0.88rem;
        }

        .alert-error-box ul {
            margin-left: 18px;
            margin-top: 4px;
        }

        .strength-wrap {
            margin-top: 8px;
            display: none;
        }

        .strength-wrap.show {
            display: block;
        }

        .strength-bar {
            height: 6px;
            background: var(--border);
            border-radius: 3px;
            overflow: hidden;
            margin-bottom: 5px;
        }

        .strength-fill {
            height: 100%;
            width: 0;
            transition: all 0.3s ease;
        }

        .strength-label {
            font-size: 0.8rem;
            font-weight: 600;
        }

        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 24px;
            color: var(--white);
            background: var(--dark);
            border-radius: var(--radius);
            font-size: 0.95rem;
            font-weight: 500;
            box-shadow: var(--shadow-md);
            transform: translateY(-20px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            z-index: 9999;
            pointer-events: none;
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        @media (max-width: 900px) {
            .page {
                grid-template-columns: 1fr;
            }

            .panel-left {
                display: none;
            }

            .panel-right {
                padding: 40px 20px;
            }
        }
    </style>
</head>

<body>

    <div class="page">
        <div class="panel-left">
            <div class="brand">
                <div class="brand-name"><i class="fa-solid fa-house-chimney"></i> Sidodadi Residence</div>
            </div>
            <div class="panel-hero">
                <h1><em>Admin</em></h1>
                <p>Silahkan login untuk melanjutkan</p>
            </div>
            <div class="panel-footer">&copy; <?= date('Y') ?> Perum Sidodadi Residence.</div>
        </div>

        <div class="panel-right">
            <div class="auth-box">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>


    <div class="toast" id="toast"></div>

    <script>
        function toast(msg, isSuccess = true) {
            const t = document.getElementById('toast');
            t.textContent = msg;
            t.style.background = isSuccess ? 'var(--green)' : 'var(--red)';
            t.classList.add('show');
            setTimeout(() => t.classList.remove('show'), 3500);
        }

        function togglePw(id, btn) {
            const inp = document.getElementById(id);
            if (inp.type === 'password') {
                inp.type = 'text';
                btn.innerHTML = '<i class="fa-regular fa-eye-slash"></i>'; // Ganti teks dengan ikon silang
            } else {
                inp.type = 'password';
                btn.innerHTML = '<i class="fa-regular fa-eye"></i>'; // Ganti teks dengan ikon mata
            }
        }

        <?php if (session()->getFlashdata('success')): ?>
            toast("<?= session()->getFlashdata('success') ?>", true);
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            toast("<?= session()->getFlashdata('error') ?>", false);
        <?php endif; ?>
    </script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>