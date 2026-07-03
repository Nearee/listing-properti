<?php

namespace App\Controllers;
use App\Models\PropertiModel;
use App\Models\PesanMasukModel;
use App\Models\LokasiModel;
use App\Models\UlasanModel;

class DashboardController extends BaseController
{
    public function Dashboard()
    {
        $propertiModel = new PropertiModel();
        $pesanModel    = new PesanMasukModel();
        $lokasiModel   = new LokasiModel();
        $ulasanModel   = new UlasanModel();

        $data = [
            'title'            => 'Dashboard Admin',
            // Menghitung total data untuk Widget Cards
            'total_properti'   => $propertiModel->countAllResults(),
            'total_pesan'      => $pesanModel->countAllResults(),
            'total_lokasi'     => $lokasiModel->countAllResults(),
            'total_ulasan'     => $ulasanModel->countAllResults(),

            'pesan_terbaru'    => $pesanModel->orderBy('created_at', 'DESC')->findAll(5),
            'properti_terbaru' => $propertiModel->orderBy('created_at', 'DESC')->findAll(5),
            'ulasan_terbaru'   => $ulasanModel->orderBy('id', 'DESC')->findAll(5),
        ];

        return view('back/admin/dashboard', $data);
    }
    public function Pengaturan()
    {
        return view('back/layout/pengaturan');
    }
    public function Layanan()
    {
        return view('back/admin/layanan');
    }
    public function Galeri()
    {
        return view('back/admin/galeri');
    }
    public function Ulasan()
    {
        return view('back/admin/ulasan');
    }
    public function AnggotaTim()
    {
        return view('back/admin/anggota-tim');
    }
    public function Pesan()
    {
        return view('back/admin/pesan');
    }
    public function ProfilPerusahaan()
    {
        return view('back/admin/profilperusahaan');
    }
    public function Lokasi()
    {
        return view('back/admin/lokasi');
    }
}
