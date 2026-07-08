<?php

namespace App\Controllers;

use App\Models\BlokModel;
use App\Models\LokasiModel;

class BlokController extends BaseController
{
    protected $blokModel;
    protected $lokasiModel;

    public function __construct()
    {
        $this->blokModel = new BlokModel();
        $this->lokasiModel = new LokasiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Blok',
            'blok' => $this->blokModel->getBlokWithLokasi(),
            'lokasi' => $this->lokasiModel->findAll()
        ];

        return view('back/admin/kelola_blok', $data);
    }

    public function store()
    {
        $rules = [
            'lokasi_id' => 'required|is_natural_no_zero',
            'nama_blok' => 'required|min_length[1]|max_length[50]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->blokModel->save([
            'lokasi_id' => $this->request->getPost('lokasi_id'),
            'nama_blok' => $this->request->getPost('nama_blok')
        ]);

        return redirect()->to('/blok')->with('success', 'Data blok berhasil ditambahkan.');
    }

    public function update($id = null)
    {
        $rules = [
            'lokasi_id' => 'required|is_natural_no_zero',
            'nama_blok' => 'required|min_length[1]|max_length[50]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->blokModel->update($id, [
            'lokasi_id' => $this->request->getPost('lokasi_id'),
            'nama_blok' => $this->request->getPost('nama_blok')
        ]);

        return redirect()->to('/blok')->with('success', 'Data blok berhasil diperbarui.');
    }

    public function delete($id = null)
    {
        $blok = $this->blokModel->find($id);

        if (empty($blok)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data blok tidak ditemukan');
        }

        $this->blokModel->delete($id);

        return redirect()->to('/blok')->with('success', 'Data blok berhasil dihapus.');
    }
}
