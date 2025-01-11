<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'id_category' => 1, // Living Room
                'code' => 'LR-001',
                'name' => 'Modern Sofa',
                'brand' => 'ComfortPlus',
                'stock' => 20,
                'price_buy' => '2000000',
                'price_sell' => '2500000',
                'unit' => 'pcs',
            ],
            [
                'id_category' => 1, // Living Room
                'code' => 'LR-002',
                'name' => 'Coffee Table',
                'brand' => 'WoodArt',
                'stock' => 15,
                'price_buy' => '750000',
                'price_sell' => '950000',
                'unit' => 'pcs',
            ],
            [
                'id_category' => 1, // Living Room
                'code' => 'LR-003',
                'name' => 'TV Stand',
                'brand' => 'MediaPro',
                'stock' => 12,
                'price_buy' => '1200000',
                'price_sell' => '1500000',
                'unit' => 'pcs',
            ],
            [
                'id_category' => 2, // Bedroom
                'code' => 'BR-001',
                'name' => 'King Size Bed',
                'brand' => 'DreamWell',
                'stock' => 10,
                'price_buy' => '5000000',
                'price_sell' => '6000000',
                'unit' => 'pcs',
            ],
            [
                'id_category' => 2, // Bedroom
                'code' => 'BR-002',
                'name' => 'Wardrobe 3 Doors',
                'brand' => 'ClosetPro',
                'stock' => 8,
                'price_buy' => '3000000',
                'price_sell' => '3500000',
                'unit' => 'pcs',
            ],
            [
                'id_category' => 2, // Bedroom
                'code' => 'BR-003',
                'name' => 'Nightstand',
                'brand' => 'CozyCorner',
                'stock' => 25,
                'price_buy' => '500000',
                'price_sell' => '700000',
                'unit' => 'pcs',
            ],
            [
                'id_category' => 3, // Dining Room
                'code' => 'DR-001',
                'name' => 'Dining Table Set',
                'brand' => 'TableMaster',
                'stock' => 5,
                'price_buy' => '4000000',
                'price_sell' => '4500000',
                'unit' => 'set',
            ],
            [
                'id_category' => 3, // Dining Room
                'code' => 'DR-002',
                'name' => 'Dining Chair',
                'brand' => 'ChairArt',
                'stock' => 30,
                'price_buy' => '500000',
                'price_sell' => '700000',
                'unit' => 'pcs',
            ],
            [
                'id_category' => 3, // Dining Room
                'code' => 'DR-003',
                'name' => 'Buffet Table',
                'brand' => 'ServeEase',
                'stock' => 8,
                'price_buy' => '2000000',
                'price_sell' => '2500000',
                'unit' => 'pcs',
            ],
            [
                'id_category' => 4, // Office
                'code' => 'OF-001',
                'name' => 'Ergonomic Chair',
                'brand' => 'OfficeEase',
                'stock' => 30,
                'price_buy' => '1500000',
                'price_sell' => '1800000',
                'unit' => 'pcs',
            ],
            [
                'id_category' => 4, // Office
                'code' => 'OF-002',
                'name' => 'Office Desk',
                'brand' => 'DeskPro',
                'stock' => 20,
                'price_buy' => '2500000',
                'price_sell' => '3000000',
                'unit' => 'pcs',
            ],
            [
                'id_category' => 5, // Outdoor
                'code' => 'OD-001',
                'name' => 'Garden Bench',
                'brand' => 'NatureTouch',
                'stock' => 12,
                'price_buy' => '1200000',
                'price_sell' => '1400000',
                'unit' => 'pcs',
            ],
            [
                'id_category' => 5, // Outdoor
                'code' => 'OD-002',
                'name' => 'Patio Set',
                'brand' => 'SunsetEase',
                'stock' => 6,
                'price_buy' => '3000000',
                'price_sell' => '3500000',
                'unit' => 'set',
            ],
            [
                'id_category' => 6, // Kitchen
                'code' => 'KT-001',
                'name' => 'Kitchen Cabinet',
                'brand' => 'CabinetPro',
                'stock' => 7,
                'price_buy' => '3500000',
                'price_sell' => '4000000',
                'unit' => 'pcs',
            ],
            [
                'id_category' => 6, // Kitchen
                'code' => 'KT-002',
                'name' => 'Bar Stool',
                'brand' => 'StoolArt',
                'stock' => 15,
                'price_buy' => '800000',
                'price_sell' => '1000000',
                'unit' => 'pcs',
            ],
            [
                'id_category' => 7, // Storage
                'code' => 'ST-001',
                'name' => 'Bookshelf',
                'brand' => 'BookHaven',
                'stock' => 18,
                'price_buy' => '800000',
                'price_sell' => '1000000',
                'unit' => 'pcs',
            ],
            [
                'id_category' => 7, // Storage
                'code' => 'ST-002',
                'name' => 'Storage Box',
                'brand' => 'OrganizePro',
                'stock' => 50,
                'price_buy' => '300000',
                'price_sell' => '400000',
                'unit' => 'pcs',
            ],
            [
                'id_category' => 8, // Kids Room
                'code' => 'KR-001',
                'name' => 'Kids Study Desk',
                'brand' => 'LearnFun',
                'stock' => 20,
                'price_buy' => '900000',
                'price_sell' => '1100000',
                'unit' => 'pcs',
            ],
            [
                'id_category' => 8, // Kids Room
                'code' => 'KR-002',
                'name' => 'Toy Organizer',
                'brand' => 'ToyTidy',
                'stock' => 25,
                'price_buy' => '600000',
                'price_sell' => '800000',
                'unit' => 'pcs',
            ],
        ]);
    }
}
