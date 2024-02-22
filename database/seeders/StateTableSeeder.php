<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\CoreData\Entities\State;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $state = [
            //state
            [
                "order" => 1,
                "name" => "منطقه الرياض",
                "country_id" => 1,
                "city_id" => 1
            ],
            [
                "order" => 2,
                "name" => "منطقه الدوادمى",
                "country_id" => 1,
                "city_id" => 1
            ],
            [
                "order" => 3,
                "name" => "منطقه الخرج",
                "country_id" => 1,
                "city_id" => 1
            ],
            [
                "order" => 4,
                "name" => "منطقه الحريق",
                "country_id" => 1,
                "city_id" => 1
            ],
            [
                "order" => 5,
                "name" => "منطقه الزلفي",
                "country_id" => 1,
                "city_id" => 1
            ],
            [
                "order" => 6,
                "name" => "منطقه وادي الدواسر",
                "country_id" => 1,
                "city_id" => 1
            ],
            [
                "order" => 7,
                "name" => "منطقه المزاحمية",
                "country_id" => 1,
                "city_id" => 1
            ],
            [
                "order" => 8,
                "name" => "منطقه الدرعية",
                "country_id" => 1,
                "city_id" => 1
            ],
            [
                "order" => 9,
                "name" => "منطقه الأفلاج",
                "country_id" => 1,
                "city_id" => 1
            ],
            [
                "order" => 10,
                "name" => "منطقه شقراء",
                "country_id" => 1,
                "city_id" => 1
            ],
            [
                "order" => 11,
                "name" => "منطقه سدير",
                "country_id" => 1,
                "city_id" => 1
            ],
            [
                "order" => 12,
                "name" => "منطقه القويعية",
                "country_id" => 1,
                "city_id" => 1
            ],
            [
                "order" => 13,
                "name" => "منطقه ضرماء",
                "country_id" => 1,
                "city_id" => 1
            ],
            [
                "order" => 14,
                "name" => "منطقه حريملاء",
                "country_id" => 1,
                "city_id" => 1
            ],
            [
                "order" => 15,
                "name" => "منطقه المجمعة",
                "country_id" => 1,
                "city_id" => 1
            ],
            [
                "order" => 16,
                "name" => "منطقه السليل",
                "country_id" => 1,
                "city_id" => 1
            ],
            [
                "order" => 17,
                "name" => "منطقه ثادق",
                "country_id" => 1,
                "city_id" => 1
            ],
            [
                "order" => 18,
                "name" => "منطقه الغاط",
                "country_id" => 1,
                "city_id" => 1
            ],
            [
                "order" => 19,
                "name" => "منطقه حوطة بنى تميم",
                "country_id" => 1,
                "city_id" => 1
            ],
            [
                "order" => 20,
                "name" => "منطقه رماح",
                "country_id" => 1,
                "city_id" => 1
            ],
            [
                "order" => 21,
                "name" => "منطقه عفيف",
                "country_id" => 1,
                "city_id" => 1
            ]
        ];
        foreach ($state as $value) {
            $data = State::create(['order'=>$value['order'],'country_id'=>$value['country_id'],'city_id'=>$value['city_id']]);
            foreach (language() as $lang) {
                $data->translation()->create(['key' => 'name', 'value' => $value['name'], 'language_id' => $lang->id]);
            }
        }
    }
}
