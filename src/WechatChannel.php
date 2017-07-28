<?php

namespace ExcitedCat\WechatNotification;

use EasyWeChat\Core\Exceptions\HttpException;
use Illuminate\Notifications\Notification;
use Log;

class WechatChannel
{
    public function __construct()
    {
        $this->app = app('wechat');
    }

    /**
     * Send the given notification.
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     */
    public function send($notifiable, Notification $notification)
    {
        $openid = $notifiable->routeNotificationFor('Wechat');

        if (!$openid || strlen($openid) < 20) {
            return null;
        }

        $message = $notification->toWechat($notifiable);
        $message['openid'] = $openid;

        $data = $message['data'];
        $templateId = $message['templateId'];
        $url = $message['url'];

        try {
            $result = $this->app->notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($openid)->send();
            return $result;
        } catch (HttpException $e) {
            return (object)[
                'errcode' => $e->getCode(),
                'errmsg'  => $e->getMessage()
            ];
        }
    }
}
