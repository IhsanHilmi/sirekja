<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApprovalLineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "id" => 1,
                "user_employee" => 1,
                "bisnis_unit_id" => 13,
                "hr_unit" => 2,
                "direksi_1" => 3,
                "direksi_2" => 4,
                "direksi_3" => null,
                "presdir" => 2,
                "corporate_hr" => 3,
                "superadmin" => 4,
                "created_at" => now(),
                "updated_at" => now()
            ]
        ];
        DB::table('approval_lines')->insert($data);
    }
}
