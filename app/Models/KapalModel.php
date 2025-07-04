<?php

namespace App\Models;

use CodeIgniter\Model;

class KapalModel extends Model
{
    protected $table = 'kapal';
    protected $primaryKey = 'id_kapal';
    protected $allowedFields = [
        'id_pemilik', 'nama_kapal', 'jenis_kapal',
        'harga', 'max_penumpang', 'foto_kapal',
        'deskripsi', 'tersedia'
    ];

    public function getKapalWithPemilik()
    {
        return $this->select('kapal.*, pemilik_kapal.nama_lengkap as nama_pemilik')
                    ->join('pemilik_kapal', 'pemilik_kapal.id_pemilik = kapal.id_pemilik', 'left')
                    ->orderBy('id_kapal', 'desc')
                    ->findAll();
    }

    public function getPaginatedKapalWithPemilik($perPage, $currentPage)
{
    return $this->select('kapal.*, pemilik_kapal.nama_lengkap as nama_pemilik')
                ->join('pemilik_kapal', 'pemilik_kapal.id_pemilik = kapal.id_pemilik', 'left')
                ->orderBy('kapal.id_kapal', 'asc')
                ->paginate($perPage, 'default', $currentPage);
}

}
