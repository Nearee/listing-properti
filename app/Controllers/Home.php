<?php

namespace App\Controllers;

use App\Models\ProfilPerusahaanModel;
use App\Models\AnggotaTimModel;
use App\Models\PesanMasukModel;
use App\Models\PropertiModel;
use App\Models\GaleriModel;
use App\Models\UlasanModel;
use App\Models\LokasiModel;
use App\Models\LayananModel;

class Home extends BaseController
{
    public function index()
    {
        $galeriModel = new GaleriModel();
        $propertiModel = new PropertiModel();
        $ulasanModel = new UlasanModel();
        $profilModel = new ProfilPerusahaanModel();
        $layananModel = new LayananModel();

        $data = [
            'title' => 'Cara Mudah Menemukan Rumah Impian Anda',
            'galeri' => $galeriModel->orderBy('urutan', 'ASC')->findAll(),
            'properti' => $propertiModel->orderBy('created_at', 'DESC')->findAll(4),
            'ulasan' => $ulasanModel->where('status', 'approved')->orderBy('id', 'DESC')->findAll(),
            'perusahaan' => $profilModel->first(),
            'layanan' => $layananModel->findAll(4),
        ];

        return view('front/home', $data);
    }

    public function properti()
    {
        $propertiModel = new PropertiModel();

        $data = [
            'title' => 'Properti Populer',
            'properti' => $propertiModel->orderBy('created_at', 'DESC')->findAll()
        ];

        return view('front/properti', $data);
    }

    public function propertySingle($id = null)
    {
        $propertiModel = new PropertiModel();

        $properti = $propertiModel->find($id);

        if (empty($properti)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data properti tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Properti: ' . $properti['nama_properti'],
            'properti' => $properti
        ];

        return view('front/property_single', $data);
    }

    public function about()
    {
        $profilModel = new ProfilPerusahaanModel();
        $anggotaModel = new AnggotaTimModel();

        $data = [
            'profil' => $profilModel->first(),
            'anggota' => $anggotaModel->findAll()
        ];

        return view('front/about', $data);
    }
    public function contact()
    {
        $profilModel = new ProfilPerusahaanModel();
        $lokasiModel = new LokasiModel();

        $data = [
            'title' => 'Hubungi Kami',
            'profil' => $profilModel->first(),
            'lokasi' => $lokasiModel->findAll(),
        ];

        return view('front/contact', $data);
    }

    public function kirim()
    {
        $rules = [
            'nama_pengirim' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Nama lengkap harus diisi.'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|max_length[150]',
                'errors' => [
                    'required' => 'Alamat email harus diisi.',
                    'valid_email' => 'Silakan masukkan alamat email yang valid.'
                ]
            ],
            'subjek' => [
                'rules' => 'required|max_length[150]',
                'errors' => [
                    'required' => 'Subjek pesan harus diisi.'
                ]
            ],
            'pesan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi pesan tidak boleh kosong.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $pesanModel = new PesanMasukModel();

        $pesanModel->save([
            'nama_pengirim' => $this->request->getPost('nama_pengirim'),
            'email' => $this->request->getPost('email'),
            'subjek' => $this->request->getPost('subjek'),
            'pesan' => $this->request->getPost('pesan')
        ]);
        return redirect()->back()->with('success', 'Pesan Anda berhasil terkirim! Kami akan segera menghubungi Anda melalui email.');
    }
    public function services()
    {
        $layananModel = new \App\Models\LayananModel();
        $ulasanModel = new \App\Models\UlasanModel();

        $data = [
            'layanan' => $layananModel->findAll(),
            'ulasan' => $ulasanModel->where('status', 'approved')->orderBy('id', 'DESC')->findAll(),
        ];

        return view('front/services', $data);
    }
}
