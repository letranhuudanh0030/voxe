<?php

use App\RealEstate;
use Illuminate\Database\Seeder;

class RealEstateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(RealEstate::class, 10)->create();
    }
}
