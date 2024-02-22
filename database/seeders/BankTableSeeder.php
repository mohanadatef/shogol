<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\CoreData\Entities\Bank;

class BankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bank = [
            [
                'order' => 0,
                'name' => 'مصرف الراجحي',
            ],
        ];
        foreach ($bank as $value) {
            $data = Bank::create(['order'=>$value['order']]);
            foreach (language() as $lang) {
                $data->translation()->create(['key' => 'name', 'value' => $value['name'], 'language_id' => $lang->id]);
            }
        }
    }
}
