<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "id"=>1,
                "nama_departemen"=>"Department Infrastructure Communication CIP",
                "bisnis_unit_id"=>3,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>2,
                "nama_departemen"=>"Group Container Yard CY2 CIP",
                "bisnis_unit_id"=>3,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>3,
                "nama_departemen"=>"Group PLB1 CIP",
                "bisnis_unit_id"=>3,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>4,
                "nama_departemen"=>"Section Land Active Villa TLLI",
                "bisnis_unit_id"=>17,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>5,
                "nama_departemen"=>"Department F&B Villa TLLI",
                "bisnis_unit_id"=>17,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>6,
                "nama_departemen"=>"Group Landscape Villa TLLI",
                "bisnis_unit_id"=>17,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>7,
                "nama_departemen"=>"Group Cost Control PGC",
                "bisnis_unit_id"=>6,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>8,
                "nama_departemen"=>"Department F&B PGC",
                "bisnis_unit_id"=>6,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>9,
                "nama_departemen"=>"Section Shuttle Exim CIP",
                "bisnis_unit_id"=>3,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>10,
                "nama_departemen"=>"Directorate PT CIP",
                "bisnis_unit_id"=>3,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>11,
                "nama_departemen"=>"Division Finance Accounting CIP",
                "bisnis_unit_id"=>3,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>12,
                "nama_departemen"=>"Group Container Yard CY3 CIP",
                "bisnis_unit_id"=>3,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>13,
                "nama_departemen"=>"Department Finance Accounting BIGCC",
                "bisnis_unit_id"=>1,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>14,
                "nama_departemen"=>"Section MEPSC TLLI",
                "bisnis_unit_id"=>17,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>15,
                "nama_departemen"=>"Section Land Activity Hotel BWJ",
                "bisnis_unit_id"=>15,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>16,
                "nama_departemen"=>"Section Front Office Hotel BWJ",
                "bisnis_unit_id"=>15,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>17,
                "nama_departemen"=>"Directorate PT GBC",
                "bisnis_unit_id"=>14,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>18,
                "nama_departemen"=>"Section MEPSC Hotel BWJ",
                "bisnis_unit_id"=>15,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>19,
                "nama_departemen"=>"Section Masterplan BWJ",
                "bisnis_unit_id"=>16,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>20,
                "nama_departemen"=>"Group Container Yard CY1 CIP",
                "bisnis_unit_id"=>3,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>21,
                "nama_departemen"=>"Group Container Yard CY1 CIP",
                "bisnis_unit_id"=>3,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>22,
                "nama_departemen"=>"Section Terminal Operation TO4 CIP",
                "bisnis_unit_id"=>3,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>23,
                "nama_departemen"=>"Group Customer Care Unit CCU GBC",
                "bisnis_unit_id"=>14,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>24,
                "nama_departemen"=>"Group Legal Drafting GBC",
                "bisnis_unit_id"=>14,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>25,
                "nama_departemen"=>"Section KPR GBC",
                "bisnis_unit_id"=>14,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>26,
                "nama_departemen"=>"Section Product Beach Club BWJ",
                "bisnis_unit_id"=>15,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>27,
                "nama_departemen"=>"Internal Audit",
                "bisnis_unit_id"=>13,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>28,
                "nama_departemen"=>"Divisi Corporate Finance Accounting & Tax KIJ",
                "bisnis_unit_id"=>13,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>29,
                "nama_departemen"=>"Corporate Marketing",
                "bisnis_unit_id"=>13,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>30,
                "nama_departemen"=>"Divisi Corporate IT KIJ",
                "bisnis_unit_id"=>13,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
            [
                "id"=>31,
                "nama_departemen"=>"Divisi Corporate HR KIJ",
                "bisnis_unit_id"=>13,
                "created_at"=>now(),
                "updated_at"=>now()
            ],
        ];
        DB::table('departemens')->insert($data);
    }
}
