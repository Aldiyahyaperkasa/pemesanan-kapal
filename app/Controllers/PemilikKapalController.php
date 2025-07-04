<?php

namespace App\Controllers;
use App\Models\PemilikKapalModel;
use App\Models\PemesananModel;
use App\Models\KapalModel;


class PemilikKapalController extends BaseController
{
    public function index()
    {
        // Cek apakah sudah login sebagai pemilik kapal
        if (!session()->get('pemilik_logged_in')) {
            return redirect()->to('/LoginController');
        }

        return view('pemilik_kapal/dashboard');
    }

    public function pemesanan()
    {
        if (!session()->get('pemilik_logged_in')) {
            return redirect()->to('/LoginController');
        }

        $kapalModel = new KapalModel();
        $pemesananModel = new PemesananModel();

        $idPemilik = session()->get('pemilik_id');

        // Ambil semua kapal milik pemilik ini
        $kapals = $kapalModel->where('id_pemilik', $idPemilik)->findAll();

        // Jika tidak ada kapal, maka pemesanan akan kosong
        if (!$kapals) {
            $data['pemesanan'] = [];
            return view('pemilik_kapal/kelola_pemesanan/pemesanan', $data);
        }

        // Ambil ID kapal yang dimiliki
        $kapalIDs = array_column($kapals, 'id_kapal');

        // Ambil pemesanan untuk kapal-kapal milik pemilik ini
        $data['pemesanan'] = $pemesananModel
            ->select('pemesanan.*, pemesan.nama_lengkap, kapal.nama_kapal')
            ->join('kapal', 'kapal.id_kapal = pemesanan.id_kapal')
            ->join('pemesan', 'pemesan.id_pemesan = pemesanan.id_pemesan')
            ->whereIn('pemesanan.id_kapal', $kapalIDs)
            ->orderBy('pemesanan.created_at', 'DESC')
            ->findAll();

        return view('pemilik_kapal/kelola_pemesanan/pemesanan', $data);
    }

    public function updateStatus($id_pemesanan)
    {
        $status = $this->request->getPost('status_pemilik');

        $pemesananModel = new PemesananModel();
        $pemesananModel->update($id_pemesanan, ['status_pemilik' => $status]);

        return redirect()->to('/pemilik_kapal/pemesanan')->with('success', 'Status berhasil diperbarui');
    }

}
