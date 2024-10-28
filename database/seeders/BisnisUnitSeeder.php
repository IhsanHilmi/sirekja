<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BisnisUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama_bisnis_unit' => 'PADANG GOLF CIKARANG (BIGCC)-Jawa Tengah', 'created_at' => now()],
            ['nama_bisnis_unit' => 'CIKARANG GERBANG SOLUSI (CGS)', 'created_at' => now()],
            ['nama_bisnis_unit' => 'CIKARANG INLAND PORT (CIP)', 'created_at' => now()],
            ['nama_bisnis_unit' => 'GERBANG TEKNOLOGI CIKARANG (GTC)', 'created_at' => now()],
            ['nama_bisnis_unit' => 'METROPARK CONDOMINIUM INDAH (MCI)', 'created_at' => now()],
            ['nama_bisnis_unit' => 'PADANG GOLF CIKARANG (JGCC)-Jawa Barat', 'created_at' => now()],
            ['nama_bisnis_unit' => 'SARANA INDAH PERMAI RESIDEN (SIPR)', 'created_at' => now()],
            ['nama_bisnis_unit' => 'SARANAPRATAMA PENGEMBANGAN KOTA (SPPK)', 'created_at' => now()],
            ['nama_bisnis_unit' => 'KAWASAN INDUSTRI KENDAL (KIK)', 'created_at' => now()],
            ['nama_bisnis_unit' => 'INFRASTRUKTUR CAKRAWALA TELEKOMUNIKASI (ICT)', 'created_at' => now()],
            ['nama_bisnis_unit' => 'JABABEKA INFRASTRUKTUR (JI)', 'created_at' => now()],
            ['nama_bisnis_unit' => 'NUSANTARA GAS ENERGI (NGE)', 'created_at' => now()],
            ['nama_bisnis_unit' => 'KAWASAN INDUSTRI JABABEKA (KIJA)-Cikarang', 'created_at' => now()],
            ['nama_bisnis_unit' => 'GRAHABUANA CIKARANG (GBC)-Jawa Barat', 'created_at' => now()],
            ['nama_bisnis_unit' => 'BANTEN WEST JAVA TOURISM DEVELOPMENT (BWJ)-Banten', 'created_at' => now()],
            ['nama_bisnis_unit' => 'BANTEN WEST JAVA TOURISM DEVELOPMENT (BWJ)-DKI Jakarta', 'created_at' => now()],
            ['nama_bisnis_unit' => 'TANJUNG LESUNG LEISURE INDUSTRY (TLLI)', 'created_at' => now()],
            ['nama_bisnis_unit' => 'KOPERASI MITRA MAJU MAKMUR (MMM)', 'created_at' => now()],
            ['nama_bisnis_unit' => 'JABABEKA MOROTAI (JM)-Jawa Barat', 'created_at' => now()],
            ['nama_bisnis_unit' => 'JABABEKA MOROTAI (JM)-Maluku Utara', 'created_at' => now()],
            ['nama_bisnis_unit' => 'BEKASI POWER (BP)', 'created_at' => now()],
            ['nama_bisnis_unit' => 'PROTEKSI USAHA INDONESIA (PUI)', 'created_at' => now()],
            ['nama_bisnis_unit' => 'UNITED POWER - KENDAL', 'created_at' => now()],
            ['nama_bisnis_unit' => 'UNITED POWER (UP)', 'created_at' => now()],
            ['nama_bisnis_unit' => 'JABABEKA MULTI MEDIKA (JMM)', 'created_at' => now()],
            ['nama_bisnis_unit' => 'INDOCARGOMAS PERSADA (ICMP)', 'created_at' => now()],
            ['nama_bisnis_unit' => 'MITRA PENGEMBANG KAWASAN', 'created_at' => now()],
        ];

        DB::table('bisnis_units')->insert($data);
    }
}
