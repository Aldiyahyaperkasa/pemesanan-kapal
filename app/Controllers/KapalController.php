<?php

namespace App\Controllers;

use App\Models\KapalModel;
use App\Models\PemilikKapalModel;
use CodeIgniter\Controller;

class KapalController extends Controller
{
    protected $kapalModel;
    protected $pemilikModel;

    public function __construct()
    {
        $this->kapalModel = new KapalModel();
        $this->pemilikModel = new PemilikKapalModel();
    }


    public function index()
    {
        $perPage = 10;
        $currentPage = $this->request->getVar('page') ?? 1;

        $data['kapal'] = $this->kapalModel->getPaginatedKapalWithPemilik($perPage, $currentPage);
        $data['pager'] = $this->kapalModel->pager;
        $data['currentPage'] = $currentPage;
        $data['perPage'] = $perPage;

        return view('admin/kapal/kapal', $data);
    }



    public function form_tambah()
    {
        $data = [
            'title' => 'Tambah Kapal',
            'pemilik' => $this->pemilikModel->findAll()
        ];
        return view('admin/kapal/tambah_kapal', $data);
    }

    public function tambah_kapal()
    {
        $validation = \Config\Services::validation();

        // Validasi input
        if (!$this->validate([
            'id_pemilik' => 'required|integer',
            'nama_kapal' => 'required',
            'jenis_kapal' => 'required|in_list[perorangan,rombongan]',
            'harga' => 'required|numeric',
            'max_penumpang' => 'required|integer',
            'foto_kapal' => 'is_image[foto_kapal]|max_size[foto_kapal,5120]',
            'tersedia' => 'required|in_list[0,1]'
        ])) {
            dd('Validasi gagal', $this->validator->getErrors());
        }


        // PENTING: Dapatkan file gambar
        $fileFoto = $this->request->getFile('foto_kapal');

        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $namaFile = $fileFoto->getRandomName();
            if (!$fileFoto->move(FCPATH . 'assets/gambar_kapal', $namaFile)) {
                dd('Gagal memindahkan file. Cek permission folder.');
            }
        } else {
            dd([
                'isValid' => $fileFoto->isValid(),
                'hasMoved' => $fileFoto->hasMoved(),
                'error' => $fileFoto->getErrorString(),
                'errorCode' => $fileFoto->getError()
            ]);
        }


        // Simpan ke database
        $saved = $this->kapalModel->save([
            'id_pemilik' => $this->request->getPost('id_pemilik'),
            'nama_kapal' => $this->request->getPost('nama_kapal'),
            'jenis_kapal' => $this->request->getPost('jenis_kapal'),
            'harga' => $this->request->getPost('harga'),
            'max_penumpang' => $this->request->getPost('max_penumpang'),
            'foto_kapal' => $namaFile,
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tersedia' => $this->request->getPost('tersedia')
        ]);

        if (!$saved) {
            dd('Gagal simpan data', $this->kapalModel->errors());
        }


        return redirect()->to(base_url('kapal/index'))->with('success', 'Data kapal berhasil ditambahkan.');
    }

    public function form_edit($id)
    {
        $kapal = $this->kapalModel->find($id);
        if (!$kapal) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Data kapal tidak ditemukan.");
        }

        $data = [
            'title' => 'Edit Kapal',
            'kapal' => $kapal,
            'pemilik' => $this->pemilikModel->findAll()
        ];

        return view('admin/kapal/edit_kapal', $data);
    }

    public function edit_kapal($id)
    {
        $kapalLama = $this->kapalModel->find($id);
        if (!$kapalLama) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Data kapal tidak ditemukan.");
        }

        $validation = \Config\Services::validation();

        
        if (!$this->validate([
            'id_pemilik' => 'required|integer',
            'nama_kapal' => 'required',
            'jenis_kapal' => 'required|in_list[perorangan,rombongan]',
            'harga' => 'required|numeric',
            'max_penumpang' => 'required|integer',            
            'foto_kapal' => 'permit_empty|is_image[foto_kapal]|max_size[foto_kapal,2048]',
            'tersedia' => 'required|in_list[0,1]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $fileFoto = $this->request->getFile('foto_kapal');
        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            // Hapus foto lama jika ada
            if ($kapalLama['foto_kapal'] && file_exists(FCPATH . 'assets/gambar_kapal/' . $kapalLama['foto_kapal'])) {
                unlink(FCPATH . 'assets/gambar_kapal/' . $kapalLama['foto_kapal']);
            }

            $namaFile = $fileFoto->getRandomName();
            $fileFoto->move(FCPATH . 'assets/gambar_kapal/', $namaFile);
        } else {
            $namaFile = $kapalLama['foto_kapal']; // tetap pakai foto lama
        }

        $this->kapalModel->update($id, [
            'id_pemilik' => $this->request->getPost('id_pemilik'),
            'nama_kapal' => $this->request->getPost('nama_kapal'),
            'jenis_kapal' => $this->request->getPost('jenis_kapal'),
            'harga' => $this->request->getPost('harga'),
            'max_penumpang' => $this->request->getPost('max_penumpang'),
            'foto_kapal' => $namaFile,
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tersedia' => $this->request->getPost('tersedia')
        ]);

        return redirect()->to(base_url('kapal/index'))->with('success', 'Data kapal berhasil diupdate.');
    }

    public function hapus_kapal($id)
    {
        $kapal = $this->kapalModel->find($id);
        if ($kapal) {
            // Hapus file foto kapal jika ada
            if ($kapal['foto_kapal'] && file_exists(FCPATH . 'uploads/kapal/' . $kapal['foto_kapal'])) {
                unlink(FCPATH . 'uploads/kapal/' . $kapal['foto_kapal']);
            }
            $this->kapalModel->delete($id);
            return redirect()->to(base_url('kapal/index'))->with('success', 'Data kapal berhasil dihapus.');
        }
        return redirect()->to(base_url('kapal/index'))->with('error', 'Data kapal tidak ditemukan.');
    }
}
