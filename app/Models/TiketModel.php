<?php

namespace App\Models;

use CodeIgniter\Model;

class TiketModel extends Model
{
    protected $table = 'tiket';
    protected $primaryKey = 'id_tiket';

    protected $allowedFields = [
        'id_pemesanan',
        'kode_tiket',
        'file_tiket',
        'created_at'
    ];
}
