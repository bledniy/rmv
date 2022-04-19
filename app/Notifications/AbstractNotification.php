<?php


namespace App\Notifications;

use App\Http\Resources\NotificationResource;
use App\Notifications\Chat\UnreadChatMessageNotification;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notification;

abstract class AbstractNotification extends Notification
{

    protected $browserPopup = false;

    protected $mail = false;

    protected $broadcast = true;

    protected $database = true;

    public function via($notifiable)
    {
        $via = [];
        if ($this->database) {
            $via[] = 'database';
        }
        if ($this->broadcast) {
            $via[] = 'broadcast';
        }
        if ($this->mail) {
            $via[] = 'mail';
        }

        return $via;
    }

    public function enableViaMail()
    {
        $this->mail = true;

        return $this;
    }

    public function disableViaMail()
    {
        $this->mail = false;

        return $this;
    }

    public function enableViaBroadcast()
    {
        $this->broadcast = true;

        return $this;
    }

    public function disableViaBroadcast()
    {
        $this->broadcast = false;

        return $this;
    }

    public function enableViaDatabase()
    {
        $this->database = true;

        return $this;
    }

    public function disableViaDatabase()
    {
        $this->database = false;

        return $this;
    }

    public function setBrowserPopup(bool $browserPopup)
    {
        $this->browserPopup = $browserPopup;

        return $this;
    }

    public function toBroadcast($notifiable)
    {
        $notification = new DatabaseNotification([
            'id' => $this->id,
            'read_at' => null,
            'created_at' => (string)now(),
            'data' => $this->toArray($notifiable),
        ]);

        return NotificationResource::make($notification)->toArray(app('request'));
    }
}