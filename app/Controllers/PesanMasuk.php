<?php

namespace App\Controllers;

use App\Models\PesanMasukModel;

class PesanMasuk extends BaseController
{
    protected $pesanModel;

    public function __construct()
    {
        $this->pesanModel = new PesanMasukModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pesan Masuk',
            // Menampilkan pesan dari yang terbaru
            'pesan' => $this->pesanModel->orderBy('created_at', 'DESC')->findAll()
        ];

        return view('back/admin/pesan_masuk', $data);
    }

    public function delete($id = null)
    {
        $pesan = $this->pesanModel->find($id);

        if (empty($pesan)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pesan tidak ditemukan');
        }

        $this->pesanModel->delete($id);

        return redirect()->to('/admin/pesan')->with('success', 'Pesan berhasil dihapus.');
    }
}
