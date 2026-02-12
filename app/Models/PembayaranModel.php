<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table         = 'pembayaran';
    protected $primaryKey    = 'id_pembayaran';

    protected $allowedFields = [
        'id_pemesanan',
        'jenis_pembayaran',
        'jumlah_bayar',
        'metode',
        'bukti_bayar',
        'status_verifikasi'
    ];

    protected $useTimestamps = false;

    // 🔥 Ambil pembayaran berdasarkan pesanan
    public function getByPemesanan($id_pemesanan)
    {
        return $this->where('id_pemesanan', $id_pemesanan)->findAll();
    }
}
