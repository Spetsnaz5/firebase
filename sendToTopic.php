<?php

require __DIR__ . '/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Exception\MessagingException;

try {

    $contents = file_get_contents('php://input');

    if (json_validate($contents))
        $contents = json_decode($contents, true);

    $topic = $contents['topic'] ?? 'matchday';
    $title = $contents['title'] ?? '標題';
    $body = $contents['body'] ?? '內容';
    $attributes = $contents['attributes'] ?? [];

    $factory = (new Factory)->withServiceAccount('my-firebase-adminsdk.json');

    $messaging = $factory->createMessaging();

    // 推播至主題
    $message = CloudMessage::new()
        ->withNotification(Notification::create($title, $body))
        ->withData($attributes)
        ->toTopic($topic);

    $result = $messaging->send($message);

    dd($result);

} catch (MessagingException $e) {
    dd($e);
} catch (Exception $e) {
    dd($e);
}
