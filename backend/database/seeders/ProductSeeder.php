<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for( $i=0;$i<200;$i++){
            Product::create([
                "nama_product"=>$faker->company(),
                "harga"=>$faker->numberBetween(100000,150000)
            ]);
        }
    }
}
