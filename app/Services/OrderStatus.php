<?php

namespace App\Services;


class OrderStatus
{
    public static function status($status): array
    {
        $orderStatus = [
            'id' => $status
            , 'title' => OrderStatusByNumber()[$status]
            , 'color' => colorsOrderStatus()[$status]
        ];
        return $orderStatus;
    }


    public static function NotificationOrder($user, $title, $body, $order)
    {
        $dataRedirect = [
            'redirect_type' => "show_order",
            'order_id' => (integer)$order->id,
        ];
        send_notification($title, $body, $user, 'FLUTTER_NOTIFICATION_CLICK', null, $dataRedirect);
    }
}









