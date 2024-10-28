<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "id"=>1,
                "nama_jabatan"=>"Commis 1 Beach Club BWJ",
                "departemen_id"=>26,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>2,
                "nama_jabatan"=>"Tax Staff KIJ",
                "departemen_id"=>28,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>3,
                "nama_jabatan"=>"Tax Manager KIJ",
                "departemen_id"=>28,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>4,
                "nama_jabatan"=>"Accounting Supervisor KIJ",
                "departemen_id"=>28,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>5,
                "nama_jabatan"=>"Accounting Sr. Manager KIJ",
                "departemen_id"=>28,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>6,
                "nama_jabatan"=>"Head Of Finance KIJ",
                "departemen_id"=>28,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>7,
                "nama_jabatan"=>"Accounting Staff KIJ",
                "departemen_id"=>28,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>8,
                "nama_jabatan"=>"Finance Staff KIJ",
                "departemen_id"=>28,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>9,
                "nama_jabatan"=>"Finance Supervisor KIJ",
                "departemen_id"=>28,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>10,
                "nama_jabatan"=>"Corporate Finance & Accounting General Manager KIJ",
                "departemen_id"=>28,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>11,
                "nama_jabatan"=>"Accounting Manager KIJ",
                "departemen_id"=>28,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>12,
                "nama_jabatan"=>"Programmer KIJ",
                "departemen_id"=>30,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>13,
                "nama_jabatan"=>"Desktop Support KIJ",
                "departemen_id"=>30,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>14,
                "nama_jabatan"=>"Networking Support KIJ",
                "departemen_id"=>30,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>15,
                "nama_jabatan"=>"Network\/Security Supervisor KIJ",
                "departemen_id"=>30,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>16,
                "nama_jabatan"=>"DBA & SQL Development KIJ",
                "departemen_id"=>30,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>17,
                "nama_jabatan"=>"Head Of Corporate Marketing KIJ",
                "departemen_id"=>29,
                "created_at"=>now(),
                "updated_at"=>now()
                ]
        ];
        DB::table('jabatans')->insert($data);
    }
}
