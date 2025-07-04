<?php
namespace App\Controllers;

use App\Models\PemesanModel;
use App\Models\AdminModel;
use App\Models\PemilikKapalModel;

class LoginController extends BaseController
{
    public function index()
    {
        return view('home/login');
    }

    public function submit()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $adminModel = new AdminModel();
        $pemilikModel = new PemilikKapalModel();
        $pemesanModel = new PemesanModel();

        // Cek login admin
        $admin = $adminModel->where('username', $username)->first();
        if ($admin && password_verify($password, $admin['password'])) {
            session()->set([
                'admin_id' => $admin['id_admin'],
                'admin_username' => $admin['username'],
                'admin_logged_in' => true,
                'role' => 'admin'
            ]);
            return redirect()->to('/admin/index');
        }

        // $admin = $adminModel->where('username', $username)->first();
        // if ($admin && password_verify($password, $admin['password'])) {
        //     session()->set('user', $admin);
        //     session()->set('role', 'admin');
        //     return redirect()->to('/admin/index');
        // }

        // Cek login pemilik kapal
        $pemilik = $pemilikModel->where('username', $username)->first();
        if ($pemilik && password_verify($password, $pemilik['password'])) {
            session()->set([
                'pemilik_id' => $pemilik['id_pemilik'],
                'pemilik_username' => $pemilik['username'],
                'pemilik_logged_in' => true,
                'role' => 'pemilik_kapal'
            ]);
            return redirect()->to('/pemilik_kapal/index');
        }

        // Cek login pemesan
        $pemesan = $pemesanModel->where('username', $username)->first();
        if ($pemesan && password_verify($password, $pemesan['password'])) {
            session()->set([
                'pemesan_id' => $pemesan['id_pemesan'],
                'pemesan_username' => $pemesan['username'],
                'pemesan_logged_in' => true,
                'role' => 'pemesan'
            ]);
            return redirect()->to('/pemesan/index');
        }

        // Jika login gagal semua
        return redirect()->back()->with('error', 'Username atau password salah!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
