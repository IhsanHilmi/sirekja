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
                "employee_name" => "Employee_1",
                "jabatan_id" => 7,
                "golongan" => "01",
                "status" => "Kontrak",
                "tanggal_bergabung" => "2024-10-21",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 2,
                "employee_name" => "Employee_2",
                "jabatan_id" => 7,
                "golongan" => "02",
                "status" => "Bulan",
                "tanggal_bergabung" => "2024-10-21",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 3,
                "employee_name" => "HRUnit_1",
                "jabatan_id" => 8,
                "golongan" => "01",
                "status" => "Bulan",
                "tanggal_bergabung" => "2024-10-22",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 4,
                "employee_name" => "HRUnit_2",
                "jabatan_id" => 8,
                "golongan" => "02",
                "status" => "Bulan",
                "tanggal_bergabung" => "2024-10-22",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 5,
                "employee_name" => "Direktur1_1",
                "jabatan_id" => 9,
                "golongan" => "02",
                "status" => "Bulan",
                "tanggal_bergabung" => "2024-10-22",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 6,
                "employee_name" => "Direktur1_2",
                "jabatan_id" => 9,
                "golongan" => "02",
                "status" => "Bulan",
                "tanggal_bergabung" => "2024-10-22",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 7,
                "employee_name" => "Direktur2_1",
                "jabatan_id" => 9,
                "golongan" => "02",
                "status" => "Bulan",
                "tanggal_bergabung" => "2024-10-22",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 8,
                "employee_name" => "Direktur2_2",
                "jabatan_id" => 9,
                "golongan" => "02",
                "status" => "Bulan",
                "tanggal_bergabung" => "2024-10-22",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 9,
                "employee_name" => "Direktur3_1",
                "jabatan_id" => 9,
                "golongan" => "02",
                "status" => "Bulan",
                "tanggal_bergabung" => "2024-10-22",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 10,
                "employee_name" => "Direktur3_2",
                "jabatan_id" => 9,
                "golongan" => "02",
                "status" => "Bulan",
                "tanggal_bergabung" => "2024-10-22",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 11,
                "employee_name" => "DeptHead1",
                "jabatan_id" => 10,
                "golongan" => "02",
                "status" => "Bulan",
                "tanggal_bergabung" => "2024-10-22",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 12,
                "employee_name" => "DeptHead2",
                "jabatan_id" => 10,
                "golongan" => "02",
                "status" => "Bulan",
                "tanggal_bergabung" => "2024-10-22",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 13,
                "employee_name" => "Superadmin",
                "jabatan_id" => 10,
                "golongan" => "02",
                "status" => "Bulan",
                "tanggal_bergabung" => "2024-10-22",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 14,
                "employee_name" => "Admin",
                "jabatan_id" => 10,
                "golongan" => "02",
                "status" => "Bulan",
                "tanggal_bergabung" => "2024-10-22",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 15,
                "employee_name" => "CorporateHR",
                "jabatan_id" => 10,
                "golongan" => "02",
                "status" => "Bulan",
                "tanggal_bergabung" => "2024-10-22",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 16,
                "employee_name" => "Dirut",
                "jabatan_id" => 10,
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
                "name" => "Employee_1",
                "email" => "Employee_1@jababeka.com",
                "role" => "Employee",
                "employee_id" => 1,
                "password" => Hash::make("Employee_1"),
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 2,
                "name" => "Employee_2",
                "email" => "Employee_2@jababeka.com",
                "role" => "Employee",
                "employee_id" => 2,
                "password" => Hash::make("Employee_2"),
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 3,
                "name" => "HRUnit_1",
                "email" => "HRUnit_1@jababeka.com",
                "role" => "HR",
                "employee_id" => 3,
                "password" => Hash::make("HRUnit_1"),
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 4,
                "name" => "HRUnit_2",
                "email" => "HRUnit_2@jababeka.com",
                "role" => "HR",
                "employee_id" => 4,
                "password" => Hash::make("HRUnit_2"),
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 5,
                "name" => "Direktur1_1",
                "email" => "Direktur1_1@jababeka.com",
                "role" => "Employee",
                "employee_id" => 5,
                "password" => Hash::make("Direktur1_1"),
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 6,
                "name" => "Direktur1_2",
                "email" => "Direktur1_2@jababeka.com",
                "role" => "Employee",
                "employee_id" => 6,
                "password" => Hash::make("Direktur1_2"),
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 7,
                "name" => "Direktur2_1",
                "email" => "Direktur2_1@jababeka.com",
                "role" => "Employee",
                "employee_id" => 7,
                "password" => Hash::make("Direktur2_1"),
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 8,
                "name" => "Direktur2_2",
                "email" => "Direktur2_2@jababeka.com",
                "role" => "Employee",
                "employee_id" => 8,
                "password" => Hash::make("Direktur2_2"),
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 9,
                "name" => "Direktur3_1",
                "email" => "Direktur3_1@jababeka.com",
                "role" => "Employee",
                "employee_id" => 9,
                "password" => Hash::make("Direktur3_1"),
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 10,
                "name" => "Direktur3_2",
                "email" => "Direktur3_2@jababeka.com",
                "role" => "Employee",
                "employee_id" => 10,
                "password" => Hash::make("Direktur3_2"),
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 11,
                "name" => "DeptHead1",
                "email" => "DeptHead1@jababeka.com",
                "role" => "Employee",
                "employee_id" => 11,
                "password" => Hash::make("DeptHead1"),
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 12,
                "name" => "DeptHead2",
                "email" => "DeptHead2@jababeka.com",
                "role" => "Employee",
                "employee_id" => 12,
                "password" => Hash::make("DeptHead2"),
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 13,
                "name" => "Superadmin",
                "email" => "super@jababeka.com",
                "role" => "Superadmin",
                "employee_id" => 13,
                "password" => Hash::make("Superadmin"),
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 14,
                "name" => "Admin",
                "email" => "admin@jababeka.com",
                "role" => "Superadmin",
                "employee_id" => 14,
                "password" => Hash::make("Admin"),
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 15,
                "name" => "CorporateHR",
                "email" => "CorporateHR@jababeka.com",
                "role" => "HR",
                "employee_id" => 15,
                "password" => Hash::make("CorporateHR"),
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => 16,
                "name" => "Dirut",
                "email" => "Dirut@jababeka.com",
                "role" => "Employee",
                "employee_id" => 16,
                "password" => Hash::make("Dirut"),
                "created_at" => now(),
                "updated_at" => now()
            ]];

        DB::table('users')->insert($data2);
    }
}
