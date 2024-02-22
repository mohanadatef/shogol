<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\CoreData\Entities\Level;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $level = [
            [
                'order' => 1,
                'level' => 1,
                'name' => 'ضعيف جدا',
            ],
            [
                'order' => 2,
                'level' => 2,
                'name' => 'ضعيف',
            ],
            [
                'order' => 3,
                'level' => 3,
                'name' => 'جيد',
            ],
            [
                'order' => 4,
                'level' => 4,
                'name' => 'جيد جدا',
            ],
            [
                'order' => 5,
                'level' => 5,
                'name' => 'ممتاز',
            ],
        ];
        foreach ($level as $value) {
            $data = Level::create(['order'=>$value['order'],'level'=>$value['level']]);
            foreach (language() as $lang) {
                $data->translation()->create(['key' => 'name', 'value' => $value['name'], 'language_id' => $lang->id]);
            }
        }
    }
}
