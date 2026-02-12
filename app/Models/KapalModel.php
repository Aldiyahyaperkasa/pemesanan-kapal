<?php

namespace App\Models;

use CodeIgniter\Model;

class KapalModel extends Model
{
    protected $table         = 'kapal';
    protected $primaryKey    = 'id_kapal';
    protected $allowedFields = [
        'id_pemilik',
        'nama_kapal',
        'jenis_kapal',
        'harga',
        'max_penumpang',
        'deskripsi',
        'tersedia'
    ];

    protected $useTimestamps = false;

    // 🔥 Ambil kapal yang tersedia untuk landing page
    public function getKapalTersedia()
    {
        return $this->where('tersedia', 1)->findAll();
    }
}
