<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PemesanModel;

class AkunPemesanController extends BaseController
{
    protected $pemesanModel;

    public function __construct()
    {
        $this->pemesanModel = new PemesanModel();
    }

    public function index()
    {
        $perPage = 5;
        $currentPage = $this->request->getVar('page') ?? 1;

        $data['pesans'] = $this->pemesanModel->paginate($perPage);
        $data['pager'] = $this->pemesanModel->pager;
        $data['currentPage'] = $currentPage;
        $data['perPage'] = $perPage;

        return view('admin/kelola_akun/akun_pemesan', $data);
    }

    public function form_tambah()
    {
        return view('admin/kelola_akun/tambah_pemesan');
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

        $this->pemesanModel->insert($data);
        return redirect()->to('/akun_pemesan/index');
    }

    public function form_edit($id)
    {
        $data['pemesan'] = $this->pemesanModel->find($id);
        if (!$data['pemesan']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Pemesan tidak ditemukan');
        }
        return view('admin/kelola_akun/edit_pemesan', $data);
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

        $this->pemesanModel->update($id, $data);
        return redirect()->to('/akun_pemesan/index');
    }

    public function hapus_akun($id)
    {
        $this->pemesanModel->delete($id);
        return redirect()->to('/akun_pemesan/index');
    }
}
