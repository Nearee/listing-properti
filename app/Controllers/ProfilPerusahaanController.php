<?php

namespace App\Controllers;

use App\Models\ProfilPerusahaanModel;

class ProfilPerusahaanController extends BaseController
{
    protected $profilModel;

    public function __construct()
    {
        $this->profilModel = new ProfilPerusahaanModel();
    }

    public function index()
    {
        $profil = $this->profilModel->first();

        $data = [
            'title' => 'Kelola Profil Perusahaan',
            'profil' => $profil
        ];

        return view('back/admin/kelola_profilperusahaan', $data);
    }

    public function save()
    {
        $rules = [
            'deskripsi_tentang' => 'required',
            'teks_visi' => 'required',
            'teks_misi' => 'required',
            'alamat_kantor' => 'required',
            'jam_operasional' => 'required',
            'email_kantor' => 'required|valid_email',
            'telepon_kantor' => 'required|max_length[50]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $profil = $this->profilModel->first();

        $dataSave = [
            'deskripsi_tentang' => $this->request->getPost('deskripsi_tentang'),
            'teks_visi' => $this->request->getPost('teks_visi'),
            'teks_misi' => $this->request->getPost('teks_misi'),
            'alamat_kantor' => $this->request->getPost('alamat_kantor'),
            'jam_operasional' => $this->request->getPost('jam_operasional'),
            'email_kantor' => $this->request->getPost('email_kantor'),
            'telepon_kantor' => $this->request->getPost('telepon_kantor')
        ];

        if ($profil) {
            $this->profilModel->update($profil->id, $dataSave);
            $message = 'Profil perusahaan berhasil diperbarui.';
        } else {
            $this->profilModel->insert($dataSave);
            $message = 'Profil perusahaan baru berhasil dibuat.';
        }

        return redirect()->to('/profilperusahaan')->with('success', $message);
    }
}