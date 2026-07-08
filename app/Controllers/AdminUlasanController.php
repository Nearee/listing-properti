<?php

namespace App\Controllers;

use App\Models\UlasanModel;

class AdminUlasanController extends BaseController
{
    protected $ulasanModel;

    public function __construct()
    {
        $this->ulasanModel = new UlasanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Ulasan Pengguna',
            'ulasan' => $this->ulasanModel->orderBy('id', 'DESC')->findAll()
        ];

        return view('back/admin/kelola_ulasan', $data);
    }

    public function approve($id = null)
    {
        $ulasan = $this->ulasanModel->find($id);

        if (empty($ulasan)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Ulasan tidak ditemukan');
        }

        $this->ulasanModel->update($id, ['status' => 'approved']);

        return redirect()->to('/admin/ulasan')->with('success', 'Ulasan berhasil disetujui dan akan tampil di Landing Page.');
    }

    public function delete($id = null)
    {
        $ulasan = $this->ulasanModel->find($id);

        if (empty($ulasan)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Ulasan tidak ditemukan');
        }

        $this->ulasanModel->delete($id);

        return redirect()->to('/admin/ulasan')->with('success', 'Ulasan berhasil dihapus.');
    }
}
