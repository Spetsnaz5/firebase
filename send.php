<?php

require __DIR__ . '/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Exception\MessagingException;

try {

    $token = $_REQUEST['token'] ?? null;

    if (is_null($token))
        throw new Exception('無定義 token');

    $contents = file_get_contents('php://input');

    if (json_validate($contents))
        $contents = json_decode($contents, true);

    $title = $contents['title'] ?? '標題';
    $body = $contents['body'] ?? '內容';
    $attributes = $contents['attributes'] ?? [];

    $factory = (new Factory)->withServiceAccount('my-firebase-adminsdk.json');

    $messaging = $factory->createMessaging();

    $message = CloudMessage::new()
                    ->withNotification(Notification::create($title, $body))
                    ->withData($attributes)
                    ->toToken($token);

    $result = $messaging->send($message);

    dd($result, $token, $contents);

} catch (MessagingException $e) {
    dd($e);
} catch (Exception $e) {
    dd($e);
} catch (Throwable $e) {
    dd($e);
}
