<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert([
            [
                'name' => 'Jati Abadi Wood Supplier',
                'address' => 'Jl. Sultan Thaha No.10, Jambi',
                'contact_person' => '081234567890',
            ],
            [
                'name' => 'Sentosa Jati Group',
                'address' => 'Jl. Gatot Subroto No.15, Jambi',
                'contact_person' => '082345678901',
            ],
            [
                'name' => 'Cahaya Jati Nusantara',
                'address' => 'Jl. Raya Sipin No.20, Jambi',
                'contact_person' => '083456789012',
            ],
            [
                'name' => 'Mulia Jati Wood',
                'address' => 'Jl. Mayjen Sutoyo No.25, Jambi',
                'contact_person' => '084567890123',
            ],
            [
                'name' => 'Sumber Alam Jati',
                'address' => 'Jl. Pattimura No.8, Jambi',
                'contact_person' => '085678901234',
            ],
            [
                'name' => 'Mega Jati Furniture',
                'address' => 'Jl. Teuku Umar No.30, Jambi',
                'contact_person' => '086789012345',
            ],
            [
                'name' => 'Prima Jati Timber',
                'address' => 'Jl. Kapt. A. Bakaruddin No.5, Jambi',
                'contact_person' => '087890123456',
            ],
            [
                'name' => 'Harapan Jati Lestari',
                'address' => 'Jl. Soekarno-Hatta No.18, Jambi',
                'contact_person' => '088901234567',
            ],
            [
                'name' => 'Agung Jati Sejahtera',
                'address' => 'Jl. Pahlawan No.9, Jambi',
                'contact_person' => '089012345678',
            ],
            [
                'name' => 'Indah Jati Persada',
                'address' => 'Jl. Merdeka No.12, Jambi',
                'contact_person' => '081234567891',
            ],
        ]);
    }
}
