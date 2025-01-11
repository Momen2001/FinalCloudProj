<?php

namespace App\Services;


use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FirebaseService
{
    protected $messaging;

    public function __construct()
    {
        $serviceAccountPath = storage_path('hakeem-application-1ebaa9b3fe6d.json');
        $factory = (new Factory())->withServiceAccount($serviceAccountPath);
        $this->messaging = $factory->createMessaging();
    }

    public static function sendNotification($token, $title, $body, $imageUrl = null, $data = [])
    {
        $messaging = app('firebase.messaging');

        // Prepare the notification payload
        $notificationPayload = [
            'title' => $title,
            'body' => $body,
        ];

        if ($imageUrl) {
            $notificationPayload['image'] = $imageUrl; // Add the image URL
        }

        // Construct the CloudMessage
        $messagePayload = [
            'token' => $token,
            'notification' => $notificationPayload,
            'data' => array_merge([
                'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
            ], $data),
        ];

        $message = CloudMessage::fromArray($messagePayload);

        // Send the message
        $messaging->send($message);
    }

    public static function sendTopicNotification($topicName, $title, $body, $imageUrl = null, $data = [])
    {
        $messaging = app('firebase.messaging');

        // Prepare the notification payload
        $notificationPayload = [
            'title' => $title,
            'body' => $body,
        ];

        if ($imageUrl) {
            $notificationPayload['image'] = $imageUrl; // Add the image URL
        }

        // Construct the CloudMessage

        $messagePayload = [
            'topic' => $topicName, // Specify the topic name
            'notification' => $notificationPayload,
            'data' => array_merge([
                'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
            ], $data),
        ];


        $message = CloudMessage::fromArray($messagePayload);

        // Send the message
        $messaging->send($message);
    }

}
