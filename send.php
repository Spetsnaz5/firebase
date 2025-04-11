<?php

require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Exception\MessagingException;


$factory = (new Factory)->withServiceAccount('my-firebase-adminsdk.json');

$messaging = $factory->createMessaging();

$token = '';

$message = CloudMessage::new()
                ->withNotification(Notification::create('Title', 'Body'))
                ->withData(['key' => 'value', 'key2' => 'value', 'key3' => 'value'])
                ->toToken($token)
                ;

try {
    
    $result = $messaging->send($message);
    // $result = ['name' => 'projects/<project-id>/messages/6810356097230477954']

    dd($result);

} catch (MessagingException $e) {
    dd($result);
}

