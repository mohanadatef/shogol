<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\CoreData\Entities\Status;

class statusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            [
                'order' => 1,
                'name' => 'جديد',
            ],
            [
                'order' => 2,
                'name' => 'مفتوح',
            ],
            [
                'order' => 3,
                'name' => 'فعال',
            ],
            [
                'order' => 4,
                'name' => 'جارى العمل عليها',
            ],
            [
                'order' => 5,
                'name' => 'اتنهاء',
            ],
            [
                'order' => 6,
                'name' => 'رفص من قبل العميل',
            ],
            [
                'order' => 7,
                'name' => 'الغاء',
            ],
            [
                'order' => 8,
                'name' => 'رفض',
            ],
            [
                'order' => 9,
                'name' => 'انتهاء الوقت',
            ],
            [
                'order' => 10,
                'name' => 'رفض من قبل المشتغل',
            ],
            [
                'order' => 11,
                'name' => 'تعديل العرض',
            ],
            [
                'order' => 12,
                'name' => 'انتهاء من قبل المشتغل',
            ],
            [
                'order' => 13,
                'name' => 'انتهاء من قبل النظام',
            ]
        ];
        foreach ($status as $value) {
            $data = Status::create(['order'=>$value['order']]);
            foreach (language() as $lang) {
                $data->translation()->create(['key' => 'name', 'value' => $value['name'], 'language_id' => $lang->id]);
            }
        }
    }
}
