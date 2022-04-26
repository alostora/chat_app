<?php

namespace App\Helpers\Notifi;
use App\Models\Chat\Chat_room;
use App\Models\User;

class Notifi{




    public static function senNotifi($data,$message){


        $API_ACCESS_KEY = 'AAAAiWgTf2E:APA91bFlGbf9NG4whNrhuq-e1FpV6hrlx8tBraVzpf8Ic7NVZxCIa9kqCPjrIvt7JItpYTmlgenWXP6_fBTuuXstAhWEyRiFIu48D-3FF23JbB7VJEc1pWbu3Qw_m-lSqI0H3fpJpWFM';

        $chat_room = Chat_room::find($data['room_id']);
        if ($chat_room) {

            $data['to_id'] = $chat_room->child_id == $data['from_id'] ? $chat_room->parent_id : $chat_room->child_id;
            $user = User::find($data['to_id']);

            if ($user) {
                $registrationIds =  $user->firebase_token;
                $msg = [
                    'title' => "title message",
                    'body'  =>"body message",
                    'priority'=> 'high',
                    'icon'  => 'myicon',
                    'sound' => 'mySound'
                    //'image'=>\URL::to('uploads/users/defaultLogo.jpeg'),
                ];

                $fields = [
                    'to'=> $registrationIds,
                    'notification' => $msg,
                    "data " => [
                        "sound"=> "default",
                        "click_action"=>"FLUTTER_NOTIFICATION_CLICK",
                        "notification_foreground"=>"true",
                        "notification_android_sound"=>"default",
                        "message" => $message,

                    ]
                ];
            
                $headers = [

                    'Authorization: key=' . $API_ACCESS_KEY,
                    'Content-Type: application/json'
                ];

                #Send Reponse To FireBase Server    
                $ch = curl_init();
                curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
                curl_setopt( $ch,CURLOPT_POST, true );
                curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                $result = curl_exec($ch );
                curl_close( $ch );

                return $result;
       
            }
        }
    }




}