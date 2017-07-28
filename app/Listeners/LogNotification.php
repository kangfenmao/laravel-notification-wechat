<?php

namespace App\Listeners;

use App\Models\Message;
use Illuminate\Notifications\Events\NotificationSent;
use Log;

class LogNotification
{
    /**
     * Handle the event.
     *
     * @param  NotificationSent  $event
     * @return void
     */
    public function handle(NotificationSent $event)
    {
        // openid is null
        if ($event->response == null) {
            Log::warning('openid不能为空', $event->notifiable);
        }

        if ($event->response->errcode == 0) {
            // on success
        } else {
            // on error
        }
    }
}
