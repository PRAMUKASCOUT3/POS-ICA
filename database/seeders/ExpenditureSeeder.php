<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenditureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('expenditures')->insert([
            [
                'date' => '2024-12-13',
                'description' => 'Pembelian bahan baku kayu',
                'nominal' => '5000000',
            ],
            [
                'date' => '2024-12-10',
                'description' => 'Biaya transportasi pengiriman barang',
                'nominal' => '1200000',
            ],
            [
                'date' => '2024-12-30',
                'description' => 'Pembayaran gaji karyawan',
                'nominal' => '8000000',
            ],
            [
                'date' => '2024-12-20',
                'description' => 'Pembelian alat kerja tambahan',
                'nominal' => '3000000',
            ],
            [
                'date' => '2024-12-29',
                'description' => 'Biaya listrik dan air',
                'nominal' => '1500000',
            ],
        ]);
    }
}
