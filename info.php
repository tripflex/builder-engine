<?php

    function getLocation()
    {
        #$ip = $_SERVER['REMOTE_ADDR'];
        $ip = '115.28.162.2';
        $url = "http://ip-api.com/json/".$ip;
        $json = file_get_contents($url);

        $ip_data = json_decode($json, true);
        return $ip_data;
    }

    $ipdata = getLocation();
    var_dump($ipdata);

    phpinfo()


?>
