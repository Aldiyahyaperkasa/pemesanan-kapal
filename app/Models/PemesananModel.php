<?php

namespace App\Models;

use CodeIgniter\Model;

class PemesananModel extends Model
{
    protected $table         = 'pemesanan';
    protected $primaryKey    = 'id_pemesanan';

    protected $allowedFields = [
        'kode_booking',
        'nama_pemesan',
        'no_hp',
        'email',
        'id_kapal',
        'jumlah_penumpang',
        'tanggal_berangkat',
        'tanggal_kembali',
        'total_harga',
        'nominal_dp',
        'batas_waktu_dp',
        'status_booking',
        'alasan_penolakan'
    ];

    protected $useTimestamps = false;

    // 🔥 Ambil semua pesanan + data kapal
    public function getPemesananWithKapal()
    {
        return $this->select('pemesanan.*, kapal.nama_kapal')
                    ->join('kapal', 'kapal.id_kapal = pemesanan.id_kapal')
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    // 🔥 Cari berdasarkan kode booking (untuk halaman cek-booking)
    public function getByKodeBooking($kode)
    {
        return $this->where('kode_booking', $kode)->first();
    }
}
