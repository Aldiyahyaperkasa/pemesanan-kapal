<?php

namespace App\Controllers;
use App\Models\PemesanlModel;
use App\Models\PemesananModel;
use App\Models\KapalModel;


class PemesanController extends BaseController
{


public function index()
{
    $id_pemesan = session()->get('pemesan_id');
    $pemesananModel = new \App\Models\PemesananModel();

    $data['pemesanan'] = $pemesananModel
        ->where('id_pemesan', $id_pemesan)
        ->orderBy('created_at', 'DESC')
        ->first();

    return view('pemesan/dashboard', $data);
}


    public function uploadBukti($id)
    {
        $pemesananModel = new \App\Models\PemesananModel();
        $data['pemesanan'] = $pemesananModel->find($id);

        return view('pemesan/upload_bukti', $data);
    }

    public function prosesUploadBukti($id)
    {
        $file = $this->request->getFile('bukti_bayar');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/bukti_bayar/', $newName);

            $pemesananModel = new \App\Models\PemesananModel();
            $pemesananModel->update($id, ['bukti_bayar' => $newName]);

            return redirect()->to('/pemesan/index')->with('success', 'Bukti bayar berhasil diupload');
        }

        return redirect()->back()->with('error', 'Gagal upload file');
    }

    public function edit($id)
    {
        $pemesananModel = new \App\Models\PemesananModel();
        $data['pemesanan'] = $pemesananModel->find($id);

        // hanya izinkan edit jika belum diverifikasi
        if ($data['pemesanan']['status_admin'] == 'menunggu') {
            return view('pemesan/edit_pemesanan', $data);
        }

        return redirect()->to('/pemesan/index')->with('error', 'Pesanan sudah diverifikasi dan tidak bisa diubah');
    }

    public function update($id)
    {
        $pemesananModel = new \App\Models\PemesananModel();

        $data = [
            'tanggal_berangkat' => $this->request->getPost('tanggal_berangkat'),
            'tanggal_kembali' => $this->request->getPost('tanggal_kembali'),
            'jumlah_penumpang' => $this->request->getPost('jumlah_penumpang'),
            'no_hp' => $this->request->getPost('no_hp'),
            'email' => $this->request->getPost('email')
        ];

        $pemesananModel->update($id, $data);

        return redirect()->to('/pemesan/index')->with('success', 'Pemesanan berhasil diperbarui');
    }


    public function riwayat()
    {
        $id_pemesan = session()->get('pemesan_id');
        $pemesananModel = new \App\Models\PemesananModel();

        $data['semua_pesanan'] = $pemesananModel
            ->where('id_pemesan', $id_pemesan)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('pemesan/riwayat/index', $data);
    }

}