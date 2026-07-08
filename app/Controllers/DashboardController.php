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
        $pesanModel = new PesanMasukModel();
        $lokasiModel = new LokasiModel();
        $ulasanModel = new UlasanModel();

        $data = [
            'title' => 'Dashboard Admin',
            'total_properti' => $propertiModel->countAllResults(),
            'total_pesan' => $pesanModel->countAllResults(),
            'total_lokasi' => $lokasiModel->countAllResults(),
            'total_ulasan' => $ulasanModel->countAllResults(),

            'pesan_terbaru' => $pesanModel->orderBy('created_at', 'DESC')->findAll(5),
            'properti_terbaru' => $propertiModel->orderBy('created_at', 'DESC')->findAll(5),
            'ulasan_terbaru' => $ulasanModel->orderBy('id', 'DESC')->findAll(5),
        ];

        return view('back/admin/dashboard', $data);
    }
    public function Pengaturan()
    {
        return view('back/layout/pengaturan');
    }
}