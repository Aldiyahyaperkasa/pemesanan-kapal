<?php

namespace App\Models;

use CodeIgniter\Model;

class PemesananModel extends Model
{
    protected $table = 'pemesanan';
    protected $primaryKey = 'id_pemesanan';

    protected $allowedFields = [
        'id_pemesan',
        'id_kapal',
        'jumlah_penumpang',
        'total_harga',
        'tanggal_berangkat',
        'tanggal_kembali',
        'status_pemilik',
        'status_admin',
        'bukti_bayar',
        'tiket_dikirim',
        'created_at'
    ];

    protected $returnType = 'array'; // agar hasil find() berupa array
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';


}
