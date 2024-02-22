<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Setting\Entities\Setting;
use Modules\Setting\Service\SettingService;

class NotificationSettingValueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $setting = [
            ['key' => 'fcm_secret_key','value'=>'AAAADJ5r8aM:APA91bGdusieUBHRV-kJXJ_kt9uYVmbzLmnE-25IdhaEnWuSYHzfM0wBpkBiLlrWs_YCNq7u1AUbMOL7I0yYtqNBtxSHynKT9QtoRBmM46KwR1l6GDtBD0ZLUuGerWGswdfRB0kydH1N'],
            ['key' => 'firebase_api_key','value'=>"AIzaSyDja2zWvbfTmICZxk7OTfzjlTDo8qUJrmY"],
            ['key' => 'firebase_auth_domain','value'=>"shogol-cfeac.firebaseapp.com"],
            ['key' => 'firebase_database_url','value'=>""],
            ['key' => 'firebase_project_id','value'=>"shogol-cfeac"],
            ['key' => 'firebase_storage_bucket','value'=>"shogol-cfeac.appspot.com"],
            ['key' => 'firebase_messaging_sender_id','value'=>"54197481891"],
            ['key' => 'firebase_app_id','value'=>"1:54197481891:web:74481944c102a8073b2a16"],
            ['key' => 'firebase_measurement_id','value'=>"G-CXGHZ9B6VV"],
            ['key' => 'is_send_notification','value'=>0],
        ];
        foreach ($setting as $value) {
            $data = app()->make(SettingService::class)->findBy(new Request(['key'=> strtolower($value['key'])]),'count');
           if ($data == 0){
                 Setting::create($value);
            }
        }
    }
}
