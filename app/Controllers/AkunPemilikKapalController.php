<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PemilikKapalModel;

class AkunPemilikKapalController extends BaseController
{
    protected $pemilikModel;

    public function __construct()
    {
        $this->pemilikModel = new PemilikKapalModel();
    }

    public function index()
    {
        $perPage = 5;
        $currentPage = $this->request->getVar('page') ?? 1;

        $data['pemiliks'] = $this->pemilikModel->paginate($perPage);
        $data['pager'] = $this->pemilikModel->pager;
        $data['currentPage'] = $currentPage;
        $data['perPage'] = $perPage;

        return view('admin/kelola_akun/akun_pemilik_kapal', $data);
    }

    public function form_tambah()
    {
        return view('admin/kelola_akun/tambah_pemilik_kapal');
    }

    public function tambah_akun()
    {
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'no_hp' => $this->request->getPost('no_hp') ?? null,
        ];

        $this->pemilikModel->insert($data);
        return redirect()->to('/akun_pemilik_kapal/index');
    }

    public function form_edit($id)
    {
        $data['pemilik'] = $this->pemilikModel->find($id);
        if (!$data['pemilik']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Pemilik tidak ditemukan');
        }
        return view('admin/kelola_akun/edit_pemilik_kapal', $data);
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

        $this->pemilikModel->update($id, $data);
        return redirect()->to('/akun_pemilik_kapal/index');
    }

    public function hapus_akun($id)
    {
        $this->pemilikModel->delete($id);
        return redirect()->to('/akun_pemilik_kapal/index');
    }
}
