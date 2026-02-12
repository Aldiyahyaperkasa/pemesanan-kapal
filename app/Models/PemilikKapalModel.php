<?php

namespace App\Models;

use CodeIgniter\Model;

class PemilikKapalModel extends Model
{
    protected $table         = 'pemilik_kapal';
    protected $primaryKey    = 'id_pemilik';
    protected $allowedFields = [
        'nama_lengkap',
        'no_hp',
        'email'
    ];

    protected $useTimestamps = false;
}
