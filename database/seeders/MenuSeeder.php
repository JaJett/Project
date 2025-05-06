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
                'name' => 'Cheese Cuit Stroberry',
                'description' => 'Cheese Cuit Dengan Toping Selai Stroberry',
                'price' => 7000,
                'image' => 'cheese-cuit-stroberry.jpg',
            ],
            [
                'name' => 'Cheese Cuit Original',
                'description' => 'Cheese Cuit Dengan Toping Crumble Original',
                'price' => 7000,
                'image' => 'cheese-cuit-original.jpg',

            ],
            [
                'name' => 'Cheese Cuit Macha',
                'description' => 'Cheese Cuit Dengan Toping Crumble Macha',
                'price' => 7000,
                'image' => 'cheese-cuit-Macha.jpg',

            ],
        ]
        ;foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
