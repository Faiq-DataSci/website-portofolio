<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        $session = session();

        // If already logged in as admin, redirect to admin dashboard
        if ($session->get('isLoggedIn') && $session->get('role') === 'admin') {
            return redirect()->to(base_url('admin/dashboard'));
        }

        $data = [
            'title' => 'Admin Login | Faiq Data Science Portofolio'
        ];

        return view('admin/login', $data);
    }

    public function processLogin()
    {
        $session = session();
        $username = trim($this->request->getPost('username') ?? '');
        $password = trim($this->request->getPost('password') ?? '');

        if (empty($username) || empty($password)) {
            return redirect()->back()->withInput()->with('error', 'Username/Email dan Password wajib diisi.');
        }

        // Try checking Database first
        $userModel = new UserModel();
        $user = $userModel->getUserByUsernameOrEmail($username);

        $authenticated = false;
        $adminData = [];

        if ($user) {
            // Verify DB password
            if (password_verify($password, $user['password']) || $password === $user['password']) {
                if ($user['role'] === 'admin') {
                    $authenticated = true;
                    $adminData = [
                        'user_id'    => $user['id'],
                        'username'   => $user['username'],
                        'name'       => $user['name'] ?? $user['username'],
                        'role'       => 'admin',
                        'isLoggedIn' => true,
                    ];
                } else {
                    return redirect()->back()->withInput()->with('error', 'Akses ditolak! Akun Anda bukan akun admin.');
                }
            }
        }

        // Fallback admin credentials if DB user table doesn't have an admin user yet
        if (!$authenticated) {
            if (($username === 'admin' || $username === 'faiq@datascience.com') && $password === 'admin123') {
                $authenticated = true;
                $adminData = [
                    'user_id'    => 1,
                    'username'   => 'admin',
                    'name'       => 'Faiq',
                    'role'       => 'admin',
                    'isLoggedIn' => true,
                ];
            }
        }

        if ($authenticated) {
            $session->set($adminData);
            return redirect()->to(base_url('admin/dashboard'))->with('success', 'Selamat datang kembali, ' . $adminData['name'] . '!');
        }

        return redirect()->back()->withInput()->with('error', 'Username/Email atau Password salah.');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('login'))->with('success', 'Anda telah berhasil logout.');
    }
}
