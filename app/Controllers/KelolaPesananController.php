<?php

namespace App\Controllers;

use App\Models\PemesananModel;
use App\Models\KapalModel;
use CodeIgniter\Controller;

class KelolaPesananController extends Controller
{
    public function index()
    {
        $kapalModel = new KapalModel();
        $pemesananModel = new PemesananModel();

        $kapalId = $this->request->getGet('kapal');

        $data['kapalList'] = $kapalModel->findAll();
        $data['selectedKapal'] = $kapalId;
        $data['pemesananList'] = [];

        if ($kapalId) {
            $data['pemesananList'] = $pemesananModel
                ->select('pemesanan.*, kapal.nama_kapal')
                ->join('kapal', 'kapal.id_kapal = pemesanan.id_kapal')
                ->where('pemesanan.id_kapal', $kapalId)
                ->where('status_pemilik', 'diterima')
                ->orderBy('pemesanan.created_at', 'DESC')
                ->findAll();
        }

        return view('admin/kelola_pemesanan/kelola_pemesanan', $data);
    }

    public function updateStatus($id, $status)
    {
        $pemesananModel = new PemesananModel();
        $pemesananModel->update($id, ['status_admin' => $status]);

        return redirect()->back()->with('success', 'Status pemesanan berhasil diperbarui.');
    }
}
