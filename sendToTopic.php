<?php

require __DIR__ . '/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Exception\MessagingException;

try {

    $topic = 'matchday';

    $factory = (new Factory)->withServiceAccount('my-firebase-adminsdk.json');

    $messaging = $factory->createMessaging();

    // 推播至主題
    $message = CloudMessage::new()
        ->withNotification(Notification::create('Title2', 'Body2'))
        ->withData(['key' => 'value', 'key2' => 'value', 'key3' => 'value'])
        ->toTopic($topic);

    $result = $messaging->send($message);

    dd($result);

} catch (MessagingException $e) {
    dd($e);
} catch (Exception $e) {
    dd($e);
}
