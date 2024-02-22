<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Setting\Entities\Cancellation;

class CancellationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country = [
            [
                'order' => 0,
                'name' => 'العرض غير جاد',
            ],
            [
                'order' => 1,
                'name' => 'عرض السعر عالي',
            ],
            [
                'order' => 2,
                'name' => 'وجدت عرض افضل',
            ],
            [
                'order' => 3,
                'name' => 'لم يتم الاتفاق',
            ],
        ];
        foreach ($country as $value) {
            $data = Cancellation::create(['order'=>$value['order']]);
            foreach (language() as $lang) {
                $data->translation()->create(['key' => 'name', 'value' => $value['name'], 'language_id' => $lang->id]);
            }
        }
    }
}
