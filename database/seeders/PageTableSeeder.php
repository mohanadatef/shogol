<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Setting\Entities\Page;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page = [
            [
                'order' => 0,
                'name' => 'about us',
                'description' => '<p class="m-0 cLT-secondary-text fLT-Bold-sC" style="height: auto; padding: 0px; font-family: Cairo-Bold; font-size: 30px; color: rgb(30, 170, 173); text-align: right; background-color: rgb(248, 250, 252);">:معلومات</p><p class="m-0 cLT-main-text fLT-Bold-sD" style="height: auto; padding: 0px; font-family: Cairo-Bold; font-size: 42px; color: rgb(2, 56, 90); text-align: right; background-color: rgb(248, 250, 252);">نحن نفضل ان نسمع منك؟</p>',
            ],
            [
                'order' => 1,
                'name' => 'شروط و الاحكام',
                'description' => '',
            ],
        ];
        foreach ($page as $value) {
            $data = Page::create(['order'=>$value['order']]);
            foreach (language() as $lang) {
                $data->translation()->create(['key' => 'name', 'value' => $value['name'], 'language_id' => $lang->id]);
                $data->translation()->create(['key' => 'description', 'value' => $value['description'], 'language_id' => $lang->id]);
            }
        }
    }
}
