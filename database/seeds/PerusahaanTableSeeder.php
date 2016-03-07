<?php

use Illuminate\Database\Seeder;

class PerusahaanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perusahaan')->truncate();
        DB::table('perusahaan')->insert([
            [
                'perusahaan_kode'   => 'IJ',
                'perusahaan_nama'   => 'Indah Jaya',
                'created_by'        => '1',
                'updated_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s')

            ],
            [
                'perusahaan_kode'   => 'AR',
                'perusahaan_nama'   => 'Artos',
                'created_by'        => '1',
                'updated_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s')

            ],
            [
                'perusahaan_kode'   => 'GT',
                'perusahaan_nama'   => 'Satpam',
                'created_by'        => '1',
                'updated_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s')

            ],
            [
                'perusahaan_kode'   => 'AS',
                'perusahaan_nama'   => 'Aura Seca',
                'created_by'        => '1',
                'updated_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s')

            ],
            [
                'perusahaan_kode'   => 'SII',
                'perusahaan_nama'   => 'Spinmill',
                'created_by'        => '1',
                'updated_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s')

            ],
            [
                'perusahaan_kode'   => 'AK',
                'perusahaan_nama'   => 'ANUGRAH KOMALA TUNGGAL',
                'created_by'        => '1',
                'updated_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s')

            ]
        ]);
    }
}
