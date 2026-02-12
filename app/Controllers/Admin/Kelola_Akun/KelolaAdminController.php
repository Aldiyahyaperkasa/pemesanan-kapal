<?php

namespace App\Controllers\Admin\Kelola_Akun;

use App\Controllers\BaseController;

class KelolaAdminController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data['admin'] = $this->db->table('admin')->get()->getResultArray();
        return view('admin/kelola_akun/admin/index', $data);
    }

    public function create()
    {
        return view('admin/kelola_akun/admin/create');
    }

    public function store()
    {
        $this->db->table('admin')->insert([
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp'),
        ]);

        return redirect()->to('/admin/kelola-akun/admin');
    }

    public function edit($id)
    {
        $data['admin'] = $this->db->table('admin')
            ->where('id_admin', $id)
            ->get()
            ->getRowArray();

        return view('admin/kelola_akun/admin/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp'),
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->db->table('admin')->where('id_admin', $id)->update($data);

        return redirect()->to('/admin/kelola-akun/admin');
    }

    public function delete($id)
    {
        $this->db->table('admin')->where('id_admin', $id)->delete();
        return redirect()->to('/admin/kelola-akun/admin');
    }
}
