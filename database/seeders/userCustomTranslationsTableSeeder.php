<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Basic\Entities\CustomTranslation;
use Modules\Basic\Service\CustomTranslationService;

class userCustomTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $custom = [
            ['key' => 'company', 'value' => 'company'],
            ['key' => 'job_name_id', 'value' => 'job name'],
            ['key' => 'job_name', 'value' => 'job name'],
            ['key' => 'tax_number', 'value' => 'tax number'],
            ['key' => 'nationality_number', 'value' => 'nationality number'],
            ['key' => 'email_verified_at', 'value' => 'email verified at'],
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
