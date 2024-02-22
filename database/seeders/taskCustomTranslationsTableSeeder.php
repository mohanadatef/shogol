<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Basic\Entities\CustomTranslation;
use Modules\Basic\Service\CustomTranslationService;

class taskCustomTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $custom = [
            ['key' => 'task', 'value' => 'Task'],
            ['key' => 'price', 'value' => 'price'],
            ['key' => 'time', 'value' => 'time'],
            ['key' => 'start_date', 'value' => 'start date'],
            ['key' => 'end_date', 'value' => 'end date'],
            ['key' => 'type_work', 'value' => 'type work'],
            ['key' => 'address', 'value' => 'address'],
            ['key' => 'freelancer', 'value' => 'freelancer'],
            ['key' => 'category_task_count_required', 'value' => 'category in task required'],
            ['key' => 'client_task_count', 'value' => 'client in task count can add'],
            ['key' => 'freelancer_task_count', 'value' => 'freelancer in task count can accept'],
            ['key' => 'Index_inprocesses', 'value' => 'Index in processes'],
            ['key' => 'Index_review', 'value' => 'Index review'],
            ['key' => 'Index_done', 'value' => 'Index done'],
            ['key' => 'you_have_many_task', 'value' => 'you have many task places call admin'],
            ['key' => 'Index_inprocess', 'value' => 'Index in process'],
            ['key' => 'Index_done', 'value' => 'Index done'],
            ['key' => 'Index_unapprovebyclient', 'value' => 'Index un approve by client'],
            ['key' => 'Index_unapprovebyfreelancer', 'value' => 'Index un approve by freelancer'],
            ['key' => 'time_out_task', 'value' => 'time out for task by hours'],
            ['key' => 'user_create', 'value' => 'user create'],
            ['key' => 'translation', 'value' => 'translation'],
            ['key' => 'location', 'value' => 'location'],
            ['key' => 'system_data', 'value' => 'system data'],
            ['key' => 'system', 'value' => 'system'],
            ['key' => 'videos_task_count', 'value' => 'videos task count'],
            ['key' => 'images_task_count', 'value' => 'images task count'],

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
