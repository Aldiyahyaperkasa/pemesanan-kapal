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
    $kapalModel = new \App\Models\KapalModel();
    $pemesanModel = new \App\Models\PemesanModel();

    $pemesanan = $pemesananModel->where('id_pemesan', $id_pemesan)
        ->orderBy('created_at', 'DESC')
        ->first();

    if ($pemesanan) {
        $kapal = $kapalModel->find($pemesanan['id_kapal']);
        $pemesan = $pemesanModel->find($pemesanan['id_pemesan']);
    } else {
        $kapal = null;
        $pemesan = null;
    }

    return view('pemesan/dashboard', [
        'pemesanan' => $pemesanan,
        'kapal' => $kapal,
        'pemesan' => $pemesan
    ]);
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
    $db = \Config\Database::connect();

    $builder = $db->table('pemesanan');
    $builder->select('pemesanan.*, kapal.nama_kapal, kapal.jenis_kapal, kapal.foto_kapal, pemesan.nama_lengkap, pemesan.email, pemesan.no_hp');
    $builder->join('kapal', 'kapal.id_kapal = pemesanan.id_kapal');
    $builder->join('pemesan', 'pemesan.id_pemesan = pemesanan.id_pemesan');
    $builder->where('pemesanan.id_pemesanan', $id);
    $pemesanan = $builder->get()->getRowArray();

    if (!$pemesanan) {
        return redirect()->to('/pemesan/index')->with('error', 'Data tidak ditemukan');
    }

    // hanya izinkan edit jika belum diverifikasi
    if ($pemesanan['status_admin'] == 'menunggu') {
        return view('pemesan/edit_pemesanan', ['pemesanan' => $pemesanan]);
    }

    return redirect()->to('/pemesan/index')->with('error', 'Pesanan sudah diverifikasi dan tidak bisa diubah');
}


public function update($id)
{
    $pemesananModel = new \App\Models\PemesananModel();
    $kapalModel = new \App\Models\KapalModel();

    $pemesanan = $pemesananModel->find($id);

    if (!$pemesanan) {
        return redirect()->to('/pemesan/index')->with('error', 'Data pemesanan tidak ditemukan');
    }

    $kapal = $kapalModel->find($pemesanan['id_kapal']);
    if (!$kapal || !isset($kapal['jenis_kapal'])) {
        return redirect()->to('/pemesan/index')->with('error', 'Data kapal tidak lengkap');
    }

    $jumlah_penumpang = (int)$this->request->getPost('jumlah_penumpang');

    if ($kapal['jenis_kapal'] === 'perorangan') {
        $total_harga = $kapal['harga'] * $jumlah_penumpang;
    } else {
        $jumlah_penumpang = min($jumlah_penumpang, $kapal['max_penumpang']);
        $total_harga = $kapal['harga'];
    }

    $data = [
        'tanggal_berangkat' => $this->request->getPost('tanggal_berangkat'),
        'tanggal_kembali'   => $this->request->getPost('tanggal_kembali'),
        'jumlah_penumpang'  => $jumlah_penumpang,
        'total_harga'       => $total_harga,
        'no_hp'             => $this->request->getPost('no_hp'),
        'email'             => $this->request->getPost('email')
    ];

    $pemesananModel->update($id, $data);

    return redirect()->to('/pemesan/index')->with('success', 'Pemesanan berhasil diperbarui');
}



public function hapus($id)
{
    $pemesananModel = new \App\Models\PemesananModel();
    $pemesanan = $pemesananModel->find($id);

    if ($pemesanan && $pemesanan['status_admin'] === 'menunggu') {
        $pemesananModel->delete($id);
        return redirect()->to('/pemesan/index')->with('success', 'Pesanan berhasil dihapus');
    }

    return redirect()->to('/pemesan/index')->with('error', 'Pesanan tidak dapat dihapus');
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