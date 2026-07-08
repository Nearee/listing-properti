<?php

namespace App\Controllers;

use App\Models\LokasiModel;

class LokasiController extends BaseController
{
    protected $lokasiModel;

    public function __construct()
    {
        $this->lokasiModel = new LokasiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Lokasi',
            'lokasi' => $this->lokasiModel->findAll()
        ];

        return view('back/admin/kelola_lokasi', $data);
    }
    public function create()
    {
        return redirect()->to('/lokasi');
    }
    public function store()
    {
        $rules = [
            'nama_lokasi' => 'required|min_length[3]|max_length[100]',
            'alamat_lengkap' => 'required',
            'link_gmaps' => 'required'
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title' => 'Daftar Lokasi',
                'lokasi' => $this->lokasiModel->findAll(),
                'errors' => $this->validator->getErrors()
            ];
            session()->setFlashdata('errors', $this->validator->getErrors());
            return view('back/admin/kelola_lokasi', $data);
        }
        $this->lokasiModel->save([
            'nama_lokasi' => $this->request->getPost('nama_lokasi'),
            'alamat_lengkap' => $this->request->getPost('alamat_lengkap'),
            'link_gmaps' => $this->request->getPost('link_gmaps')
        ]);

        return redirect()->to('/lokasi')->with('success', 'Data lokasi berhasil ditambahkan.');
    }

    public function edit($id = null)
    {
        return redirect()->to('/lokasi');
    }

    public function update($id = null)
    {
        $rules = [
            'nama_lokasi' => 'required|min_length[3]|max_length[100]',
            'alamat_lengkap' => 'required',
            'link_gmaps' => 'required'
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title' => 'Daftar Lokasi',
                'lokasi' => $this->lokasiModel->findAll(),
                'errors' => $this->validator->getErrors()
            ];
            session()->setFlashdata('errors', $this->validator->getErrors());
            return view('back/admin/kelola_lokasi', $data);
        }

        $this->lokasiModel->update($id, [
            'nama_lokasi' => $this->request->getPost('nama_lokasi'),
            'alamat_lengkap' => $this->request->getPost('alamat_lengkap'),
            'link_gmaps' => $this->request->getPost('link_gmaps')
        ]);

        return redirect()->to('/lokasi')->with('success', 'Data lokasi berhasil diperbarui.');
    }

    public function delete($id = null)
    {
        $lokasi = $this->lokasiModel->find($id);

        if (empty($lokasi)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data lokasi tidak ditemukan');
        }

        $this->lokasiModel->delete($id);

        return redirect()->to('/lokasi')->with('success', 'Data lokasi berhasil dihapus.');
    }
}
