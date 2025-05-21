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

        // Load model
        $adminModel = new AdminModel();
        $pemilikModel = new PemilikKapalModel();
        $pemesanModel = new PemesanModel();

        // Check in admin
        $admin = $adminModel->where('username', $username)->first();
        if ($admin && password_verify($password, $admin['password'])) {
            session()->set('user', $admin);
            session()->set('role', 'admin');
            return redirect()->to('/admin/index');
        }

        // Check in pemilik kapal
        $pemilik = $pemilikModel->where('username', $username)->first();
        if ($pemilik && password_verify($password, $pemilik['password'])) {
            session()->set('user', $pemilik);
            session()->set('role', 'pemilik_kapal');
            return redirect()->to('/pemilik_kapal/index');
        }

        // Check in pemesan
        $pemesan = $pemesanModel->where('username', $username)->first();
        if ($pemesan && password_verify($password, $pemesan['password'])) {
            session()->set('user', $pemesan);
            session()->set('role', 'pemesan');
            return redirect()->to('/pemesan/index');
        }

        // If none matched
        return redirect()->back()->with('error', 'username atau Password salah!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
