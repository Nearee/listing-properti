<?php

namespace App\Controllers;

use App\Models\AnggotaTimModel;

class AnggotaTim extends BaseController
{
    protected $anggotaTimModel;

    public function __construct()
    {
        $this->anggotaTimModel = new AnggotaTimModel();
    }

    // Tampilkan Data (READ)
    public function index()
    {
        $data = [
            'title'   => 'Data Anggota Tim',
            'anggota' => $this->anggotaTimModel->findAll()
        ];

        // Memanggil view sesuai path template Mazer Anda
        return view('back/admin/anggota-tim', $data);
    }

    // Proses Simpan Data Baru (CREATE)
    public function store()
    {
        $rules = [
            'nama'           => 'required|max_length[100]',
            'jabatan'        => 'required|max_length[100]',
            'deskripsi'      => 'required',
            'foto_url'       => 'required|max_length[255]',
            'link_twitter'   => 'permit_empty|valid_url',
            'link_facebook'  => 'permit_empty|valid_url',
            'link_linkedin'  => 'permit_empty|valid_url',
            'link_instagram' => 'permit_empty|valid_url'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->anggotaTimModel->save([
            'nama'           => $this->request->getPost('nama'),
            'jabatan'        => $this->request->getPost('jabatan'),
            'deskripsi'      => $this->request->getPost('deskripsi'),
            'foto_url'       => $this->request->getPost('foto_url'),
            'link_twitter'   => $this->request->getPost('link_twitter'),
            'link_facebook'  => $this->request->getPost('link_facebook'),
            'link_linkedin'  => $this->request->getPost('link_linkedin'),
            'link_instagram' => $this->request->getPost('link_instagram')
        ]);

        return redirect()->to('/anggota-tim')->with('success', 'Data anggota tim berhasil ditambahkan.');
    }

    // Proses Perbarui Data (UPDATE)
    public function update($id = null)
    {
        $rules = [
            'nama'           => 'required|max_length[100]',
            'jabatan'        => 'required|max_length[100]',
            'deskripsi'      => 'required',
            'foto_url'       => 'required|max_length[255]',
            'link_twitter'   => 'permit_empty|valid_url',
            'link_facebook'  => 'permit_empty|valid_url',
            'link_linkedin'  => 'permit_empty|valid_url',
            'link_instagram' => 'permit_empty|valid_url'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->anggotaTimModel->update($id, [
            'nama'           => $this->request->getPost('nama'),
            'jabatan'        => $this->request->getPost('jabatan'),
            'deskripsi'      => $this->request->getPost('deskripsi'),
            'foto_url'       => $this->request->getPost('foto_url'),
            'link_twitter'   => $this->request->getPost('link_twitter'),
            'link_facebook'  => $this->request->getPost('link_facebook'),
            'link_linkedin'  => $this->request->getPost('link_linkedin'),
            'link_instagram' => $this->request->getPost('link_instagram')
        ]);

        return redirect()->to('/anggota-tim')->with('success', 'Data anggota tim berhasil diperbarui.');
    }

    // Proses Hapus Data (DELETE)
    public function delete($id = null)
    {
        $anggota = $this->anggotaTimModel->find($id);

        if (empty($anggota)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data anggota tim tidak ditemukan');
        }

        $this->anggotaTimModel->delete($id);

        return redirect()->to('/anggota-tim')->with('success', 'Data anggota tim berhasil dihapus.');
    }
}
