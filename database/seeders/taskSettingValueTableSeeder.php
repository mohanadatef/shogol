<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Setting\Entities\Setting;
use Modules\Setting\Service\SettingService;

class taskSettingValueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $setting = [
            ['key' => 'category_task_count_required','value'=>0],
            ['key' => 'client_task_count','value'=>0],
            ['key' => 'freelancer_task_count','value'=>0],
            ['key' => 'time_out_task','value'=>0],
            ['key' => 'videos_task_count','value'=>0],
            ['key' => 'images_task_count','value'=>0],
        ];
        foreach ($setting as $value) {
            $data = app()->make(SettingService::class)->findBy(new Request(['key'=> strtolower($value['key'])]),'count');
            if ($data == 0) {
                Setting::create($value);
            }
        }
    }
}
