<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Basic\Entities\CustomTranslation;
use Modules\Basic\Service\CustomTranslationService;

class settingCustomTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $custom = [
            ['key' => 'setting', 'value' => 'Setting'],
            ['key' => 'mail_configHost', 'value' => 'mail config Host'],
            ['key' => 'mail_config_port', 'value' =>'mail config port'],
            ['key' => 'mail_config_encryption', 'value' =>'mail config encryption'],
            ['key' => 'mail_config_address', 'value' =>'mail config address'],
            ['key' => 'mail_config_password', 'value' =>'mail config password'],
            ['key' => 'skill_count_required', 'value' =>'skill count required'],
            ['key' => 'performers_profile_open', 'value' =>'performers profile open'],
            ['key' => 'verify_mail_link', 'value' =>'verify mail link'],
            ['key' => 'accept_mail_link', 'value' =>"accept mail link"],
            ['key' => 'reject_mail_link', 'value' =>"reject mail link"],
            ['key' => 'swear', 'value' =>"swear"],
            ['key' => 'facebook','value'=>'facebook'],
            ['key' => 'youtube','value'=>'youtube'],
            ['key' => 'linkedIn','value'=>'linkedIn'],
            ['key' => 'ios','value'=>'ios'],
            ['key' => 'android','value'=>'android'],
            ['key' => 'links','value'=>'links'],
            ['key' => 'main','value'=>'main'],
            ['key' => 'manage_profile','value'=>'manage profile'],
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
