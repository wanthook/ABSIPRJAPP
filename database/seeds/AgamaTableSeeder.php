<?php

use Illuminate\Database\Seeder;

class AgamaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agama')->truncate();
        DB::table('agama')->insert([
            [
                'agama_nama'   => 'Islam',
                'created_by'   => '1',
                'updated_by'   => '1',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s')
            ],
            [
                'agama_nama'   => 'Katolik',
                'created_by'   => '1',
                'updated_by'   => '1',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s')
            ],
            [
                'agama_nama'   => 'Protestan',
                'created_by'   => '1',
                'updated_by'   => '1',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s')
            ],
            [
                'agama_nama'   => 'Budha',
                'created_by'   => '1',
                'updated_by'   => '1',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s')
            ],
            [
                'agama_nama'   => 'Hindu',
                'created_by'   => '1',
                'updated_by'   => '1',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s')
            ],
            [
                'agama_nama'   => 'Aliran Kepercayaan',
                'created_by'   => '1',
                'updated_by'   => '1',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
