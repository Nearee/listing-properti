<?php

namespace App\Controllers;

use App\Models\UlasanModel;

class UlasanController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Beri Ulasan - Perumahan Kami'
        ];

        return view('front/form_ulasan', $data);
    }

    public function store()
    {
        $rules = [
            'nama_klien' => 'required|max_length[100]',
            'komentar' => 'required',
            'rating' => 'required|in_list[1,2,3,4,5]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $ulasanModel = new UlasanModel();

        $ulasanModel->save([
            'nama_klien' => $this->request->getPost('nama_klien'),
            'profesi' => null,
            'komentar' => $this->request->getPost('komentar'),
            'rating' => $this->request->getPost('rating'),
            'avatar_url' => null,
            'status' => 'pending'
        ]);

        return redirect()->to('/beri-ulasan')->with('success', 'Terima kasih! Ulasan Anda berhasil dikirim dan akan ditinjau oleh Admin.');
    }
}
