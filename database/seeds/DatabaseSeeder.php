<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $this->call(ArticleCategoryTableSeeder::class);
        // $this->call(ArticleTableSeeder::class);
        // $this->call(BrandTableSeeder::class);
        // $this->call(ProductCategoryTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        // $this->call(ConfigContactTableSeeder::class);
        // $this->call(RealEstateTableSeeder::class);

    }
}
