<?php

namespace Modules\Setting\Notifications;

use Benwilkins\FCM\FcmMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
use Modules\Acl\Events\NotificationEmailEvent;
use Modules\Setting\Service\NotificationService;
use Illuminate\Http\Request;

class SystemNotification extends Notification
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
    public function __construct($type, $data, $model)
    {
        $this->type = $type;
        $this->data = $data;
        $this->model = $model;
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
        try
        {
            $message = new FcmMessage();
            $description = $title = [];
            foreach(language() as $lang)
            {
                $title += [$lang->code => getCustomTranslation('title_' . $this->type) ?? $this->type];
                $description += [$lang->code => str_replace([':id', '=>id'], $this->data->name ?? "",
                    getCustomTranslation('description_' . $this->type) ?? $this->type)];
            }
            $notification = [
                'title' => $title,
                'description' => $description,
            ];
            $notificationContent = [
                'title' => $notification['title'][$notifiable->lang],
                'description' => $notification['description'][$notifiable->lang],
            ];
            $data = [
                'notifiable_type' => $this->model,
                'notifiable_id' => $this->data->id,
                'type' => $this->type,
                'receiver_id' => $notifiable->id,
            ];
            $data = new Request(array_merge($data, $notification));
            app()->make(NotificationService::class)->store($data);
            if($notifiable->email_verified_at)
            {
                event(new NotificationEmailEvent($notifiable, $notificationContent));
            }
            if(count($notifiable->deviceTokens->pluck('device_token')) > 0 && getValueSetting('is_send_notification') && getValueSetting('fcm_secret_key'))
            {
                $message = $message->to($notifiable->deviceTokens->pluck('device_token')->toArray());
            }
            $message->content($notificationContent)->priority(FcmMessage::PRIORITY_HIGH);
            return $message;
        }catch(\Exception $e)
        {
            ErrorLog($this->model . '_' . 'notification', $e->getMessage());
            return $e->getMessage();
        }
    }
}
