<?php

namespace App\Controllers\Admin\Kelola_Akun;

use App\Controllers\BaseController;

class KelolaPemilikKapalController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data['pemilik'] = $this->db->table('pemilik_kapal')->get()->getResultArray();
        return view('admin/kelola_akun/pemilik_kapal/index', $data);
    }

    public function create()
    {
        return view('admin/kelola_akun/pemilik_kapal/create');
    }

    public function store()
    {
        $this->db->table('pemilik_kapal')->insert([
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'no_hp' => $this->request->getPost('no_hp'),
            'email' => $this->request->getPost('email'),
        ]);

        return redirect()->to('/admin/kelola-akun/pemilik-kapal');
    }

    public function edit($id)
    {
        $data['pemilik'] = $this->db->table('pemilik_kapal')
            ->where('id_pemilik', $id)
            ->get()
            ->getRowArray();

        return view('admin/kelola_akun/pemilik_kapal/edit', $data);
    }

    public function update($id)
    {
        $this->db->table('pemilik_kapal')
            ->where('id_pemilik', $id)
            ->update([
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'no_hp' => $this->request->getPost('no_hp'),
                'email' => $this->request->getPost('email'),
            ]);

        return redirect()->to('/admin/kelola-akun/pemilik-kapal');
    }

    public function delete($id)
    {
        $this->db->table('pemilik_kapal')->where('id_pemilik', $id)->delete();
        return redirect()->to('/admin/kelola-akun/pemilik-kapal');
    }
}
