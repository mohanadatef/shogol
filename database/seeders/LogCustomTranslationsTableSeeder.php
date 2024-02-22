<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Basic\Entities\CustomTranslation;
use Modules\Basic\Service\CustomTranslationService;

class LogCustomTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $custom = [
            ['key' => 'log', 'value' => 'log'],
            ['key' => 'action', 'value' => 'action'],
            ['key' => 'url', 'value' => 'url'],
            ['key' => 'comment', 'value' => 'comment'],
            ['key' => 'done_by', 'value' => 'done_by'],
            ['key' => 'affected', 'value' => 'affected'],
            ['key' => 'visitor', 'value' => 'visitor'],
            ['key' => 'view', 'value' => 'view'],
            ['key' => 'create', 'value' => 'create'],
            ['key' => 'update', 'value' => 'update'],
            ['key' => 'generate code', 'value' => 'generate code'],
            ['key' => 'reset password', 'value' => 'reset password'],
            ['key' => 'change status', 'value' => 'change status'],
            ['key' => 'convert', 'value' => 'convert'],
            ['key' => 'login', 'value' => 'login'],
            ['key' => 'logout', 'value' => 'logout'],
            ['key' => 'approve', 'value' => 'approve'],
            ['key' => 'un approve', 'value' => 'un approve'],
            ['key' => 'verified', 'value' => 'verified'],
            ['key' => 'delete', 'value' => 'delete'],
            ['key' => 'problem', 'value' => 'problem'],
            ['key' => 'cansel', 'value' => 'cansel'],
            ['key' => 'search_log', 'value' => 'Search Log'],
            ['key' => 'search', 'value' => 'Search'],

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
