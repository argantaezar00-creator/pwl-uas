<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session   = session();
    }

    /**
     * Halaman Login
     */
    public function index()
    {
        // Jika sudah login, redirect ke dashboard
        if ($this->session->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/login');
    }

    /**
     * Proses Login
     */
    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username' => ['required' => 'Username wajib diisi.'],
            'password' => ['required' => 'Password wajib diisi.'],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/login')
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        // Cek user di database
        $user = $this->userModel->where('username', $username)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->to('/login')
                ->withInput()
                ->with('error', 'Username atau password salah.');
        }

        // Set session
        $this->session->set([
            'user_id'    => $user['id'],
            'user_nama'  => $user['nama'],
            'username'   => $user['username'],
            'logged_in'  => true,
        ]);

        return redirect()->to('/dashboard')->with('success', 'Selamat datang, ' . $user['nama'] . '!');
    }

    /**
     * Logout
     */
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login')->with('success', 'Anda telah berhasil logout.');
    }
}
