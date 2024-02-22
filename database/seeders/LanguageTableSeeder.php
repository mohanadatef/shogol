<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\CoreData\Entities\Language;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create(
            [
                'name' => 'العربية',
                'code' => 'ar',
                'order' => 1,
                'status' => 1,
            ]
        );
    }
}
