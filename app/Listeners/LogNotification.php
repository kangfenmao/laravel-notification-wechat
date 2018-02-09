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

            Log::warning('openid不能为空', $this->object2array($event->notifiable));
        }

        if ($event->response->errcode == 0) {
            // on success
        } else {
            // on error
        }
    }

    public function object2array($object)
    {
        $array = array();
        if (is_object($object)) {
            foreach ($object as $key => $value) {
                $array[$key] = $value;
            }
        } else {
            $array = $object;
        }
        return $array;
    }
}
