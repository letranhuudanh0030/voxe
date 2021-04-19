<?php

use App\Product;
use App\Size;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();
        
        factory(Product::class, 150)->create()->each(function($product){
            $sizes = Size::where('publish', 1)->get();
            $product->size()->attach(
                $sizes->random(rand(1,17))->pluck('id')->toArray()
            );
        }); 
    }
}
