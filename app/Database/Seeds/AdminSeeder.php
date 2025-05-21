<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin1',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'admin1',
                'email'    => 'exampl1@gmail.com',
                'no_hp'    => '085622342155',                
            ],                              
        ];

        // Insert batch ke tabel admin
        $this->db->table('admin')->insertBatch($data);
    }
}
