<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Task\Entities\Ad;

class AdPriceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ad::whereNull('price')->update(['price'=>0]);
    }
}
