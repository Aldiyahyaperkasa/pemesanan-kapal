<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class AkunAdminController extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function index()
    {
        $perPage = 5;
        $currentPage = $this->request->getVar('page') ?? 1;

        $data['admins'] = $this->adminModel->paginate($perPage);
        $data['pager'] = $this->adminModel->pager;
        $data['currentPage'] = $currentPage;
        $data['perPage'] = $perPage;

        return view('admin/kelola_akun/akun_admin', $data);
    }

    public function form_tambah()
    {
        return view('admin/kelola_akun/tambah_admin');
    }

    public function tambah_akun()
    {
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),  // sesuaikan dengan kolom di tabel
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'no_hp' => $this->request->getPost('no_hp') ?? null,
        ];

        $this->adminModel->insert($data);
        return redirect()->to('/akun_admin/index');
    }

    public function form_edit($id)
    {
        $data['admin'] = $this->adminModel->find($id);
        if (!$data['admin']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Admin tidak ditemukan');
        }
        return view('admin/kelola_akun/edit_admin', $data);
    }

    public function edit_akun($id)
    {
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'no_hp' => $this->request->getPost('no_hp') ?? null,
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->adminModel->update($id, $data);
        return redirect()->to('/akun_admin/index');
    }

    public function hapus_akun($id)
    {
        $this->adminModel->delete($id);
        return redirect()->to('/akun_admin/index');
    }
}
