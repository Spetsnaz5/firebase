## 需求
php version 8.3

## firebase.js
修改 firebaseConfig、vapidKey，參數由 firebase console 取得

## firebase-messaging-sw
修改 firebaseConfig，參數由 firebase console 取得

## Curl 推播訊息
```
curl --location 'https://fcm.googleapis.com/v1/projects/<YOUR-PROJECT-ID>/messages:send' \
--header 'Content-Type: application/json' \
--header 'Authorization: <YOUR-ACCESS-TOKEN>' \
--data '{
    "message": {
        "token": "<CLIENT_TOKEN>",
        "notification": {
            "title": "Background Message Title",
            "body": "Background message body"
        },
        "webpush": {
            "fcm_options": {
                "link": "https://dummypage.com"
            }
        }
    }
}'
```
```
接收訊息 http://127.0.0.1/receive.html ，使用 localhost 會收不到訊息

<YOUR-PROJECT-ID> firebase console 取得

<YOUR-ACCESS-TOKEN> POSTMAN 登入 Google 授權 firebase

<CLIENT_TOKEN> 由 receive.html 取得 firebase.js token
```

## send.php 推播訊息
firebase console 產生密鑰 adminsdk json 修改名稱 => my-firebase-adminsdk.json

token 由 receive.html 取得 firebase.js token
