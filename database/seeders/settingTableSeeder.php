<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Setting\Entities\Setting;
use Modules\Setting\Service\SettingService;

class settingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = [
            ['key' => 'name','value'=>'shogol'],
            ['key' => 'logos'],
            ['key' => 'mail_configHost','value'=>'smtp.mailgun.org'],
            ['key' => 'mail_config_port','value'=>'587'],
            ['key' => 'mail_config_encryption','value'=>'tls'],
            ['key' => 'mail_config_address'],
            ['key' => 'mail_config_password'],
            ['key' => 'skill_count_required','value'=>0],
            ['key' => 'performers_profile_open','value'=>0],
            ['key' => 'verify_mail_link'],
            ['key' => 'accept_mail_link'],
            ['key' => 'reject_mail_link'],
            ['key' => 'Version','value'=>'1.0.0.0'],
            ['key' => 'swear','value'=>''],
            ['key' => 'facebook','value'=>''],
            ['key' => 'youtube','value'=>''],
            ['key' => 'linkedIn','value'=>''],
            ['key' => 'ios','value'=>''],
            ['key' => 'android','value'=>''],
            ['key' => 'snapchat','value'=>''],
            ['key' => 'instagram','value'=>''],
            ['key' => 'twitter','value'=>''],
        ];
        foreach ($setting as $value) {
            $data = app()->make(SettingService::class)->findBy(new Request(['key'=> strtolower($value['key'])]),'count');
            if ($data == 0) {
                $data = ['key'=>strtolower($value['key']),'value'=>$value['value']??""];
                Setting::create($data);
            }
        }
    }
}
