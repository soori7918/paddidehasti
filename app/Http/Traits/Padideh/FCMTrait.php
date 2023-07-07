<?php


namespace App\Http\Traits\Padideh;


trait FCMTrait
{

    public function sendMessage($title, $body, $token, $data = null)
    {
        $fcmUrl = env('FCM_URL');

        $notification = [
            'title' => $title,
            'body' => $body,
//            'sound' => true,
        ];

//        $extraNotificationData = [ "type"=>$extra];

        $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $data
        ];

        $headers = [
            'Authorization: key='.env('FCM_SERVER_KEY'),
            'Content-Type: application/json'
        ];

        // return $fcmNotification;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);
    }

    public function changePostStatusMessage($user, $message, $data)
    {
        $token = $user->firebase_token;
        $title = 'تغییر وضعیت آگهی';
        $this->sendMessage($title, $message, $token);
    }

    public function acceptMessage($userId)
    {
        $user = User::find($userId);
        $token = '';
        if($user){
            $token = $user->fire_base_token;
        }
        $title = 'قبول سفارش';
        $body = 'پیک سیز سفارش شما را قبول کرد';
        $this->sendMessage($title, $body, $token);
    }

    public function deliverMessage($userId)
    {
        $user = User::find($userId);
        $token = '';
        if($user){
            $token = $user->fire_base_token;
        }
        $title = 'اتمام سفارش';
        $body = 'پیک سیز سفارش شما را تحویل داد';
        $this->sendMessage($title, $body, $token);
    }

    public function cancelMessage($userId)
    {
        $user = User::find($userId);
        $token = '';
        if($user){
            $token = $user->fire_base_token;
        }
        $title = 'لغو سفارش';
        $body = 'پیک سیز سفارش شما را لغو کرد';
        $this->sendMessage($title, $body, $token);
    }

    public function newOrderMessage($tokens, $title, $body)
    {
        $fcmUrl = env('FCM_URL');

        $notification = [
            'title' => $title,
            'body' => $body,
//            'sound' => true,
        ];

        $fcmNotification = [
            'registration_ids' => $tokens, //multple token array
//            'to'        => $token, //single token
            'notification' => $notification,
//            'data' => $extra
        ];

        $headers = [
            'Authorization: key='.env('FCM_SERVER_KEY'),
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);

        curl_close($ch);
    }

    public function broadcastMessage($tokens, $title, $body)
    {
        $fcmUrl = env('FCM_URL');

        $notification = [
            'title' => $title,
            'body' => $body,
//            'sound' => true,
        ];

        $fcmNotification = [
            'registration_ids' => $tokens, //multple token array
//            'to'        => $token, //single token
            'notification' => $notification,
//            'data' => $extra
        ];

        $headers = [
            'Authorization: key='.env('FCM_SERVER_KEY'),
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);

        curl_close($ch);
    }
}
