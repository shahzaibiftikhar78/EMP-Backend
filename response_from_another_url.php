<?php
        $service_url     = 'http://localhost/EMP-Backend/dummy.php';
        $curl            = curl_init($service_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $curl_response   = curl_exec($curl);
        curl_close($curl);
        $response_from_requested_url   = json_decode($curl_response);
        echo $response_from_requested_url->OperatorID;
?>