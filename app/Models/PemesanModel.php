<?php

namespace App\Models;
use CodeIgniter\Model;


class PemesanModel extends Model
{
    protected $table = 'pemesan';
    protected $primaryKey = 'id_pemesan';
    protected $allowedFields = [
        'username', 'password', 'nama_lengkap', 'email', 'no_hp'
    ];

}
