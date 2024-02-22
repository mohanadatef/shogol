<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Task\Entities\Task;

class TaskPriceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::whereNull('price')->update(['price'=>0]);
    }
}
