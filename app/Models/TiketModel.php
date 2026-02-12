<?php

namespace App\Models;

use CodeIgniter\Model;

class TiketModel extends Model
{
    protected $table         = 'tiket';
    protected $primaryKey    = 'id_tiket';

    protected $allowedFields = [
        'id_pemesanan',
        'kode_tiket',
        'file_tiket'
    ];

    protected $useTimestamps = false;

    public function getByPemesanan($id_pemesanan)
    {
        return $this->where('id_pemesanan', $id_pemesanan)->first();
    }
}
