<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PemilikKapalSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'pemilik1',
                'password' => password_hash('pemilik123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'pemilik1',
                'email'    => 'exampl1@gmail.com',
                'no_hp'    => '085622342155',                
            ],                              
        ];

        // Insert batch ke tabel admin
        $this->db->table('pemilik_kapal')->insertBatch($data);
    }
}
