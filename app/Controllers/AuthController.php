<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends BaseController
{
    // public function register()
    // {
    //     // Mengembalikan file view: app/Views/auth/register.php
    //     return view('auth/register');
    // }

    // public function processRegister()
    // {
    //     $rules = [
    //         'username' => 'required|min_length[4]|is_unique[user.username]',
    //         'password' => 'required|min_length[8]',
    //         'password_confirm' => [
    //             'rules'  => 'required|matches[password]',
    //             'errors' => ['matches' => 'Konfirmasi password tidak cocok dengan password.']
    //         ]
    //     ];

    //     if (!$this->validate($rules)) {
    //         return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    //     }

    //     // Ambil input secara manual agar 'password_confirm' otomatis terabaikan
    //     $username = $this->request->getPost('username');
    //     $password = $this->request->getPost('password');

    //     $data = [
    //         'username' => $username,
    //         'password' => password_hash($password, PASSWORD_DEFAULT),
    //         'role'     => 'member'
    //     ];

    //     $userModel = new UserModel();
    //     $userModel->insert($data);

    //     session()->setFlashdata('success', 'Registrasi berhasil. Silakan login.');
    //     return redirect()->to('/auth/login');
    // }
    // Menampilkan halaman form login
    public function login()
    {
        return view('auth/login');
    }

    public function processLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if (empty($username) || empty($password)) {
            return redirect()->back()->withInput()->with('error', 'Username dan password wajib diisi.');
        }

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        // Validasi ketersediaan user dan kecocokan password
        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Username atau password salah.');
        }

        // Simpan data ke dalam Session
        $sessionData = [
            'isLoggedIn' => true,
            'user_id'    => $user['id'],
            'username'   => $user['username'],
            'role'       => $user['role']
        ];
        session()->set($sessionData);

        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        session()->destroy();

        session()->setFlashdata('success', 'Anda berhasil logout.');
        return redirect()->to('/login');
    }
}
