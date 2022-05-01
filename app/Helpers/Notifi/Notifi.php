<?php

namespace App\Helpers\Notifi;
use App\Models\Chat\Chat_room;
use App\Models\User;

class Notifi{


    protected const API_ACCESS_KEY = 'AAAAiWgTf2E:APA91bFlGbf9NG4whNrhuq-e1FpV6hrlx8tBraVzpf8Ic7NVZxCIa9kqCPjrIvt7JItpYTmlgenWXP6_fBTuuXstAhWEyRiFIu48D-3FF23JbB7VJEc1pWbu3Qw_m-lSqI0H3fpJpWFM';


    private static function CURL_REQUEST($fields,$headers){
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



    public static function SenMessageNotifi($data,$message){

        if ($message) {
            // code...
            $chat_room = $message->chat_room;
            $unreadTotalSingleRoom = $message->unreadTotalSingleRoom;
            unset($message->chat_room,$message->unreadTotalSingleRoom);

            if ($chat_room) {

                $from = $data['from_id'];
                $to_id = $chat_room->child_id == $from->id ? $chat_room->parent_id : $chat_room->child_id;

                $user = User::where('id',$to_id)->where('api_token','!=',null)->first();

                if ($user) {
                    $registrationIds =  $user->firebase_token;
                    $msg = ['title' => $from->name,'body'  => $message->text];
                    $fields = [
                        'to'=> $registrationIds,
                        'notification' => $msg,
                        "data" => [
                            "sound"=> "default",
                            "click_action"=>"FLUTTER_NOTIFICATION_CLICK",
                            "notification_foreground"=>"true",
                            "notification_android_sound"=>"default",
                            "type" => "new_message",
                            "unreadTotalSingleRoom" => $unreadTotalSingleRoom,
                            "message" => $message,
                        ]
                    ];
                
                    $headers = [
                        'Authorization: key=' . self::API_ACCESS_KEY,
                        'Content-Type: application/json'
                    ];

                    return self::CURL_REQUEST($fields,$headers);
                 
                }
            }
        }
    }




     public static function ChangeLoginStatus($user){
        //return $user;
        $chat_rooms = Chat_room::where('parent_id',$user->id)->orWhere('child_id',$user->id)->pluck('parent_id','child_id')->toArray();

        $keys = array_unique(array_values($chat_rooms));
        $values = array_unique(array_keys($chat_rooms));
        $merged_array = array_merge($keys,$values);

        $users = User::whereIn('id',$merged_array)->where('online',true)->where('id','!=',$user->id)->where('api_token','!=',null)->pluck('firebase_token');
       
        if (count($users) > 0) {
            $registrationIds = $users;
            $fields = [
                //multu tokens
                'registration_ids'=> $registrationIds,
                
                "data" => [
                    "sound"=> "default",
                    "click_action"=>"FLUTTER_NOTIFICATION_CLICK",
                    "notification_foreground"=>"true",
                    "notification_android_sound"=>"default",
                    "type" => "change_login_status",
                    "userId" => (int)$user->id,
                    "isOnline" => (int)$user->online,
                    "lastLoginAt" => $user->last_login_at,
                ]
            ];
        
            $headers = [
                'Authorization: key=' . self::API_ACCESS_KEY,
                'Content-Type: application/json'
            ];

            return self::CURL_REQUEST($fields,$headers);
        }
    }




    public static function ReadedMessageNotifi($from_id,$room_id){

        $user = User::where('id',$from_id)->where('online',true)->where('api_token','!=',null)->first();

        if ($user) {
            $registrationIds = $user->firebase_token;
            $fields = [
                'to'=> $registrationIds,
                
                "data" => [
                    "sound"=> "default",
                    "click_action"=>"FLUTTER_NOTIFICATION_CLICK",
                    "notification_foreground"=>"true",
                    "notification_android_sound"=>"default",
                    "type" => "read_message",
                    "room_id" => $room_id,
                ]
            ];
        
            $headers = [
                'Authorization: key=' . self::API_ACCESS_KEY,
                'Content-Type: application/json'
            ];

            return self::CURL_REQUEST($fields,$headers);
        }
    }





    public static function TypingNowNotifi($to_user_id){

        $user = User::where(['id'=>$to_user_id,'online'=>true])->first();

        if ($user) {
            $registrationIds = $user->firebase_token;
            $fields = [
                'to'=> $registrationIds,
                
                "data" => [
                    "sound"=> "default",
                    "click_action"=>"FLUTTER_NOTIFICATION_CLICK",
                    "notification_foreground"=>"true",
                    "notification_android_sound"=>"default",
                    "type" => "typing",
                    "userId" => auth()->guard('api')->id(),
                ]
            ];
        
            $headers = [
                'Authorization: key=' . self::API_ACCESS_KEY,
                'Content-Type: application/json'
            ];

            return self::CURL_REQUEST($fields,$headers);
        }
    }







}