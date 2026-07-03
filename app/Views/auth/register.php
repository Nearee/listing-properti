<?= $this->extend('auth/layout') ?>

<?= $this->section('content') ?>

<div class="tab-bar">
    <a href="<?= base_url('/login') ?>" class="tab-btn">Masuk</a>
    <a href="<?= base_url('/register') ?>" class="tab-btn active">Daftar</a>
</div>

<div class="form-panel">
    <h2>Buat Akun Baru</h2>
    <p class="subtitle">Daftar akun member untuk menemukan properti impian Anda.</p>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert-error-box">
            <strong>Gagal mendaftar:</strong>
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('auth/register') ?>" method="post">
        <?= csrf_field() ?>

        <div class="field">
            <label for="username">Username (Min. 4 karakter)</label>
            <div class="input-wrap">
                <i class="fa-solid fa-user-plus input-icon"></i>
                <input type="text" id="username" name="username" placeholder="Buat username baru" value="<?= old('username') ?>" required />
            </div>
        </div>

        <div class="field">
            <label for="password">Password (Min. 8 karakter)</label>
            <div class="input-wrap">
                <i class="fa-solid fa-key input-icon"></i>
                <input type="password" id="password" name="password" placeholder="Gunakan password kuat" required />
                <button class="btn-eye" type="button" onclick="togglePw('password', this)">
                    <i class="fa-regular fa-eye"></i>
                </button>
            </div>

            <div class="strength-wrap" id="strength-wrap">
                <div class="strength-bar">
                    <div class="strength-fill" id="strength-fill"></div>
                </div>
                <div class="strength-label" id="strength-label"></div>
            </div>
        </div>

        <div class="field">
            <label for="password_confirm">Konfirmasi Password</label>
            <div class="input-wrap">
                <i class="fa-solid fa-lock input-icon"></i>
                <input type="password" id="password_confirm" name="password_confirm" placeholder="Tulis ulang password" required />
                <button class="btn-eye" type="button" onclick="togglePw('password_confirm', this)">
                    <i class="fa-regular fa-eye"></i>
                </button>
            </div>
        </div>

        <button class="btn-submit" type="submit" style="margin-top: 5px;">
            <span class="btn-text">Buat Akun Member</span>
        </button>

        <div class="switch-link">
            Sudah memiliki akun? <a href="<?= base_url('/login') ?>">Masuk di sini</a>
        </div>
        <div class="switch-link">
        <a href="<?= base_url('/') ?>">Kembali ke Beranda</a>
      </div>
    </form>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.getElementById('password_confirm').addEventListener('input', function() {
        const password = document.getElementById('password').value;
        const confirm = this.value;

        if (confirm !== password) {
            this.style.borderColor = '#c0392b';
        } else {
            this.style.borderColor = '#2ecc71';
        }
    });
</script>
<?= $this->endSection() ?>