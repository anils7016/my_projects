<?php

class GCM {
    public function send_notification_for_user($registatoin_ids, $message) {
		//print_r($registatoin_ids);exit;
     	$url = 'https://android.googleapis.com/gcm/send';

        $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => $message,
        );

        $headers = array( 
            'Authorization: key=' . 'AIzaSyAycCO1FobkakFvvMOygw63XT35aGewvyw',
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
		
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
		// Close connection
        curl_close($ch);
        echo $result;
		
    }
	
	
	public function send_notification_for_photographer($registatoin_ids, $message) {
		//print_r($registatoin_ids);exit;
     	$url = 'https://android.googleapis.com/gcm/send';

        $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => $message,
        );

        $headers = array( 
            'Authorization: key=' . 'AIzaSyDFN8uN7Fuwnm_RnrzgJSh7WuQr_3Mwgzw',
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
		
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
		// Close connection
        curl_close($ch);
        //echo $result;
		
    }

}

?>
