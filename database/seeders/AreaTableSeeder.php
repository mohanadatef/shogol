<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\CoreData\Entities\Area;

class AreaTableSeeder extends Seeder
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
                'name' => 'الرياض',
                "country_id" => 1,
                "city_id" => 1,
                "state_id" => 1
            ],
        ];
        foreach ($country as $value) {
            $data = Area::create(['order'=>$value['order'],'country_id'=>$value['country_id'],'state_id'=>$value['state_id'],'city_id'=>$value['city_id']]);
            foreach (language() as $lang) {
                $data->translation()->create(['key' => 'name', 'value' => $value['name'], 'language_id' => $lang->id]);
            }
        }
    }
}
