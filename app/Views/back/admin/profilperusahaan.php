<?= $this->extend('back/layout/dashboard') ?>
<?= $this->section('content') ?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Profil Perusahaan</h3>
                <p class="text-subtitle text-muted font-semibold">Kelola informasi profil perusahaan Anda dalam satu halaman</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profil</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12">

                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('errors')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url('profilperusahaan/save') ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="form-group mb-3">
                                <label for="deskripsi_tentang" class="form-label">Deskripsi Tentang</label>
                                <textarea name="deskripsi_tentang" id="deskripsi_tentang" class="form-control" rows="4" placeholder="Deskripsi singkat mengenai perusahaan..."><?= old('deskripsi_tentang', $profil->deskripsi_tentang ?? '') ?></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="teks_visi" class="form-label">Teks Visi</label>
                                <textarea name="teks_visi" id="teks_visi" class="form-control" rows="3" placeholder="Visi perusahaan..."><?= old('teks_visi', $profil->teks_visi ?? '') ?></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="teks_misi" class="form-label">Teks Misi</label>
                                <textarea name="teks_misi" id="teks_misi" class="form-control" rows="3" placeholder="Misi perusahaan..."><?= old('teks_misi', $profil->teks_misi ?? '') ?></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="alamat_kantor" class="form-label">Alamat Kantor</label>
                                <input type="text" name="alamat_kantor" id="alamat_kantor" class="form-control" placeholder="Alamat lengkap kantor" value="<?= old('alamat_kantor', $profil->alamat_kantor ?? '') ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label for="jam_operasional" class="form-label">Jam Operasional</label>
                                <input type="text" name="jam_operasional" id="jam_operasional" class="form-control" placeholder="Contoh: Senin - Jumat, 08:00 - 17:00" value="<?= old('jam_operasional', $profil->jam_operasional ?? '') ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label for="email_kantor" class="form-label">Email Kantor</label>
                                <input type="email" name="email_kantor" id="email_kantor" class="form-control" placeholder="email@perusahaan.com" value="<?= old('email_kantor', $profil->email_kantor ?? '') ?>">
                            </div>

                            <div class="form-group mb-4">
                                <label for="telepon_kantor" class="form-label">Telepon Kantor</label>
                                <input type="text" name="telepon_kantor" id="telepon_kantor" class="form-control" placeholder="Contoh: 021-1234567 atau 0812xxxxxxxx" value="<?= old('telepon_kantor', $profil->telepon_kantor ?? '') ?>">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>