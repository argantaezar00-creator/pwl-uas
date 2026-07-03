<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PelangganSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama'       => 'Andi',
                'alamat'     => 'Jl. Merdeka No. 1',
                'no_hp'      => '081234567890',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'       => 'Budi',
                'alamat'     => 'Jl. Sudirman No. 2',
                'no_hp'      => '081234567891',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'       => 'Citra',
                'alamat'     => 'Jl. Thamrin No. 3',
                'no_hp'      => '081234567892',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'       => 'Dewi',
                'alamat'     => 'Jl. Gatot Subroto No. 4',
                'no_hp'      => '081234567893',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'       => 'Eka',
                'alamat'     => 'Jl. Diponegoro No. 5',
                'no_hp'      => '081234567894',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('pelanggan')->insertBatch($data);
    }
}
