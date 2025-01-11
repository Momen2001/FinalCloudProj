<?php

namespace App\Services;


use App\Models\Notification;
use App\Models\User;

class DashboardNotifications
{
    public static function NotificationOrder($notificationId)
    {
        $notification = Notification::query()->find($notificationId);

        if ($notification->platform == 'topic') {
            push_topic_notification( $notification->translate('ar')->title, $notification->translate('ar')->body,"topic", $notification->checkImageToNotification());
        } elseif ($notification->platform == 'android') {
            $users = User::query()->where('platform', 'android')->get();
            foreach ($users as $user) {
                push_notification_order($user, $notification->translate('ar')->title, $notification->translate('ar')->body, 'android', '', null, null, $notification->checkImageToNotification());
            }
        } elseif ($notification->platform == 'ios') {
            $users = User::query()->where('platform', 'ios')->get();
            foreach ($users as $user) {
                push_notification_order($user, $notification->translate('ar')->title, $notification->translate('ar')->body, 'ios', '', null, null, $notification->checkImageToNotification());
            }
        } else {
            $users = User::query()->whereIn('platform', ['ios', 'android'])->get();
            foreach ($users as $user) {
                push_notification_order($user, $notification->translate('ar')->title, $notification->translate('ar')->body, 'all', '', null, null, $notification->checkImageToNotification());
            }
        }
    }
}









