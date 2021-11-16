<?php
    $fcm_id="DEVICE TOKEN";
    if($fcm_id!="")
    {

        //https://stackoverflow.com/questions/42989007/how-to-send-fcm-notification-to-app-from-web

            
        $col=array("1");
        $lit=array("color"=>$col,"light_on_duration"=>"3.5s","light_off_duration"=>"10s");


        $vib=array("3.5s");

        $not=array("body"=>"Please Check You Have one Order","title"=>"hi","icon"=>"dd","ticker"=>"Order","notification_priority"=>"HIGH","vibrate_timings"=>$vib,"light_settings"=>$lit);
        $data=array("val"=>"123");

        $json_data=array(
            "to"=>$fcm_id,
            "notification"=>$not,
            "data"=>$dt

            );
        $data = json_encode($json_data);
        //FCM API end-point
        $url = 'https://fcm.googleapis.com/fcm/send';
        //api_key in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
        $server_key = 'YOUR FCM SERVER KEY';
        //header with content_type api key
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key='.$server_key
        );
        //CURL request to route notification to FCM connection server (provided by Google)
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Oops! FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        echo json_encode(array("status"=>1,"message"=>"Success","list"=>$result));
    }
    else
    {
        echo json_encode(array("status"=>0,"message"=>"FCM Require"));
    }



?>
