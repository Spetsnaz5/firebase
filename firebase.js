import { initializeApp } from 'https://www.gstatic.com/firebasejs/11.6.0/firebase-app.js'
import { getMessaging, onMessage, getToken } from 'https://www.gstatic.com/firebasejs/11.6.0/firebase-messaging.js'

// TODO: 使用你的 Firebase 配置來替換以下內容
const firebaseConfig = {
    apiKey: "",
    authDomain: "",
    projectId: "",
    storageBucket: "",
    messagingSenderId: "",
    appId: "",
    measurementId: ""
};

// 初始化 Firebase
const app = initializeApp(firebaseConfig);

// Initialize Firebase Cloud Messaging and get a reference to the service
const messaging = getMessaging();

//網路推播憑證
//Firebase 雲端通訊可以使用「應用程式識別」金鑰組來連結外部推播服務
const vapidKey = '';

navigator.serviceWorker.register('firebase-messaging-sw.js')
    .then(registration => {
        console.log('✅ SW 已註冊');

        Notification.requestPermission().then(permission => {

            console.log(permission);

            if (permission === 'granted') {
                getToken(messaging, {
                    vapidKey,
                    serviceWorkerRegistration: registration,
                }).then(token => {
                    console.log('🎯 取得 token:', token);

                    // 這邊可以傳 token 到後端，讓 PHP 幫你訂閱 topic
                });
            }
        });
    });

// 前景訊息
onMessage(messaging, payload => {
    console.log('📩 前景訊息:', payload);
    const { title, body } = payload.notification;
    new Notification(title, { body });
});




