<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Basic\Entities\CustomTranslation;
use Modules\Basic\Service\CustomTranslationService;

class HomeCustomTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $custom = [
            ['key' => 'home_section_1_title','value'=>'title'],
            ['key' => 'home_section_1_image','value'=>'image'],
            ['key' => 'home_section_1_description','value'=>"description"],
            ['key' => 'home_section_1_link','value'=>"link"],
            ['key' => 'home_section_2_title','value'=>"title"],
            ['key' => 'home_section_2_description','value'=>"description"],
            ['key' => 'home_section_2_video_link','value'=>"video link"],
            ['key' => 'home_section_3_title','value'=>"title"],
            ['key' => 'home_section_3_image','value'=>"image"],
            ['key' => 'home_section_4_title','value'=>"title"],
            ['key' => 'home_section_4_url','value'=>"url"],
            ['key' => 'home_section_5_title','value'=>"title"],
            ['key' => 'home_section_5_image','value'=>"image"],
            ['key' => 'section_1','value'=>"section 1"],
            ['key' => 'section_2','value'=>"section 2"],
            ['key' => 'section_3','value'=>"section 3"],
            ['key' => 'section_4','value'=>"section 4"],
            ['key' => 'section_5','value'=>"section 5"],
            ['key' => 'home_main_category','value'=>"main category"],
            ['key' => 'home_category','value'=>"category"],

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
