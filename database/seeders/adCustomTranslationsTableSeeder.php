<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Basic\Entities\CustomTranslation;
use Modules\Basic\Service\CustomTranslationService;

class adCustomTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $custom = [
            ['key' => 'ad', 'value' => 'Ad'],
            ['key' => 'freelancer_ad_count', 'value' => 'freelancer in ads count can accept'],
            ['key' => 'you_have_many_ad', 'value' => 'you have many ad places call admin'],
            ['key' => 'cant_edit', 'value' => 'can\'t edit this'],
            ['key' => 'Index_new', 'value' => 'Index new'],
            ['key' => 'Index_active', 'value' => 'Index active'],
            ['key' => 'Index_cansel', 'value' => 'Index cansel'],
            ['key' => 'Index_unapprove', 'value' => 'Index un approve'],
            ['key' => 'Index_timeout', 'value' => 'Index time out'],
            ['key' => 'Index_open', 'value' => 'Index open'],
            ['key' => 'Minute', 'value' => 'Minute'],
            ['key' => 'Hour', 'value' => 'Hour'],
            ['key' => 'Day', 'value' => 'Day'],
            ['key' => 'new', 'value' => 'new'],
            ['key' => 'active', 'value' => 'active'],
            ['key' => 'inprocess', 'value' => 'in process'],
            ['key' => 'open', 'value' => 'open'],
            ['key' => 'timeout', 'value' => 'time out'],
            ['key' => 'done', 'value' => 'done'],
            ['key' => 'cansel', 'value' => 'cansel'],
            ['key' => 'comment', 'value' => 'comment'],
            ['key' => 'unapprove', 'value' => 'un approve'],
            ['key' => 'cansel_Done', 'value' => 'cansel Done'],
            ['key' => 'show', 'value' => 'show'],
            ['key' => 'document', 'value' => 'document'],
            ['key' => 'approved_at', 'value' => 'approved at'],
            ['key' => 'type_work', 'value' => 'type work'],
            ['key' => 'time_out_ad', 'value' => 'time out for ad by hours'],
            ['key' => 'only_freelancer', 'value' => 'only freelancer or company make ad'],
            ['key' => 'back', 'value' => 'back'],
            ['key' => 'Index_timeout', 'value' => 'Index time out'],
            ['key' => 'videos_ad_count', 'value' => 'videos ad count'],
            ['key' => 'images_ad_count', 'value' => 'images ad count'],
            ['key' => 'images_validation', 'value' => 'images must be min :count'],
            ['key' => 'videos_validation', 'value' => 'videos must be min :count'],
            ['key' => 'user_create', 'value' => 'user create'],
            ['key' => 'unactive', 'value' => 'unactive'],
            ['key' => 'un_active', 'value' => 'unactive'],

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
