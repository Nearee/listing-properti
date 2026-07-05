<?php

namespace App\Controllers;

use App\Models\GaleriModel;

class Galeri extends BaseController
{
    protected $galeriModel;

    public function __construct()
    {
        $this->galeriModel = new GaleriModel();
    }

    // Menampilkan halaman galeri
    public function index()
    {
        $data = [
            'title' => 'Manajemen Galeri',
            'galeri' => $this->galeriModel->orderBy('id', 'DESC')->findAll()
        ];

        return view('back/admin/galeri', $data);
    }

    public function store()
    {
        $rules = [
            'gambar' => 'uploaded[gambar]|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $fileGambar = $this->request->getFile('gambar');

        if ($fileGambar->isValid() && !$fileGambar->hasMoved()) {
            $namaGambar = $fileGambar->getRandomName();

            $fileGambar->move(FCPATH . 'uploads/galeri', $namaGambar);

            $urutan = $this->request->getPost('urutan') ?? 0;

            $this->galeriModel->save([
                'gambar_url' => 'uploads/galeri/' . $namaGambar,
                'urutan' => $urutan
            ]);

            return redirect()->to('/admin/galeri')->with('success', 'Gambar berhasil diupload.');
        }

        return redirect()->back()->with('errors', ['Gagal mengupload gambar.']);
    }

    public function delete($id = null)
    {
        $galeri = $this->galeriModel->find($id);

        if (empty($galeri)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Gambar tidak ditemukan');
        }

        $pathFile = FCPATH . $galeri['gambar_url'];
        if (file_exists($pathFile) && is_file($pathFile)) {
            unlink($pathFile);
        }
        $this->galeriModel->delete($id);

        return redirect()->to('/admin/galeri')->with('success', 'Gambar berhasil dihapus.');
    }
}
