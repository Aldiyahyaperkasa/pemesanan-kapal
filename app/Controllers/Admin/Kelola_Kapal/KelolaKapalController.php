<?php

namespace App\Controllers\Admin\Kelola_Kapal;

use App\Controllers\BaseController;
use App\Models\KapalModel;
use App\Models\PemilikKapalModel;

class KelolaKapalController extends BaseController
{
    protected $kapalModel;
    protected $pemilikModel;

    public function __construct()
    {
        $this->kapalModel   = new KapalModel();
        $this->pemilikModel = new PemilikKapalModel();
    }

    public function index()
    {
        $data['kapal'] = $this->kapalModel
            ->select('kapal.*, pemilik_kapal.nama_lengkap')
            ->join('pemilik_kapal', 'pemilik_kapal.id_pemilik = kapal.id_pemilik')
            ->findAll();

        return view('admin/kelola_kapal/index', $data);
    }

    public function create()
    {
        $data['pemilik'] = $this->pemilikModel->findAll();
        return view('admin/kelola_kapal/create', $data);
    }

    public function store()
    {
        $file = $this->request->getFile('foto_kapal');
        $namaFoto = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaFoto = $file->getRandomName();
            $file->move(FCPATH . 'uploads/kapal/', $namaFoto);
        }

        $this->kapalModel->save([
            'id_pemilik'    => $this->request->getPost('id_pemilik'),
            'nama_kapal'    => $this->request->getPost('nama_kapal'),
            'jenis_kapal'   => $this->request->getPost('jenis_kapal'),
            'harga'         => str_replace('.', '', $this->request->getPost('harga')),
            'max_penumpang' => $this->request->getPost('max_penumpang'),
            'foto_kapal'    => $namaFoto,
            'deskripsi'     => $this->request->getPost('deskripsi'),
            'tersedia'      => $this->request->getPost('tersedia') ? 1 : 0,
        ]);

        return redirect()->to('/admin/kelola-kapal')
            ->with('success', 'Data kapal berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data['kapal']   = $this->kapalModel->find($id);
        $data['pemilik'] = $this->pemilikModel->findAll();

        return view('admin/kelola_kapal/edit', $data);
    }

    public function update($id)
    {
        $kapalLama = $this->kapalModel->find($id);

        $file = $this->request->getFile('foto_kapal');
        $namaFoto = $kapalLama['foto_kapal'];

        if ($file && $file->isValid() && !$file->hasMoved()) {

            if ($kapalLama['foto_kapal'] &&
                file_exists(FCPATH . 'uploads/kapal/' . $kapalLama['foto_kapal'])) {

                unlink(FCPATH . 'uploads/kapal/' . $kapalLama['foto_kapal']);
            }

            $namaFoto = $file->getRandomName();
            $file->move(FCPATH . 'uploads/kapal/', $namaFoto);
        }

        $this->kapalModel->update($id, [
            'id_pemilik'    => $this->request->getPost('id_pemilik'),
            'nama_kapal'    => $this->request->getPost('nama_kapal'),
            'jenis_kapal'   => $this->request->getPost('jenis_kapal'),
            'harga'         => str_replace('.', '', $this->request->getPost('harga')),
            'max_penumpang' => $this->request->getPost('max_penumpang'),
            'foto_kapal'    => $namaFoto,
            'deskripsi'     => $this->request->getPost('deskripsi'),
            'tersedia'      => $this->request->getPost('tersedia') ? 1 : 0,
        ]);

        return redirect()->to('/admin/kelola-kapal')
            ->with('success', 'Data kapal berhasil diperbarui');
    }

    public function delete($id)
    {
        $kapal = $this->kapalModel->find($id);

        if ($kapal['foto_kapal'] &&
            file_exists(FCPATH . 'uploads/kapal/' . $kapal['foto_kapal'])) {

            unlink(FCPATH . 'uploads/kapal/' . $kapal['foto_kapal']);
        }

        $this->kapalModel->delete($id);

        return redirect()->to('/admin/kelola-kapal')
            ->with('success', 'Data kapal berhasil dihapus');
    }
}
