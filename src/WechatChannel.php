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
            return;
        }

        $message = $notification->toWechat($notifiable);
        $message['openid'] = $openid;

        $data = $message['data'];
        $templateId = $message['templateId'];
        $url = $message['url'];

        try {
            $this->app->notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($openid)->send();
            if(isset($message['onSuccess']) && is_callable($message['onSuccess'])) {
                $message['onSuccess']();
            }
        } catch (HttpException $e) {
            if(isset($message['onFailure']) && is_callable($message['onSuccess'])) {
                $message['onFailure']();
            }
            Log::error('消息发送失败！', $message);
        }
    }
}
