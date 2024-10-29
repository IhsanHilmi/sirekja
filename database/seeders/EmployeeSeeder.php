<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

        $data2 = [
            [
                "id" => 1,
                "name" => "ASep",
                "email" => "asep@jababeka.com",
                "role" => "Employee",
                "employee_id" => 1,
                "password" => Hash::make("ASep"),
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 2,
                "name" => "Ahmad",
                "email" => "ahmad@jababeka.com",
                "role" => "HR",
                "employee_id" => 2,
                "password" => Hash::make("Ahmad"),
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 3,
                "name" => "Ananda",
                "email" => "anan@jababeka.com",
                "role" => "Superadmin",
                "employee_id" => 3,
                "password" => Hash::make("Ananda"),
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 4,
                "name" => "Andy",
                "email" => "andy@jababeka.com",
                "role" => "Employee",
                "employee_id" => 4,
                "password" => Hash::make("Andy"),
                "created_at" => now(),
                "updated_at" => now()
            ]];

        DB::table('users')->insert($data2);
    }
}
