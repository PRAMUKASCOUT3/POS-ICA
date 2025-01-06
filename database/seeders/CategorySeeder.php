<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Living Room',
            ],
            [
                'name' => 'Bedroom',
            ],
            [
                'name' => 'Dining Room',
            ],
            [
                'name' => 'Office',
            ],
            [
                'name' => 'Outdoor',
            ],
            [
                'name' => 'Kitchen',
            ],
            [
                'name' => 'Storage',
            ],
            [
                'name' => 'Kids Room',
            ],
            [
                'name' => 'Bathroom',
            ],
            [
                'name' => 'Decor',
            ],
        ]);
    }
}