<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeederAkun1 extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kode_akun1' => 1,
                'nama_akun1' => 'Aktiva'
            ],
            [
                'kode_akun1' => 2,
                'nama_akun1' => 'Kewajiban'
            ],
            [
                'kode_akun1' => 3,
                'nama_akun1' => 'Modal'
            ],
            [
                'kode_akun1' => 4,
                'nama_akun1' => 'Pendapatan'
            ],
            [
                'kode_akun1' => 5,
                'nama_akun1' => 'Beban'
            ],
        ];

        // ini untuk 1 data 
        // $this->db->table('akun1s')->insert($data);

        // ini untuk banyak data
        $this->db->table('akun1s')->insertBatch($data);
    }
}
