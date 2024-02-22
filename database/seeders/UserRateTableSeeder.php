<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserRateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::whereNull('rate')->update(['rate'=>0]);
        User::whereNull('rate_count')->update(['rate_count'=>0]);
    }
}
