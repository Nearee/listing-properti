<?= $this->extend('auth/layout') ?>

<?= $this->section('content') ?>

<div class="form-panel">
  <h2>Masuk Akun</h2>
  <p class="subtitle">Silakan masukkan kredensial Anda untuk mengakses sistem.</p>

  <form action="<?= base_url('auth/login') ?>" method="post">
    <?= csrf_field() ?>

    <div class="field">
      <label for="username">Username</label>
      <div class="input-wrap">
        <i class="fa-solid fa-user input-icon"></i>
        <input type="text" id="username" name="username" placeholder="Masukkan username Anda" value="<?= old('username') ?>" required />
      </div>
    </div>

    <div class="field">
      <label for="password">Password</label>
      <div class="input-wrap">
        <i class="fa-solid fa-lock input-icon"></i>
        <input type="password" id="password" name="password" placeholder="••••••••" required />
        <button class="btn-eye" type="button" onclick="togglePw('password', this)">
          <i class="fa-regular fa-eye"></i>
        </button>
      </div>
    </div>

    <button class="btn-submit" type="submit">
      <span class="btn-text">Masuk Sekarang</span>
    </button>

    <!-- Kembali -->
    <div class="switch-link">
      <a href="<?= base_url('/') ?>">Kembali ke Beranda</a>
    </div>
  </form>
</div>

<?= $this->endSection() ?>