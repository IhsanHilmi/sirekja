<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "id" => 1,
                "employee_name" => "ASep",
                "jabatan_id" => 17,
                "golongan" => "01",
                "status" => "Kontrak",
                "tanggal_bergabung" => "2024-10-21",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 2,
                "employee_name" => "Ahmad",
                "jabatan_id" => 15,
                "golongan" => "02",
                "status" => "Bulan",
                "tanggal_bergabung" => "2024-10-21",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 3,
                "employee_name" => "Ananda",
                "jabatan_id" => 6,
                "golongan" => "01",
                "status" => "Bulan",
                "tanggal_bergabung" => "2024-10-22",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 4,
                "employee_name" => "Andy",
                "jabatan_id" => 9,
                "golongan" => "02",
                "status" => "Bulan",
                "tanggal_bergabung" => "2024-10-22",
                "created_at" => now(),
                "updated_at" => now()
            ]];
        DB::table('employees')->insert($data);
    }
}
