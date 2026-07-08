<?php

namespace App\Controllers;

use App\Models\PropertiModel;
use App\Models\BlokModel;

class PropertiController extends BaseController
{
    protected $propertiModel;
    protected $blokModel;

    public function __construct()
    {
        $this->propertiModel = new PropertiModel();
        $this->blokModel = new BlokModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Properti',
            'properti' => $this->propertiModel->select('properti.*, blok.nama_blok')
                ->join('blok', 'blok.id = properti.blok_id')
                ->orderBy('properti.id', 'DESC')
                ->findAll(),
            'blok' => $this->blokModel->findAll()
        ];

        return view('back/admin/kelola_properti', $data);
    }

    public function store()
    {
        $rules = [
            'blok_id' => 'required|is_natural_no_zero',
            'nama_properti' => 'required|max_length[150]',
            'deskripsi' => 'permit_empty',
            'nomor_rumah' => 'required|max_length[20]',
            'harga' => 'required|numeric',
            'kamar_tidur' => 'required|is_natural',
            'kamar_mandi' => 'required|is_natural',
            'kategori_tampil' => 'required|in_list[populer,unggulan,tidak_ada]',
            'gambar_url' => 'uploaded[gambar_url]|max_size[gambar_url,2048]|is_image[gambar_url]|mime_in[gambar_url,image/jpg,image/jpeg,image/png]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fileGambar = $this->request->getFile('gambar_url');
        $namaGambar = $fileGambar->getRandomName();
        $fileGambar->move(FCPATH . 'uploads/properti', $namaGambar);

        $this->propertiModel->save([
            'blok_id' => $this->request->getPost('blok_id'),
            'nama_properti' => $this->request->getPost('nama_properti'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'nomor_rumah' => $this->request->getPost('nomor_rumah'),
            'harga' => $this->request->getPost('harga'),
            'kamar_tidur' => $this->request->getPost('kamar_tidur'),
            'kamar_mandi' => $this->request->getPost('kamar_mandi'),
            'gambar_url' => 'uploads/properti/' . $namaGambar,
            'kategori_tampil' => $this->request->getPost('kategori_tampil')
        ]);

        return redirect()->to('/properti')->with('success', 'Data properti berhasil ditambahkan.');
    }

    public function update($id = null)
    {
        $rules = [
            'blok_id' => 'required|is_natural_no_zero',
            'nama_properti' => 'required|max_length[150]',
            'deskripsi' => 'permit_empty',
            'nomor_rumah' => 'required|max_length[20]',
            'harga' => 'required|numeric',
            'kamar_tidur' => 'required|is_natural',
            'kamar_mandi' => 'required|is_natural',
            'kategori_tampil' => 'required|in_list[populer,unggulan,tidak_ada]',
            'gambar_url' => 'max_size[gambar_url,2048]|is_image[gambar_url]|mime_in[gambar_url,image/jpg,image/jpeg,image/png]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $propertiLama = $this->propertiModel->find($id);
        $fileGambar = $this->request->getFile('gambar_url');

        if ($fileGambar->getError() == 4) {
            $namaPath = $propertiLama['gambar_url'];
        } else {
            $namaFileUnik = $fileGambar->getRandomName();
            $fileGambar->move(FCPATH . 'uploads/properti', $namaFileUnik);
            $namaPath = 'uploads/properti/' . $namaFileUnik;

            if (file_exists(FCPATH . $propertiLama['gambar_url']) && $propertiLama['gambar_url'] != '') {
                unlink(FCPATH . $propertiLama['gambar_url']);
            }
        }

        $this->propertiModel->update($id, [
            'blok_id' => $this->request->getPost('blok_id'),
            'nama_properti' => $this->request->getPost('nama_properti'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'nomor_rumah' => $this->request->getPost('nomor_rumah'),
            'harga' => $this->request->getPost('harga'),
            'kamar_tidur' => $this->request->getPost('kamar_tidur'),
            'kamar_mandi' => $this->request->getPost('kamar_mandi'),
            'gambar_url' => $namaPath,
            'kategori_tampil' => $this->request->getPost('kategori_tampil')
        ]);

        return redirect()->to('/properti')->with('success', 'Data properti berhasil diperbarui.');
    }

    public function delete($id = null)
    {
        $properti = $this->propertiModel->find($id);

        if (empty($properti)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data properti tidak ditemukan');
        }

        if (file_exists(FCPATH . $properti['gambar_url']) && $properti['gambar_url'] != '') {
            unlink(FCPATH . $properti['gambar_url']);
        }

        $this->propertiModel->delete($id);

        return redirect()->to('/properti')->with('success', 'Data properti berhasil dihapus.');
    }
}
