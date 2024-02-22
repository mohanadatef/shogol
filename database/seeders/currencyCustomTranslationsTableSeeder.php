<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Basic\Entities\CustomTranslation;
use Modules\Basic\Service\CustomTranslationService;

class currencyCustomTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $custom = [
            ['key' => 'currency', 'value' => 'Currency'],
            ['key' => 'currency_id', 'value' => 'currency'],
        ];
        foreach ($custom as $value) {
            $data = app()->make(CustomTranslationService::class)->findBy(new Request(['key'=> strtolower($value['key'])]),false,10,'count');
            if ($data == 0) {
                $data = CustomTranslation::create(['key' => strtolower($value['key'])]);
                foreach (language() as $lang) {
                    $data->translation()->create(['key' => 'value', 'value' => $value['value'], 'language_id' => $lang->id]);
                }
            }
        }
    }
}
