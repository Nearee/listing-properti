<?php

namespace App\Controllers;

use App\Models\LayananModel;
use CodeIgniter\RESTful\ResourceController;

class LayananController extends BaseController
{
    protected $layananModel;

    public function __construct()
    {
        $this->layananModel = new LayananModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Layanan',
            'layanan' => $this->layananModel->findAll()
        ];

        return view('back/admin/layanan', $data);
    }

    public function store()
    {
        $rules = [
            'judul' => 'required',
            'deskripsi' => 'required',
            'icon_class' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->layananModel->save([
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'icon_class' => $this->request->getPost('icon_class'),
            'link_url' => $this->request->getPost('link_url'),
            'halaman' => $this->request->getPost('halaman')
        ]);

        return redirect()->to('admin/layanan')->with('success', 'Data layanan berhasil ditambahkan.');
    }

    public function update($id)
    {
        $rules = [
            'judul' => 'required',
            'deskripsi' => 'required',
            'icon_class' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->layananModel->save([
            'id' => $id,
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'icon_class' => $this->request->getPost('icon_class'),
            'link_url' => $this->request->getPost('link_url'),
            'halaman' => $this->request->getPost('halaman')
        ]);

        return redirect()->to('admin/layanan')->with('success', 'Data layanan berhasil diubah.');
    }

    public function delete($id)
    {
        $this->layananModel->delete($id);

        return redirect()->to('admin/layanan')->with('success', 'Data layanan berhasil dihapus.');
    }
}
