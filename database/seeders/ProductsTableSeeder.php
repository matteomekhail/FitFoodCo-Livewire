<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->truncate();

        DB::table('products')->insert([
            [
                'name' => 'Steak and Veg',
                'description' => 'Grilled steak with mushroom sauce. Served with sweet potato mash and green beans.',
                'price' => 11.95,
                'quantity_in_stock' => 0,
                'calories' => 430,
                'protein' => 44,
                'fats' => 13,
                'carbs' => 31,
                'active' => true,
                'image' => 'images\\Steak And Veg.webp',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'name' => 'Zesty fish W/ Veg',
                'description' => 'Steamed white fish with a mango sauce. Served with rice and vegetables.',
                'price' => 11.95,
                'quantity_in_stock' => 0,
                'calories' => 330,
                'protein' => 30,
                'fats' => 10,
                'carbs' => 28,
                'active' => true,
                'image' => 'images\\Zesty Fish W Sweet Potato.webp',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'name' => 'Creamy mushroom chicken pasta',
                'description' => 'High protein pasta with grilled chicken and pesto.',
                'price' => 11.95,
                'quantity_in_stock' => 0,
                'calories' => 479,
                'protein' => 42,
                'fats' => 16,
                'carbs' => 41,
                'active' => true,
                'image' => 'images\\Pesto Chicken Pasta.webp',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'name' => 'Satay Chicken',
                'description' => 'Poached in spices and coconut with a generous serve of steamed vegetables.',
                'price' => 11.95,
                'quantity_in_stock' => 0,
                'calories' => 498,
                'protein' => 39,
                'fats' => 13,
                'carbs' => 55,
                'active' => true,
                'image' => 'images\\Satay Chicken & Rice And Beans.webp',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'name' => 'Perri Perri Chicken',
                'description' => 'Spiced chicken served with sweet potato mash and green beans.',
                'price' => 11.95,
                'quantity_in_stock' => 0,
                'calories' => 422,
                'protein' => 37,
                'fats' => 12,
                'carbs' => 38,
                'active' => true,
                'image' => 'images\\Perri Perri Chicken.webp',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'name' => 'Penne Bolognese',
                'description' => 'High protien pasta in Bolognese sauce.',
                'price' => 11.95,
                'quantity_in_stock' => 0,
                'calories' => 508,
                'protein' => 36,
                'fats' => 16,
                'carbs' => 52,
                'active' => true,
                'image' => 'images\\Penne Bolognese.webp',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'name' => 'Chilli Beef with Carne',
                'description' => 'Mexican braised beef with mild chilli and sauteed rice.',
                'price' => 11.95,
                'quantity_in_stock' => 0,
                'calories' => 519,
                'protein' => 37,
                'fats' => 17,
                'carbs' => 52,
                'active' => true,
                'image' => '/images/ChilliBeefWithCarne.webp',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
            [
                'name' => 'Butter Chicken',
                'description' => 'Aromatic Chicken, steamed Basmatti rice and green beans.',
                'price' => 11.95,
                'quantity_in_stock' => 0,
                'calories' => 486,
                'protein' => 37,
                'fats' => 13,
                'carbs' => 55,
                'active' => true,
                'image' => '/images/Butter Chicken & Rice And Beans2.webp',
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ],
        ]);
    }
}
