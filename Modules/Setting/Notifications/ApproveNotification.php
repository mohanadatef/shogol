<?php

namespace Modules\Setting\Notifications;

use App\Models\Order;
use Benwilkins\FCM\FcmMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class ApproveNotification extends Notification
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
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'fcm'];
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
        $message = new FcmMessage();
        $notification = [
            'title' =>  "There is user need to approve",
            'text'  =>  "user".$notifiable->id ."need to approve",
        ];
        $data = [
            'click_action' => "FLUTTER_NOTIFICATION_CLICK",
            'type'=>$this->type,
            'status' => 'done',
            'message' => $notification,
        ];
        if(count($notifiable->deviceTokens->pluck('device_token'))>0 && getValueSetting('is_send_notification')){
        $message =  $message->to($notifiable->deviceTokens->pluck('device_token'));
        }
        $message->content($notification)->data($data)->priority(FcmMessage::PRIORITY_HIGH);

         return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'user_id' => $notifiable->id,
            'status' => 'need to approve',
            'key'=>'approve'
        ];
    }
}
