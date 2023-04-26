<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\URL;

trait PushNotificationTrait
{

    public static function notifyUser($deviceToken, $notifyDetails)
    {

        $fields = array(
            // 'registration_ids' => [$deviceToken],
            'registration_ids' => $deviceToken,
            'priority' => 'high',
            'forceShow' => "1",
            'notification' => [
                'title' => $notifyDetails['title'],
                'message' => $notifyDetails['body'],
                'body' => $notifyDetails['body'],
                "sound"=>"pushSound.wav",
                'notify_type' => $notifyDetails['type'],
                // 'image'	=> 'http://127.0.0.1:8000/admin_assets/media/logos/logo.png',
                // 'icon'    => url('/admin_assets/media/logos/logo.png'),
                "click_action" => "FCM_PLUGIN_ACTIVITY",
                // 'notify_type' => $notifyType
            ],
            'data' => [
                'title' => $notifyDetails['title'],
                'message' => $notifyDetails['body'],
                'body' => $notifyDetails['body'],
                'notify_type' => $notifyDetails['type'] ?? '',
                'data' => $notifyDetails ?? '',
                '_' => $notifyDetails['_'] ?? '',

            ]
        );
        // }
        // } 


        // print_r($fields); exit;

        $headers = array(
            // 'Authorization: key=AAAAYKMDczE:APA91bEA8P0e0cdc6UALYTlKOE2RQP1NSqWPhRBkHrWVkOxTmXJMTp0UFnvzbepFaUZA9UEuPqwHELcvCR59QlP2zxSE6JLcwBE181CFqtAT7za4KN6p2Ls6UF4_dlGSg1nUTjIkzERX',
            'Authorization: key=' . env('FIREBASE_SERVER_KEY'),
            'Content-Type: application/json'
        );
        // print_r($headers); exit;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        // print_r($result); exit;

        $result = json_decode($result);
        // dd($result);
        // print_r($result);
        // exit;
        if (isset($result->success) && $result->success == 1) {
            return true;
        } else {
            return false;
        }
    }


    public function testt()
    {
        echo 'fdddd';
    }
}
