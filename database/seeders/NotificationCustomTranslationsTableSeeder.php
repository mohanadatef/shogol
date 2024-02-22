<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Basic\Entities\CustomTranslation;
use Modules\Basic\Service\CustomTranslationService;

class NotificationCustomTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $custom = [
            ['key' => 'Notification', 'value' => 'Notification'],
            ['key' => 'pusher_id', 'value' => 'pusher_id'],
            ['key' => 'receiver_id', 'value' => 'receiver_id'],
            ['key' => 'FCM_SECRET_KEY','value'=>'FCM SECRET KEY'],
            ['key' => 'firebase_api_key','value'=>'firebase api key'],
            ['key' => 'firebase_auth_domain','value'=>'firebase auth domain'],
            ['key' => 'firebase_database_url','value'=>'firebase database url'],
            ['key' => 'firebase_project_id','value'=>'firebase project id'],
            ['key' => 'firebase_storage_bucket','value'=>'firebase storage bucket'],
            ['key' => 'firebase_messaging_sender_id','value'=>'firebase messaging sender id'],
            ['key' => 'firebase_app_id','value'=>'firebase app id'],
            ['key' => 'firebase_measurement_id','value'=>'firebase measurement id'],
            ['key' => 'is_send_notification','value'=>'is send notification'],
            ['key' => 'title_approved_user','value'=>'There is user need to approve'],
            ['key' => 'description_approved_user','value'=>'user :id need to approve'],
            ['key' => 'read','value'=>'read notification'],
            ['key' => 'title_timeout_Ads','value'=>'Ads Time out'],
            ['key' => 'description_timeout_Ads','value'=>'Ads :id Time out'],
            ['key' => 'title_cancel_Ads','value'=>'Ads canceled'],
            ['key' => 'description_cancel_Ads','value'=>'Ads :id canceled'],
            ['key' => 'title_create_Task','value'=>'there is task need to approve'],
            ['key' => 'description_create_Task','value'=>'task :id need approve'],
            ['key' => 'title_opened_Task','value'=>'task is opened'],
            ['key' => 'description_opened_Task','value'=>'task :id opened'],
            ['key' => 'title_time_out_Task','value'=>'task is time out'],
            ['key' => 'description_time_out_Task','value'=>'task :id time out'],
            ['key' => 'title_cancel_Task','value'=>'task is canceled'],
            ['key' => 'description_cancel_Task','value'=>'task :id canceled'],
            ['key' => 'title_reject_Task','value'=>'task is rejected'],
            ['key' => 'description_reject_Task','value'=>'task :id rejected'],
            ['key' => 'title_approve_Task','value'=>'task is approved'],
            ['key' => 'description_approve_Task','value'=>'task :id approved'],
            ['key' => 'notification_system','value'=>'notification system'],
            ['key' => 'push_notification','value'=>'push Notification'],
            ['key' => 'push','value'=>'push'],
            ['key' => 'Reset','value'=>'Reset'],
            ['key' => 'title_update_time_Task','value'=>'update time Task need to approve '],
            ['key' => 'description_update_time_Task','value'=>'task need to approve :id time updated'],
            ['key' => 'title_done_freelancer','value'=>'Done freelancer '],
            ['key' => 'description_done_freelancer','value'=>'task done  :id by freelancer'],
            ['key' => 'title_done_client','value'=>'task done place pay commission '],
            ['key' => 'description_done_client','value'=>'task :id done place pay commission'],
            ['key' => 'title_unApprove_freelancer','value'=>'this task un approve by freelancer '],
            ['key' => 'description_unApprove_freelancer','value'=>'task :id un approved by freelancer'],
            ['key' => 'title_offer_create','value'=>'new offer create'],
            ['key' => 'title_offer_edit','value'=>'offer edit'],
            ['key' => 'description_offer_create','value'=>' :id new offer create'],
            ['key' => 'description_offer_edit','value'=>' :id offer edit'],
            ['key' => 'title_offer_update','value'=>'new offer update'],
            ['key' => 'description_offer_update','value'=>' :id new offer update'],
            ['key' => 'title_offer_unApprove','value'=>' offer un Approve'],
            ['key' => 'description_offer_unApprove','value'=>'offer :id un Approve'],
            ['key' => 'title_offer_approve','value'=>' offer Approve'],
            ['key' => 'description_offer_approve','value'=>'offer :id Approve'],
            ['key' => 'title_offer_timeout','value'=>' this offer hidden'],
            ['key' => 'description_offer_timeout','value'=>'offer :id timeout'],
            ['key' => 'title_update_Task','value'=>'there is task updated'],
            ['key' => 'description_update_Task','value'=>'task :id updated'],
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
