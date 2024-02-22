<?php

namespace Modules\Setting\Notifications;

use Benwilkins\FCM\FcmMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Modules\Setting\Service\NotificationService;
use Illuminate\Http\Request;
use Modules\Setting\Entities\Notification as ModelNotification;

class pushNotification extends Notification
{
    use Queueable;

    /**
     * @var USER
     */
    private $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($type, $data ,$request)
    {
        $this->type = $type;
        $this->data = $data;
        $this->request = $request;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['fcm'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toFcm($notifiable)
    {
        try{
        $message = new FcmMessage();
        $notification = [
            'title' =>  $this->request->title,
            'description'  =>  $this->request->description,
        ];
        $data = [
            'notifiable_type' => 'system',
            'notifiable_id' => user()->id,
            'type' => $this->type,
            'receiver_id' => $notifiable->id,
            'pusher_id' => user()->id,
        ];
        $data = new Request(array_merge($data, $notification));
            app()->make(NotificationService::class)->store($data);
            if (count($notifiable->deviceTokens->pluck('device_token')) > 0 && getValueSetting('is_send_notification') && getValueSetting('fcm_secret_key')) {
            $message =  $message->to($notifiable->deviceTokens->pluck('device_token')->toArray());
        }
        $message->content($notification)->priority(FcmMessage::PRIORITY_HIGH);
        return $message;
        }catch(\Exception $e){
            ErrorLog($data->notifiable_type.'_'.'notification',$e->getMessage(),$notification->fullname);
        }
    }
}
