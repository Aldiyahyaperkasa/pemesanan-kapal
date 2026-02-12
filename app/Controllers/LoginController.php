<?php

namespace App\Controllers;

use App\Models\AdminModel;

class LoginController extends BaseController
{
    public function index()
    {
        return view('login'); // karena sekarang langsung di views/login.php
    }

    public function submit()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $adminModel = new AdminModel();

        $admin = $adminModel->where('username', $username)->first();

        if ($admin && password_verify($password, $admin['password'])) {

            session()->set([
                'admin_id' => $admin['id_admin'],
                'admin_username' => $admin['username'],
                'admin_logged_in' => true
            ]);

            return redirect()->to('/admin/dashboard');
        }

        return redirect()->back()->with('error', 'Username atau password salah!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
