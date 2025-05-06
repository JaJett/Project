<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'name' => 'Nasi Goreng Spesial',
                'description' => 'Nasi goreng dengan telur, ayam, dan sayur.',
                'price' => 20000,
                'image' => 'nasi-goreng.jpg',
            ],
            [
                'name' => 'Es Teh Manis',
                'description' => 'Teh manis dingin segar.',
                'price' => 5000,
                'image' => 'es-teh.jpg',

            ],
            [
                'name' => 'Ayam Bakar',
                'description' => 'Ayam bakar dengan bumbu khas.',
                'price' => 25000,
                'image' => 'ayam-bakar.jpg',

            ],
        ]
        ;foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
