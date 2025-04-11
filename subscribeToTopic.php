<?php

require __DIR__ . '/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\MessagingException;

try {

    $token = $_GET['token'] ?? null;

    if (is_null($token))
        throw new Exception('無定義 token');

    $factory = (new Factory)->withServiceAccount('my-firebase-adminsdk.json');

    $messaging = $factory->createMessaging();

    $registrationTokens = [
        $token
    ];

    $topic = 'matchday';

    # https://github.com/kreait/firebase-php/blob/7.x/docs/cloud-messaging.rst
    // 訂閱主題
    $result = $messaging->subscribeToTopic($topic, $registrationTokens);

    dd($result);

} catch (MessagingException $e) {
    dd($e);
} catch (Exception $e) {
    dd($e);
}
