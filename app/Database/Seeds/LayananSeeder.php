<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LayananSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_layanan'  => 'Cuci Kering',
                'harga'         => 7000,
                'estimasi_hari' => 2,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_layanan'  => 'Cuci Setrika',
                'harga'         => 9000,
                'estimasi_hari' => 2,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_layanan'  => 'Setrika',
                'harga'         => 5000,
                'estimasi_hari' => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_layanan'  => 'Express',
                'harga'         => 15000,
                'estimasi_hari' => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('layanan')->insertBatch($data);
    }
}
