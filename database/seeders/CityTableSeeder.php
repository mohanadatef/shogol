<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\CoreData\Entities\City;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = [
            [
                "order" => 1,
                "name" => "الرياض",
                "country_id" => 1
            ],
            [
                "order" => 2,
                "name" => "الدوادمى",
                "country_id" => 1
            ],
            [
                "order" => 3,
                "name" => "الخرج",
                "country_id" => 1
            ],
            [
                "order" => 4,
                "name" => "الحريق",
                "country_id" => 1
            ],
            [
                "order" => 5,
                "name" => "الزلفي",
                "country_id" => 1
            ],
            [
                "order" => 6,
                "name" => "وادي الدواسر",
                "country_id" => 1
            ],
            [
                "order" => 7,
                "name" => "المزاحمية",
                "country_id" => 1
            ],
            [
                "order" => 8,
                "name" => "الدرعية",
                "country_id" => 1
            ],
            [
                "order" => 9,
                "name" => "الأفلاج",
                "country_id" => 1
            ],
            [
                "order" => 10,
                "name" => "شقراء",
                "country_id" => 1
            ],
            [
                "order" => 11,
                "name" => "سدير",
                "country_id" => 1
            ],
            [
                "order" => 12,
                "name" => "القويعية",
                "country_id" => 1
            ],
            [
                "order" => 13,
                "name" => "ضرماء",
                "country_id" => 1
            ],
            [
                "order" => 14,
                "name" => "حريملاء",
                "country_id" => 1
            ],
            [
                "order" => 15,
                "name" => "المجمعة",
                "country_id" => 1
            ],
            [
                "order" => 16,
                "name" => "السليل",
                "country_id" => 1
            ],
            [
                "order" => 17,
                "name" => "ثادق",
                "country_id" => 1
            ],
            [
                "order" => 18,
                "name" => "الغاط",
                "country_id" => 1
            ],
            [
                "order" => 19,
                "name" => "حوطة بنى تميم",
                "country_id" => 1
            ],
            [
                "order" => 20,
                "name" => "رماح",
                "country_id" => 1
            ],
            [
                "order" => 21,
                "name" => "عفيف",
                "country_id" => 1
            ]
        ];

        foreach ($city as $value) {
            $data = City::create(['order' => $value['order'], 'country_id' => $value['country_id']]);
            foreach (language() as $lang) {
                $data->translation()->create(['key' => 'name', 'value' => $value['name'], 'language_id' => $lang->id]);
            }
        }
    }
}
