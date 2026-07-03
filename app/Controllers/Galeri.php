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
            'title'  => 'Manajemen Galeri',
            // Menampilkan data diurutkan berdasarkan kolom 'urutan' atau 'id' terbaru
            'galeri' => $this->galeriModel->orderBy('id', 'DESC')->findAll()
        ];

        return view('back/admin/galeri', $data);
    }

    // Menyimpan dan Upload Gambar
    public function store()
    {
        // Validasi file upload (maksimal 2MB, format jpg/jpeg/png)
        $rules = [
            'gambar' => 'uploaded[gambar]|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        // Ambil file gambar
        $fileGambar = $this->request->getFile('gambar');

        if ($fileGambar->isValid() && !$fileGambar->hasMoved()) {
            // Generate nama file random agar tidak bentrok
            $namaGambar = $fileGambar->getRandomName();

            // Pindahkan file ke folder public/uploads/galeri
            $fileGambar->move(FCPATH . 'uploads/galeri', $namaGambar);

            // Tentukan urutan (opsional, set otomatis = 0 atau hitung total data + 1)
            $urutan = $this->request->getPost('urutan') ?? 0;

            // Simpan path gambar ke database
            $this->galeriModel->save([
                'gambar_url' => 'uploads/galeri/' . $namaGambar,
                'urutan'     => $urutan
            ]);

            return redirect()->to('/admin/galeri')->with('success', 'Gambar berhasil diupload.');
        }

        return redirect()->back()->with('errors', ['Gagal mengupload gambar.']);
    }

    // Menghapus gambar (File fisik dan Database)
    public function delete($id = null)
    {
        $galeri = $this->galeriModel->find($id);

        if (empty($galeri)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Gambar tidak ditemukan');
        }

        // Hapus file fisik di folder public/uploads/galeri
        $pathFile = FCPATH . $galeri['gambar_url'];
        if (file_exists($pathFile) && is_file($pathFile)) {
            unlink($pathFile);
        }

        // Hapus data dari database
        $this->galeriModel->delete($id);

        return redirect()->to('/admin/galeri')->with('success', 'Gambar berhasil dihapus.');
    }
}
