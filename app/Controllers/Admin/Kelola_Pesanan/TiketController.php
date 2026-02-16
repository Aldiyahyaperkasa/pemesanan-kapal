<?php

namespace App\Controllers\Admin\Kelola_Pesanan;

use App\Controllers\BaseController;
use Config\Database;

class TiketController extends BaseController
{
    public function index($kode)
    {
        $db = Database::connect();

        $tiket = $db->table('tiket')
            ->select('tiket.*, pemesanan.*, kapal.nama_kapal')
            ->join('pemesanan', 'pemesanan.id_pemesanan = tiket.id_pemesanan')
            ->join('kapal', 'kapal.id_kapal = pemesanan.id_kapal')
            ->where('tiket.kode_tiket', $kode)
            ->get()
            ->getRowArray();

        if (!$tiket) {
            return view('admin/kelola_pesanan/tiket/tidak_ditemukan');
        }

        return view('admin/kelola_pesanan/tiket/index', [
            'tiket' => $tiket
        ]);
    }
}
