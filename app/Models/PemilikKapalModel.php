<?php

namespace App\Models;
use CodeIgniter\Model;


class PemilikKapalModel extends Model
{
    protected $table = 'pemilik_kapal';
    protected $primaryKey = 'id_pemilik';
    protected $allowedFields = [
        'username', 'password', 'nama_lengkap', 'email', 'no_hp'
    ];

}
