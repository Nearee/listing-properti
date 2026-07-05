<?php

namespace App\Controllers;

use App\Models\LokasiModel;

class Lokasi extends BaseController
{
    protected $lokasiModel;

    public function __construct()
    {
        $this->lokasiModel = new LokasiModel();
    }

    // 1. Tampilkan semua data (READ)
    public function index()
    {
        $data = [
            'title' => 'Daftar Lokasi',
            'lokasi' => $this->lokasiModel->findAll()
        ];

        // dd($data);

        return view('back/admin/lokasi', $data);
    }

    // 2. Karena pakai modal, create() tidak perlu view terpisah, langsung redirect ke index
    public function create()
    {
        return redirect()->to('/lokasi');
    }

    // 3. Simpan data baru (CREATE - Proses Simpan)
    public function store()
    {
        $rules = [
            'nama_lokasi' => 'required|min_length[3]|max_length[100]',
            'alamat_lengkap' => 'required',
            'link_gmaps' => 'required'
        ];

        // JIKA VALIDASI GAGAL: Jangan pakai redirect()->back(). 
        // Render langsung view index beserta data lokasi dan errors-nya agar tidak undefined.
        if (!$this->validate($rules)) {
            $data = [
                'title' => 'Daftar Lokasi',
                'lokasi' => $this->lokasiModel->findAll(),
                'errors' => $this->validator->getErrors()
            ];
            // Mengirim flashdata manual agar input lama (old) tetap bisa terbaca
            session()->setFlashdata('errors', $this->validator->getErrors());
            return view('back/admin/lokasi', $data);
        }

        // Jika validasi berhasil
        $this->lokasiModel->save([
            'nama_lokasi' => $this->request->getPost('nama_lokasi'),
            'alamat_lengkap' => $this->request->getPost('alamat_lengkap'),
            'link_gmaps' => $this->request->getPost('link_gmaps')
        ]);

        return redirect()->to('/lokasi')->with('success', 'Data lokasi berhasil ditambahkan.');
    }

    // 4. Karena pakai modal, edit() langsung dilempar kembali ke index
    public function edit($id = null)
    {
        return redirect()->to('/lokasi');
    }

    // 5. Simpan perubahan data (UPDATE - Proses Update)
    public function update($id = null)
    {
        $rules = [
            'nama_lokasi' => 'required|min_length[3]|max_length[100]',
            'alamat_lengkap' => 'required',
            'link_gmaps' => 'required'
        ];

        // JIKA VALIDASI GAGAL: Render langsung view index dengan melemparkan ulang data lokasi
        if (!$this->validate($rules)) {
            $data = [
                'title' => 'Daftar Lokasi',
                'lokasi' => $this->lokasiModel->findAll(),
                'errors' => $this->validator->getErrors()
            ];
            session()->setFlashdata('errors', $this->validator->getErrors());
            return view('back/admin/lokasi', $data);
        }

        // Update data berdasarkan ID
        $this->lokasiModel->update($id, [
            'nama_lokasi' => $this->request->getPost('nama_lokasi'),
            'alamat_lengkap' => $this->request->getPost('alamat_lengkap'),
            'link_gmaps' => $this->request->getPost('link_gmaps')
        ]);

        return redirect()->to('/lokasi')->with('success', 'Data lokasi berhasil diperbarui.');
    }

    // 6. Hapus data (DELETE)
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
