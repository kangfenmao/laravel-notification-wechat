# Laravel notifications for wechat

本项目可以在 Laravel 5.3中使用 [EasyWechat](https://easywechat.org/) 来通知客户。

## 安装说明

```bash
composer require excitedcat/laravel-notification-wechat
```

## 使用说明

编辑config/app.php文件在providers数组中增加：
```
ExcitedCat\WechatNotification\WechatServiceProvider::class
```

创建Notification
```bash
php artisan make:notification NewOrder
```

调用方式参考Laravel官方文档

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
